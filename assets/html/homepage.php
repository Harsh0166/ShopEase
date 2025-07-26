<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ShopEase - Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    /* Desktop Navbar */
    .pc-navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #111;
      color: white;
      padding: 0.5rem 1rem;
    }

    .pc-navbar .logo {
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }

    .pc-navbar .logo i {
      margin-right: 0.5rem;
    }

    .pc-navbar .search-bar {
      flex-grow: 1;
      margin: 0 1rem;
    }

    .pc-navbar .search-bar input {
      width: 100%;
      padding: 0.5rem;
      border-radius: 4px;
      border: none;
    }

    .pc-navbar nav {
      display: flex;
      gap: 1rem;
    }

    .pc-navbar nav a {
      color: white;
      text-decoration: none;
      font-size: 1rem;
    }

    .pc-navbar nav a i {
      margin-right: 4px;
    }

    /* Mobile Navbar */
    .mobile-navbar {
      display: none;
      background-color: #111;
      color: white;
      flex-direction: column;
    }

    .mobile-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem 1rem;
    }

    .mobile-top .menu-toggle {
      font-size: 1.8rem;
      cursor: pointer;
    }

    .mobile-top .logo {
      font-size: 1.5rem;
      display: flex;
      align-items: center;
    }

    .mobile-top .logo i {
      margin-right: 0.5rem;
    }

    .mobile-search {
      padding: 0.5rem 1rem;
    }

    .mobile-search input {
      width: 100%;
      padding: 0.5rem;
      border-radius: 4px;
      border: none;
    }

    /* Sidebar */
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

    .sidebar a i {
      margin-right: 8px;
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

    .hero {
      background: linear-gradient(135deg, #ff9a9e, #fad0c4);
      color: #333;
      text-align: center;
      padding: 3rem 1rem;
    }

    .hero h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .hero p {
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
    }

    .hero button {
      background-color: #111;
      color: white;
      padding: 0.8rem 1.5rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .category-section {
      padding: 1rem;
    }

    .category-section h3 {
      margin-bottom: 0.5rem;
      font-size: 1.3rem;
    }

    .product-row {
     display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 1rem;
    padding-bottom: 1rem;
    scroll-behavior: smooth;
      }

    .product-card {
      min-width: 160px;
      background-color: white;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
        flex-shrink: 0;
    }

    .product-card img {
      width: 100%;
      height: 150px;
      object-fit: contain;
      margin-bottom: 0.5rem;
    }

    .product-card h4 {
      font-size: 1rem;
      margin-bottom: 0.25rem;
    }

    .product-card p {
      color: #555;
      margin-bottom: 0.5rem;
    }

    .product-card button {
      background-color: #111;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      cursor: pointer;
    }

    #categorySections{
      width: 100%;
      height: 60vh;
      overflow-y: auto;
      padding: 1rem;
      box-sizing: border-box;
    }

    footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 1rem;
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
      <input type="text" placeholder="Search products...">
    </div>
    <nav>
      <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
      <a href="cart.html"><i class="fas fa-cart-shopping"></i> Cart</a>
      <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    </nav>
  </div>

  <!-- Mobile Navbar -->
  <div class="mobile-navbar">
    <div class="mobile-top">
      <div class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
      <div class="logo"><i class="fas fa-store"></i> ShopEase</div>
    </div>
    <div class="mobile-search">
      <input type="text" placeholder="Search products...">
    </div>
  </div>

  <!-- Sidebar Menu -->
  <div class="sidebar" id="sidebar">
    <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    <a href="cart.html"><i class="fas fa-cart-shopping"></i> Cart</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
  </div>
  <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

  <section class="hero">
    <h2>🔥 Mega Deals Everyday!</h2>
    <p>Shop the latest electronics, fashion, and more</p>
    <button>Explore Now</button>
  </section>

  <div id="categorySections">
  <h3>categories</h3><br>
  <div class="product-row">
    <div class="product-card">
      <img src="S.jpg" alt="image not found">
      <h4>product1</h4>
      <p>product1</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="sp.png" alt="image not found">
      <h4>product2</h4>
      <p>product2</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product3</h4>
      <p>product3</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>

    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product5</h4>
      <p>product5</p>
      <button>Add to Cart</button>
    </div>
  </div>
</div> <div id="categorySections">
  <h3>categories</h3><br>
  <div class="product-row">
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product1</h4>
      <p>product1</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product2</h4>
      <p>product2</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product3</h4>
      <p>product3</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>

    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product4</h4>
      <p>product4</p>
      <button>Add to Cart</button>
    </div>
    
    <div class="product-card">
      <img src="" alt="image not found">
      <h4>product5</h4>
      <p>product5</p>
      <button>Add to Cart</button>
    </div>
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

    // const categories = ['Electronics', 'Fashion', 'Accessories'];
    // const container = document.getElementById('categorySections');

    // const categoryMap = {
    //   'Electronics': [],
    //   'Fashion': [],
    //   'Accessories': []
    // };

    // for (let i = 1; i <= 50; i++) {
    //   const cat = categories[i % 3];
    //   categoryMap[cat].push({
    //     name: `Product ${i}`,
    //     price: `$${(Math.random() * 100 + 10).toFixed(2)}`,
    //     image: `https://picsum.photos/200?random=${i}`
    //   });
    // }

    // categories.forEach(cat => {
    //   const section = document.createElement('div');
    //   section.className = 'category-section';
    //   section.innerHTML = `<h3>${cat}</h3><div class="product-row">${categoryMap[cat].map(prod => `
    //     <div class="product-card">
    //       <img src="${prod.image}" alt="${prod.name}">
    //       <h4>${prod.name}</h4>
    //       <p>${prod.price}</p>
    //       <button>Add to Cart</button>
    //     </div>`).join('')}</div>`;
    //   container.appendChild(section);
    // });
  </script>

</body>
</html>
