<?php
include_once("connection.php");
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile - ShopEase</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f5f5f5;
      overflow-x: hidden;
    }

    /* Header & Nav */
    header {
      background-color: #111;
      color: white;
      padding: 0.5rem 1rem;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .logo {
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }

    .logo i {
      margin-right: 0.5rem;
    }

    .search-bar {
      width: 100%;
      margin: 0.5rem 0;
    }

    .search-bar input {
      width: 100%;
      padding: 0.5rem;
      border-radius: 4px;
      border: none;
    }

    nav {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-size: 1rem;
    }

    nav a i {
      margin-right: 4px;
    }

    .menu-toggle {
      font-size: 2rem;
      cursor: pointer;
      color: white;
      display: none;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: -100%;
      height: 100vh;
      width: 250px;
      background-color: #222;
      color: white;
      padding: 2rem 1rem;
      transition: 0.3s ease;
      z-index: 999;
    }

    .sidebar.open {
      left: 0;
    }

    .sidebar a {
      display: block;
      margin-bottom: 1.5rem;
      color: white;
      text-decoration: none;
      font-size: 1.2rem;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0,0,0,0.5);
      display: none;
      z-index: 998;
    }

    .overlay.active {
      display: block;
    }

    .profile-container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 3rem 1rem;
    }

    .profile-card {
      background: white;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .profile-card img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin-bottom: 1.5rem;
    }

    .profile-card h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
      text-align: center;
    }

    .profile-card p {
      font-size: 1.1rem;
      margin-bottom: 1rem;
      text-align: center;
    }

    .profile-card .edit-btn,
    .profile-card .logout-btn {
      display: block;
      width: 100%;
      padding: 0.75rem;
      margin-top: 1.5rem;
      background-color: #111;
      color: white;
      border: none;
      border-radius: 5px;
      text-align: center;
      cursor: pointer;
    }

    .popup-overlay {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.4);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .popup-box {
      background: white;
      padding: 20px;
      width: 300px;
      border-radius: 8px;
      position: relative;
    }

    .popup-box input[type="email"],input[type="text"],input[type="textarea"] {
      width: 100%;
      padding: 8px;
      margin: 12px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .popup-actions {
      text-align: right;
    }

    .popup-actions button {
      margin-left: 10px;
      padding: 6px 12px;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 14px;
      font-size: 20px;
      cursor: pointer;
      color: #888;
    }
    /* Mobile view */
    @media (max-width: 768px) {
      .top-bar {
        flex-direction: row;
        justify-content: space-between;
      }

      .search-bar {
        order: 2;
        width: 100%;
        margin: 0.5rem 0;
      }

      nav {
        display: none;
      }

      .menu-toggle {
        display: block;
      }
    }
    a{
        text-decoration: none;
        color: white;
    }
    @media (min-width: 769px) {
      .top-bar {
        flex-direction: row;
      }

      .search-bar {
        width: 50%;
      }

      nav {
        display: flex;
      }

      .menu-toggle {
        display: none;
      }
    }
  </style>
</head>
<body>

  <header>
    <div class="top-bar">
      <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
      <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
      <div class="search-bar"><input type="text" placeholder="Search products..."></div>
      <nav>
        <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
      </nav>
    </div>
  </header>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
  </div>
  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

  <!-- Profile Content -->
  <section class="profile-container">
    <div class="profile-card">
      <img src="https://picsum.photos/120?random=1" alt="Profile Picture">

      <?php echo '<h2>'.$username.'</h2>';
            echo '<p>Email : '.$email.'</p>';
      ?>
      <p>Address: 1234 Elm Street, Springfield, IL</p>
      <button class="logout-btn"><a href="order_history.php">Order History</a></button>
      <button class="edit-btn" id="editbtn">Edit Profile</button>
      <button class="logout-btn">Logout</button>

    </div>
  </section>


  <div id="popup" class="popup-overlay">
  <div class="popup-box">
    <span class="close-btn" id="closePopup">&times;</span>
    <h3>Edit Profile</h3>
    <form id="emailForm" action="" method="GET">
      <input type="text" id="email" name="username" placeholder="username" >
      <input type="email" id="email" name="email" placeholder="email" >
      <input type="textarea" id="email" name="address" placeholder="address" >

      <div class="popup-actions">
        <button type="submit">Update</button>
        <button type="button" id="cancelBtn">Cancel</button>
      </div>
    </form>
  </div>
</div>

  <footer>
    &copy; 2025 ShopEase. All rights reserved.
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById('sidebar').classList.toggle('open');
      document.getElementById('overlay').classList.toggle('active');
    }

  var popup = document.getElementById('popup');
  var editbtn = document.getElementById('editbtn');
  var closeBtn = document.getElementById('closePopup');
  var cancelBtn = document.getElementById('cancelBtn');


  editbtn.onclick = function(){
    popup.style.display = 'flex';
    document.getElementById('email').focus();
  }

  closeBtn.onclick=function(){
    popup.style.display = 'none';
  }

  cancelBtn.onclick=function(){
    popup.style.display = 'none';
  }
  </script>

</body>
</html>
