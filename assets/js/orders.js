document.addEventListener('DOMContentLoaded', () => {
    if (!Auth.isAuthenticated() || !document.getElementById('buyer-orders')) return;
    const t=key=>Commerce.t(key);
    const node=(...args)=>Commerce.node(...args);
    const busy = {orders:false,sales:false};
    async function load(seller=false) {
        const kind=seller?'sales':'orders';
        if (busy[kind]) return;
        busy[kind]=true;
        const status=document.getElementById(kind+'-status');
        const list=document.getElementById(seller?'seller-orders':'buyer-orders');
        status.textContent=t('loading');
        try {
            const result=await apiRequest(seller?'/orders/seller':'/orders/mine','GET',null,{redirectOnUnauthorized:false});
            if (!result.ok) throw new Error(Commerce.error(result));
            list.replaceChildren();
            const rows=result.data.data;
            if (!seller) document.getElementById('buyer-order-count').textContent=rows.length;
            if (!rows.length) list.append(node('p',t('noOrders')));
            for (const row of rows) {
                if (seller) list.append(itemCard(row,true,status));
                else {
                    const section=node('section',null,'account-card');
                    section.dataset.orderId=row.id;
                    section.append(node('h3',t('order')+' #'+row.id),node('p',t('date')+': '+row.created_at));
                    for (const item of row.items) section.append(itemCard(item,false,status));
                    list.append(section);
                }
            }
            status.textContent='';
        } catch(error) { status.textContent=error.message || t('loadFailed'); }
        finally { busy[kind]=false; }
    }
    function itemCard(item,seller,status) {
        const card=node('article',null,'commerce-item');
        card.dataset.itemId=item.id;
        const info=node('div');
        info.append(node('h3',item.title), node('p',t('order')+' #'+item.order_id),
            node('p',Commerce.money(item.price)),node('p',t(item.status),'item-status'));
        const view=node('a',t('details')); view.href='pages/book-details.php?id='+item.book_id; info.append(view);
        if (seller) {
            info.append(node('p',t('buyer')+': '+item.buyer_name),node('p',t('city')+': '+item.city),
                node('p',t('date')+': '+item.created_at));
            if (item.address) info.append(node('p',t('address')+': '+item.address+' · '+item.postal_code));
            const actions=node('div',null,'commerce-actions');
            const transitions={PENDING:[['ACCEPTED','accept'],['DECLINED','decline']],ACCEPTED:[['IN_PROGRESS','progress']],IN_PROGRESS:[['DELIVERED','deliver']]};
            for (const [next,label] of transitions[item.status] || []) {
                const button=node('button',t(label),'btn btn-primary'); button.type='button'; button.dataset.nextStatus=next;
                button.addEventListener('click',async()=>{
                    if (busy.sales) return;
                    busy.sales=true;
                    actions.querySelectorAll('button').forEach(b=>b.disabled=true);
                    status.textContent=t('saving');
                    const result=await apiRequest('/orders/items/'+item.id+'/status','PATCH',{status:next},{redirectOnUnauthorized:false});
                    busy.sales=false;
                    if (!result.ok) {
                        status.textContent=Commerce.error(result,'updateFailed');
                        actions.querySelectorAll('button').forEach(b=>b.disabled=false);
                    } else await load(true);
                });
                actions.append(button);
            }
            info.append(actions);
            card.append(Commerce.image(item.cover_url,item.title));
        } else info.append(node('p',t('seller')+': '+item.seller_name),node('p',t('date')+': '+item.created_at));
        card.append(info); return card;
    }
    document.getElementById('orders-retry').addEventListener('click',()=>load());
    document.getElementById('sales-retry').addEventListener('click',()=>load(true));
    document.querySelector('[data-tab="orders"]').addEventListener('click',()=>load());
    document.querySelector('[data-tab="sales"]').addEventListener('click',()=>load(true));
    window.addEventListener('hashchange',()=>{ if (location.hash==='#orders') load(); if(location.hash==='#sales') load(true); });
    load(); load(true);
});
