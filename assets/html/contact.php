<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Help & Contact</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f9f9f9;
      color: #333;
    }

    header {
      background-color: #0a74da;
      padding: 1rem;
      color: white;
      text-align: center;
    }

    .container {
      max-width: 900px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      margin-top: 0;
      color: #0a74da;
    }

    .faq {
      margin-bottom: 2rem;
    }

    .faq h3 {
      margin-bottom: 0.5rem;
    }

    .contact-form {
      margin-top: 2rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 0.7rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    .form-group button {
      background-color: #0a74da;
      color: white;
      border: none;
      padding: 0.8rem 1.5rem;
      border-radius: 5px;
      cursor: pointer;
    }

    .form-group button:hover {
      background-color: #005bb5;
    }
  </style>
</head>
<body>

<header>
  <h1>Help & Contact</h1>
</header>

<div class="container">
  <section class="faq">
    <h2>Frequently Asked Questions</h2>
    <h3>1. How can I track my order?</h3>
    <p>After placing the order, you'll receive a tracking link in your email or SMS.</p>

    <h3>2. How do I return a product?</h3>
    <p>You can initiate a return request from your account order page within 7 days of delivery.</p>

    <h3>3. Can I cancel an order?</h3>
    <p>Yes, you can cancel the order before it is shipped.</p>

    <h3>4. What payment options are available?</h3>
    <p>We accept UPI, Debit/Credit Cards, Net Banking, and Cash on Delivery.</p>
  </section>

  <section class="contact-form">
    <h2>Contact Us</h2>
    <form action="#" method="POST">
      <div class="form-group">
        <label for="name">Your Name *</label>
        <input type="text" id="name" required>
      </div>
      <div class="form-group">
        <label for="email">Your Email *</label>
        <input type="email" id="email" required>
      </div>
      <div class="form-group">
        <label for="message">Your Message *</label>
        <textarea id="message" required></textarea>
      </div>
      <div class="form-group">
        <button type="submit">Send Message</button>
      </div>
    </form>
  </section>
</div>

</body>
</html>
