<?php
include_once("connection.php");
if(!isset($_SESSION['username'])){
  header("Location: ../../index.php");
}
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
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/homepage_sidebar.css">
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
       footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 1rem;
    }
    /* Mobile view */
    @media (max-width: 768px) {
      .pc-navbar {
        display: none;
      }

      .mobile-navbar {
        display: flex;
      }
    }
    a{
        text-decoration: none;
        color: white;
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
  </div>

  <!-- Sidebar Menu -->
  <div class="sidebar" id="sidebar">
    <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.php"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
  </div>
  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<?php
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
      $profile_sql = "SELECT * FROM `user_registration` WHERE `username`= '$name' AND `email` ='$email'";
      $profile_result = mysqli_query($conn,$profile_sql);
      while($row = $profile_result->fetch_assoc()){
        $username = $row['username'];
        $email = $row['email'];
        $address = $row['address'];
      }

    ?>
  <!-- Profile Content -->
  <section class="profile-container">
    <div class="profile-card">
      <!-- <img src="https://picsum.photos/120?random=1" alt="Profile Picture"> -->

      <?php echo '<h2>'.$username.'</h2>';
            echo '<p>Email : '.$email.'</p>
            <p>Address: '.$address.'</p>';
      ?>
      
      <a href="order_history.php"><button class="logout-btn">Order History</button></a>
      <button class="edit-btn" id="editbtn">Edit Profile</button>      
      <a href="faq.php"><button class="logout-btn">FAQ</button></a>
      <a href="contact.php"><button class="logout-btn">Contact</button></a>


      <a href="logout.php"><button class="logout-btn">Logout</button></a>

    </div>
  </section>
    

  <div id="popup" class="popup-overlay">
  <div class="popup-box">
    <span class="close-btn" id="closePopup">&times;</span>
    <h3>Edit Profile</h3>
    <form id="emailForm" action="profile_update.php" method="GET">
      <input type="text" id="email" name="username" placeholder="username" value="<?php echo $username ?>" >
      <input type="email" id="email" name="email" placeholder="email" value="<?php echo $email ?>" >
      <input type="textarea" id="email" name="address" placeholder="address" value="<?php echo $address ?>">
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
