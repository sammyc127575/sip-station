// This file contains the client-side JavaScript for the Bablaz dispensing application.
// It handles user interactions, such as initiating payments and updating the UI based on payment status.

document.addEventListener('DOMContentLoaded', () => {
    const btnCheckout = document.getElementById('btn-checkout');
    const cartList = document.getElementById('cart-list');
    const cart = [];

    document.querySelectorAll('.btn-dispense').forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.drink-card');
            const name = card.dataset.name;
            const price = parseFloat(card.dataset.price);

            cart.push({ name, price });
            renderCart();
        });
    });

    function renderCart() {
        cartList.innerHTML = '';
        cart.forEach((item) => {
            const li = document.createElement('li');
            li.innerHTML = `${item.name} <span>$${item.price.toFixed(2)}</span>`;
            cartList.appendChild(li);
        });
    }

    btnCheckout.addEventListener('click', async () => {
        if (cart.length === 0) {
            alert('Your cart is empty!');
            return;
        }

        const total = cart.reduce((sum, item) => sum + item.price, 0).toFixed(2);

        if (confirm(`Total amount is $${total}.\nProceed to pay via M-PESA?`)) {
            try {
                const response = await fetch('/api/mpesa/pay', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ amount: total }),
                });

                const data = await response.json();

                if (data.success) {
                    alert('Payment confirmed! Dispensing your drinks now...');
                    cart.length = 0; // clear cart
                    renderCart();
                } else {
                    alert('Payment failed: ' + data.message);
                }
            } catch (error) {
                alert('An error occurred while processing your payment. Please try again.');
            }
        }
    });
});