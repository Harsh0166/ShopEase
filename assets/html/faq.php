<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Help & Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/homepage_sidebar.css">
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
.search-container {
  position: relative;
  width: 100%;
}

.search-container input {
  width: 100%;
  padding: 8px 45px 8px 15px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
  box-sizing: border-box;
}

.search-container .search-btn {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #555;
  font-size: 18px;
  cursor: pointer;
  padding: 4px;
  line-height: 1;
}

.search-container .search-btn:hover {
  color: white;
  background-color: #111;
  border-radius: 50%;
  width: 35px;
  height: 35px;
}
    h2 {
      margin-top: 0;
      color: #111;
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
      /* Responsive */
    @media (max-width: 768px) {
      .pc-navbar {
        display: none;
      }

      .mobile-navbar {
        display: flex;
      }
    }
      @media (min-width: 769px) {
      .mobile-navbar {
        display: none;
      }
    }
  </style>
</head>
<body>
    <!-- Desktop Navbar -->
  <div class="pc-navbar">
    <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
    <div class="search-bar">
      <form action="search.php" method="GET">
            <div class="search-container">

        <input type="text" name="query" placeholder="Search products..." required>
        <button type="submit" class="search-btn">
          <i class="fas fa-search"></i>
        </button>

            </div>
      </form>
    </div>


    <nav>
      <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
      <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
      <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    </nav>
  </div>

  <!-- Mobile Navbar -->
  <div class="mobile-navbar">
    <div class="mobile-top">
      <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
      <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
    </div>
    <div class="search-bar">
      <form action="search.php" method="GET">
            <div class="search-container">
        <input type="text" name="query" placeholder="Search products..." required>
        <button type="submit" class="search-btn">
          <i class="fas fa-search"></i>
        </button>
            </div>
      </form>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <div class="sidebar" id="sidebar">
    <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
  </div>
  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="container">
  <section class="faq">
    <h2>Frequently Asked Questions</h2> <hr>
    <h3>1. How can I track my order?</h3>
    <p>After placing the order, you'll receive a tracking link in your email or SMS.</p>

    <h3>2. How do I return a product?</h3>
    <p>You can initiate a return request from your account order page within 7 days of delivery.</p>

    <h3>3. Can I cancel an order?</h3>
    <p>Yes, you can cancel the order before it is shipped.</p>

    <h3>4. What payment options are available?</h3>
    <p>We accept UPI, Debit/Credit Cards, Net Banking, and Cash on Delivery.</p>
  </section>

</div>

</body>
</html>
