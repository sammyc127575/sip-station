<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bablaz dispensing App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary: #8e44ad;
      --secondary: #e67e22;
      --bg-light: #fafafa;
      --text-dark: #333;
      --border-radius: 1rem;
      --transition: all 0.3s ease-in-out;
      --shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: "Segoe UI", Roboto, sans-serif; scroll-behavior: smooth; }
    body { background: var(--bg-light); color: var(--text-dark); line-height: 1.55; }
    header { background: var(--primary); position: sticky; top: 0; z-index: 1000; box-shadow: var(--shadow); }
    nav { max-width: 1200px; margin: 0 auto; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; color: #fff; }
    nav h1 { font-size: 1.5rem; font-weight: 700; }
    .nav-links { list-style: none; display: flex; gap: 1rem; }
    .nav-links a { color: #fff; text-decoration: none; font-weight: 600; position: relative; padding-bottom: 4px; }
    .nav-links a::after { content: ""; position: absolute; left: 0; bottom: 0; width: 0%; height: 2px; background: var(--secondary); transition: var(--transition); }
    .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }
    .hero { background: url("https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=1950&q=80") center/cover no-repeat; height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; position: relative; }
    .hero::after { content: ""; position: absolute; inset: 0; background: rgba(0,0,0,0.4); }
    .hero-content { position: relative; z-index: 1; }
    .hero h2 { font-size: 2.5rem; margin-bottom: 0.5rem; }
    .hero p { font-size: 1.1rem; }
    #drinks { padding: 4rem 2rem; max-width: 1200px; margin: auto; }
    #drinks h2 { text-align: center; font-size: 2rem; margin-bottom: 2rem; }
    .drink-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 2rem; }
    .drink-card { background: #fff; border-radius: var(--border-radius); overflow: hidden; box-shadow: var(--shadow); display: flex; flex-direction: column; transition: var(--transition); }
    .drink-card:hover { transform: translateY(-8px); }
    .drink-card img { width: 100%; height: 180px; object-fit: cover; }
    .drink-info { padding: 1rem 1.25rem; flex: 1; display: flex; flex-direction: column; }
    .drink-info h3 { font-size: 1.2rem; margin-bottom: 0.5rem; }
    .drink-info p { flex: 1; font-size: 0.95rem; opacity: 0.9; margin-bottom: 1rem; }
    .btn-dispense { align-self: flex-start; background: var(--secondary); color: #fff; border: none; padding: 0.6rem 1.2rem; border-radius: 999px; cursor: pointer; font-weight: 600; transition: var(--transition); }
    .btn-dispense:hover { background: #d35400; }
    #buy { background: #fff; padding: 4rem 2rem; }
    #buy h2 { text-align: center; margin-bottom: 1rem; font-size: 2rem; }
    #cart-list { max-width: 600px; margin: 1rem auto 2rem auto; list-style: none; padding: 0; border: 2px dashed var(--primary); border-radius: var(--border-radius); }
    #cart-list li { padding: 1rem; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; }
    #cart-list li:last-child { border-bottom: none; }
    #btn-checkout { display: block; margin: auto; background: var(--primary); color: #fff; border: none; padding: 0.8rem 2rem; border-radius: 999px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: var(--transition); }
    #btn-checkout:hover { background: #732d91; }
    section { padding: 4rem 2rem; max-width: 900px; margin: auto; }
    section h2 { font-size: 2rem; margin-bottom: 1rem; text-align: center; }
    #contacts form { display: grid; gap: 1rem; }
    #contacts input, #contacts textarea { padding: 0.8rem; border: 1px solid #ccc; border-radius: var(--border-radius); font-size: 1rem; resize: vertical; }
    #contacts button { justify-self: start; background: var(--secondary); border: none; color: #fff; padding: 0.7rem 1.5rem; border-radius: 999px; cursor: pointer; font-weight: 600; transition: var(--transition); }
    #contacts button:hover { background: #d35400; }
    footer { text-align: center; padding: 2rem; background: var(--primary); color: #fff; }
    footer small { opacity: 0.8; }
    @media (max-width: 768px) { nav { flex-direction: column; gap: 1rem; } .nav-links { flex-wrap: wrap; justify-content: center; } .hero h2 { font-size: 2rem; } }
  </style>
</head>
<body>
  <!-- ===== NAVBAR ===== -->
  <header>
    <nav>
      <h1>Bablaz<span style="color: var(--secondary);">Sip station</span></h1>
      <ul class="nav-links">
        <li><a href="#home" class="active">Home</a></li>
        <li><a href="#buy">Buy</a></li>
        <li><a href="#more-info">More Info</a></li>
        <li><a href="#contacts">Contacts</a></li>
      </ul>
    </nav>
  </header>
  <section id="home" class="hero">
    <div class="hero-content">
      <h2>Pour Happiness One Tap at a Time</h2>
      <p>Select, Pay, Dispense – It’s that easy!</p>
    </div>
  </section>
  <section id="drinks">
    <h2>Select Your Drink</h2>
    <div class="drink-grid">
      <article class="drink-card" data-name="Chardonnay" data-price="4.00" data-type="Wine">
        <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=800&q=80" alt="Chardonnay">
        <div class="drink-info">
          <h3>Chardonnay (Wine)</h3>
          <p>Crisp &amp; fruity white wine.</p>
          <button class="btn-dispense">Add to Cart</button>
        </div>
      </article>
      <article class="drink-card" data-name="Merlot" data-price="4.50" data-type="Wine">
        <img src="https://images.unsplash.com/photo-1510620178385-3c69eff1f4a0?auto=format&fit=crop&w=800&q=80" alt="Merlot">
        <div class="drink-info">
          <h3>Merlot (Wine)</h3>
          <p>Smooth &amp; medium‑bodied red.</p>
          <button class="btn-dispense">Add to Cart</button>
        </div>
      </article>
      <article class="drink-card" data-name="Scotch Whisky" data-price="6.00" data-type="Spirit">
        <img src="https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=800&q=80" alt="Scotch Whisky">
        <div class="drink-info">
          <h3>Scotch Whisky</h3>
          <p>Rich &amp; smoky highland blend.</p>
          <button class="btn-dispense">Add to Cart</button>
        </div>
      </article>
      <article class="drink-card" data-name="Vodka" data-price="5.00" data-type="Spirit">
        <img src="https://images.unsplash.com/photo-1582191570903-3e39954f585d?auto=format&fit=crop&w=800&q=80" alt="Vodka">
        <div class="drink-info">
          <h3>Vodka</h3>
          <p>Clean, smooth, perfect for cocktails.</p>
          <button class="btn-dispense">Add to Cart</button>
        </div>
      </article>
      <article class="drink-card" data-name="Craft IPA" data-price="3.50" data-type="Beer">
        <img src="https://images.unsplash.com/photo-1527168026004-4050d4a89692?auto=format&fit=crop&w=800&q=80" alt="Craft IPA">
        <div class="drink-info">
          <h3>Craft IPA</h3>
          <p>Hoppy &amp; aromatic India Pale Ale.</p>
          <button class="btn-dispense">Add to Cart</button>
        </div>
      </article>
      <article class="drink-card" data-name="Lager" data-price="3.00" data-type="Beer">
        <img src="https://images.unsplash.com/photo-1571880878302-51f4d66ad4fc?auto=format&fit=crop&w=800&q=80" alt="Lager">
        <div class="drink-info">
          <h3>Lager</h3>
          <p>Classic crisp &amp; refreshing brew.</p>
          <button class="btn-dispense">Add to Cart</button>
        </div>
      </article>
    </div>
  </section>
  <section id="buy">
    <h2>Your Selection</h2>
    <ul id="cart-list"></ul>
    <button id="btn-checkout" class="btn btn-primary">Checkout</button>
  </section>
  <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="mpesaForm">
          <div class="modal-header">
            <h5 class="modal-title" id="checkoutModalLabel">Mpesa Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Phone Number</label>
              <input type="text" class="form-control" id="phoneNumber" placeholder="e.g. 07XXXXXXXX" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Amount</label>
              <input type="text" class="form-control" id="cartAmount" readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Pay</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <section id="more-info">
    <h2>More Information</h2>
    <p>Our automated brew dispenser integrates secure mobile payments via M‑PESA Daraja API. Simply add your drinks to the cart, pay with your phone, and watch the machine pour your selection with precision‑controlled valves and proper sanitation protocols. RFID sensors ensure every pour is accurate down to the milliliter.</p>
    <p>All components meet food‑grade certification, and the system logs every transaction and dispense event for HACCP compliance.</p>
  </section>
  <section id="contacts">
    <h2>Contact Us</h2>
    <form id="contact-form">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <textarea name="message" rows="4" placeholder="Message" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </section>
  <footer>
    <small>&copy; 2025 Bablaz Sip station &nbsp;|&nbsp; Drink Responsibly</small>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Navigation Active Link Highlight
    const navLinks = document.querySelectorAll('.nav-links a');
    function setActiveLink() {
      let index = navLinks.length;
      while(--index && window.scrollY + 80 < document.querySelector(navLinks[index].hash).offsetTop) {}
      navLinks.forEach((link) => link.classList.remove('active'));
      navLinks[index].classList.add('active');
    }
    setActiveLink();
    window.addEventListener('scroll', setActiveLink);
    // Cart Logic
    const cartList = document.getElementById('cart-list');
    const btnCheckout = document.getElementById('btn-checkout');
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
      cart.forEach((item, idx) => {
        const li = document.createElement('li');
        li.innerHTML = `${item.name} <span>$${item.price.toFixed(2)}</span>`;
        cartList.appendChild(li);
      });
    }
    // Checkout Button Logic
    btnCheckout.addEventListener('click', () => {
      if(cart.length === 0) {
        alert('Your cart is empty!');
        return;
      }
      const total = cart.reduce((sum, item) => sum + item.price, 0).toFixed(2);
      document.getElementById('cartAmount').value = total;
      const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
      checkoutModal.show();
    });
    // Mpesa Payment AJAX
    document.getElementById('mpesaForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const phone = document.getElementById('phoneNumber').value;
      const amount = document.getElementById('cartAmount').value;
      fetch('mpesa_payment.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ phone, amount })
      })
      .then(res => res.json())
      .then(data => {
        if(data.success) {
          alert('Payment initiated! Check your phone to complete.');
          cart.length = 0;
          renderCart();
          bootstrap.Modal.getInstance(document.getElementById('checkoutModal')).hide();
        } else {
          alert('Payment failed: ' + data.message);
        }
      })
      .catch(() => alert('Network error.'));
    });
    // Contact Form
    document.getElementById('contact-form').addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Thank you for contacting us! We will reply shortly.');
      e.target.reset();
    });
  </script>
</body>
</html>
