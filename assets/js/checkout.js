document.addEventListener('DOMContentLoaded', () => {
    const checkoutForm = document.querySelector('.checkout-form');
    if (!checkoutForm) return;

    checkoutForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = checkoutForm.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.textContent;

        // 1. Gather Customer Contact & Delivery Info
        const formData = new FormData(checkoutForm);
        const orderPayload = {
            full_name: formData.get('full_name')?.trim(),
            email: formData.get('email')?.trim(),
            address: formData.get('address')?.trim(),
            city: formData.get('city')?.trim(),
            postal_code: formData.get('postal_code')?.trim() || null,
            items: []
        };

        // 2. Retrieve Cart Items (Normalize PHP session window object or localStorage array)
        let rawCart = (typeof window.CHECKOUT_CART !== 'undefined' && window.CHECKOUT_CART)
            ? window.CHECKOUT_CART
            : JSON.parse(localStorage.getItem('cart') || '[]');

        let cartItems = [];
        if (Array.isArray(rawCart)) {
            cartItems = rawCart;
        } else if (typeof rawCart === 'object' && rawCart !== null) {
            cartItems = Object.values(rawCart);
        }

        if (!cartItems || cartItems.length === 0) {
            showCheckoutError('Your cart is empty.');
            return;
        }

        // Map cart items into expected structure for OrderController
        orderPayload.items = cartItems.map(item => ({
            book_id: item.id || item.book_id,
            title: item.title || item.cover_text,
            price: parseFloat(item.price || 0)
        }));

        // 3. UI Loading State
        submitBtn.disabled = true;
        submitBtn.textContent = 'Processing Order...';
        clearCheckoutError();

        try {
            // Send request using your standard apiRequest helper (same as categories.js)
            const res = await apiRequest('/orders', 'POST', orderPayload);

            if (!res.ok) {
                const errorMessage = res.data?.error || 'Failed to submit order. Please try again.';
                throw new Error(errorMessage);
            }

            // 4. On Success: Clear Cart & Render Success UI
            localStorage.removeItem('cart');

            const orderId = res.data?.order_id || res.data?.id || '';
            const checkoutLayout = document.querySelector('.checkout-layout');

            checkoutLayout.innerHTML = `
                <section class="checkout-success" style="text-align: center; width: 100%; padding: 3rem 0;">
                    <i class="fa-solid fa-circle-check" style="font-size: 3rem; color: #2e7d32; margin-bottom: 1rem;"></i>
                    <h1>Thank you for your order!</h1>
                    <p>Your order ${orderId ? `#${orderId}` : ''} has been placed successfully. A confirmation email has been sent to <strong>${escapeHtml(orderPayload.email)}</strong>.</p>
                    <a href="catalog.php" class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block;">Continue Shopping</a>
                </section>
            `;

        } catch (error) {
            console.error('Checkout error:', error);
            showCheckoutError(error.message || 'An unexpected error occurred while placing your order.');
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        }
    });

    // Helper to display error messages inside form
    function showCheckoutError(message) {
        clearCheckoutError();
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger checkout-alert';
        errorDiv.style.cssText = 'color: #d32f2f; margin-bottom: 1rem; padding: 0.75rem; background: #fde8e8; border-radius: 4px;';
        errorDiv.textContent = message;

        const eyebrow = checkoutForm.querySelector('.eyebrow');
        if (eyebrow) {
            eyebrow.insertAdjacentElement('afterend', errorDiv);
        } else {
            checkoutForm.prepend(errorDiv);
        }
    }

    function clearCheckoutError() {
        const existingAlert = checkoutForm.querySelector('.checkout-alert');
        if (existingAlert) existingAlert.remove();
    }

    // Helper function to prevent XSS attacks when rendering HTML
    function escapeHtml(text) {
        if (text === null || text === undefined) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});