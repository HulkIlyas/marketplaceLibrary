document.addEventListener('DOMContentLoaded', () => {
    const checkout = Boolean(document.getElementById('checkout-page'));
    if (!checkout && !document.getElementById('cart-page')) return;
    if (checkout && !Auth.isAuthenticated()) { location.replace('login.php?next=checkout'); return; }
    const t = key => Commerce.t(key);
    const el = id => document.getElementById(id);
    const status = el('commerce-status');
    let books = [], loading = false, submitting = false, failed = false;
    const currentBooks = () => books.filter(book => Cart.has(book.id));
    function render() {
        const current = currentBooks();
        const total = current.reduce((sum, book) => sum + Math.round(Number(book.price)*100), 0)/100;
        el('cart-subtotal').textContent = el('cart-total').textContent = failed ? '—' : Commerce.money(total);
        const list = el(checkout ? 'checkout-items' : 'cart-items');
        list.replaceChildren();
        current.forEach(book => {
            const card = Commerce.node('article', null, 'commerce-item');
            card.dataset.bookId = book.id;
            const info = Commerce.node('div');
            info.append(Commerce.node('h3',book.title), Commerce.node('p',book.author+' · '+Commerce.condition(book.book_condition)),
                Commerce.node('p',t('seller')+': '+book.owner_name+' · '+(book.city || '')),
                Commerce.node('p',t(book.listing_type)), Commerce.node('strong',Commerce.money(book.price)));
            const actions = Commerce.node('div',null,'commerce-actions');
            const view = Commerce.node('a',t('details')); view.href = 'book-details.php?id='+book.id;
            actions.append(view);
            if (!checkout) {
                const remove = Commerce.node('button',t('remove'),'btn btn-secondary'); remove.type='button';
                remove.setAttribute('aria-label',t('removeLabel').replace('%s',book.title));
                remove.addEventListener('click', () => { try { Cart.remove(book.id); render(); } catch { status.textContent=t('storageFailed'); } });
                actions.append(remove);
            }
            info.append(actions);
            card.append(Commerce.image(book.images?.find(image=>image.is_cover)?.url || book.images?.[0]?.url,book.title),info);
            list.append(card);
        });
        if (checkout) {
            el('place-order').disabled = failed || loading || submitting || !current.length;
            if (!current.length && !failed && !loading) status.textContent = t('emptyCart');
        } else {
            const count = Cart.count();
            el('cart-count').textContent = count+' '+t(count === 1 ? 'item' : 'items');
            el('cart-empty').hidden = Cart.count() !== 0;
            el('checkout-link').hidden = failed || loading || !current.length;
        }
    }
    async function load() {
        if (loading || submitting) return;
        loading=true; status.textContent=t('loading'); render();
        try {
            const result=await Commerce.loadCart();
            books=result.books; failed=result.failed;
            status.textContent=result.failed ? t('loadFailed') : result.removed ? t('removedUnavailable') : '';
        } catch { failed=true; status.textContent=t('loadFailed'); }
        finally { loading=false; render(); }
    }
    el('commerce-retry').addEventListener('click',load);
    window.addEventListener('cartchange', () => { if (!loading && !submitting) load(); });
    if (checkout) {
        const user=Auth.getUserPayload();
        el('full_name').value=user.name || ''; el('email').value=user.email || '';
        el('checkout-form').addEventListener('submit',async event=>{
            event.preventDefault();
            if (submitting || loading || failed || !currentBooks().length) return;
            if (!Auth.isAuthenticated()) { location.href='login.php?next=checkout'; return; }
            const body={book_ids:currentBooks().map(book=>Number(book.id))};
            for (const field of ['full_name','email','address','city','postal_code']) body[field]=el(field).value.trim();
            if (Object.values(body).some(value=>typeof value==='string' && !value)) { status.textContent=t('invalidContact'); return; }
            submitting=true; render(); status.textContent=t('saving');
            const result=await apiRequest('/orders','POST',body,{redirectOnUnauthorized:false});
            if (!result.ok) {
                status.textContent=Commerce.error(result,'orderFailed');
                submitting=false; render();
                if (result.status===401) location.href='login.php?next=checkout';
                return;
            }
            try { Cart.clear(); } catch { /* Order already exists; never offer to submit it twice. */ }
            status.textContent=t('success');
            setTimeout(()=>{ location.href='../profile.php#orders'; },1200);
        });
    }
    load();
});
