<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>UrArchitect - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  
  <!-- Lottie Player Script (only included once) -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

  <style>
    /* Smooth scrolling with reduced speed */
    html {
      scroll-behavior: smooth;
    }
    body {
      scroll-behavior: smooth;
    }
      /* header start  */

    @keyframes slideDownFade {
    0% {
        opacity: 0;
        transform: translateY(-20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-slide-down {
      animation: slideDownFade 0.6s ease-out forwards;
    }

    .sticky-header {
    transition: all 0.3s ease;
    }
    .sticky-header.shrink {
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
      background-color: #facc15; /* Tailwind's yellow-400 */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

      /* header end  */

      /* Custom styles for the carousel */
    .carousel-container {
      position: relative;
      overflow: hidden;
    }
    .carousel-images {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }
    .carousel-images img {
      width: 100%;
      object-fit: cover;
    }
    .carousel-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 10px;
      border-radius: 50%;
      cursor: pointer;
    }
    .carousel-button-left {
      left: 10px;
    }
    .carousel-button-right {
      right: 10px;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Header -->
 <header id="main-header" class="bg-yellow-100 shadow fixed w-full top-0 z-50 animate-slide-down sticky-header">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6 transition-all duration-300">
    <a href="index.php">
      <h1 class="text-2xl font-bold text-yellow-600">UrArchitect</h1>
    </a>
    <nav class="space-x-6">
        <a href="testf.php" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Find Architect</a>
        <a href="services.php" class="text-gray-700 hover:text-yellow-500 font-medium">Services</a>
        <a href="project.php" class="text-gray-700 hover:text-yellow-500 font-medium">Projects</a>
        <a href="about.php" class="text-gray-700 hover:text-yellow-500 font-medium">About</a>
        <a href="login.php" class="text-gray-700 hover:text-yellow-500 font-medium">Login</a>
        <a href="contect.php" class="text-gray-700 hover:text-yellow-500 font-medium">Contact Us</a>
    </nav>
  </div>
</header>
<body>
<!-- Contact Us Section -->
  <section id="contact" class="py-20 bg-blue-100">
    <div class="max-w-3xl mx-auto px-6">
      <h3 class="text-3xl font-bold text-center text-yellow-600 mb-8">Contact Us</h3>
      <form action="#" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        <input type="text" name="name" placeholder="Your Name" class="w-full border px-4 py-2 rounded" required>
        <input type="email" name="email" placeholder="Your Email" class="w-full border px-4 py-2 rounded" required>
        <textarea name="message" rows="4" placeholder="Your Message" class="w-full border px-4 py-2 rounded" required></textarea>
        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">Send Message</button>
      </form>
    </div>
  </section>
<!-- Footer -->
<footer class="bg-gray-800 text-white py-8">
  <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-start md:items-center text-center md:text-left">
    
    <!-- Left Side: Copyright + Legal -->
    <div class="mb-6 md:mb-0">
      <p>&copy; 2025 UrArchitect. All rights reserved.</p>
      <div class="mt-2">
        <a href="#" class="text-gray-400 hover:text-yellow-600">Privacy Policy</a> |
        <a href="#" class="text-gray-400 hover:text-yellow-600">Terms of Service</a>
      </div>
    </div>

    <!-- Right Side: Contact Info -->
    <div class="text-right">
      <p>Email: <a href="mailto:info@urarchitect.com" class="text-yellow-500 hover:text-yellow-400">info@urarchitect.com</a></p>
      <p>Phone: <a href="tel:+1234567890" class="text-yellow-500 hover:text-yellow-400">+1 234 567 890</a></p>
      <p>Office: 123 Architecture St, Cityname, Country</p>
    </div>
  </div>

  <!-- Social Media (Centered Below) -->
  <div class="flex justify-center space-x-6 mt-6">
    <a href="https://www.linkedin.com" target="_blank" class="text-gray-400 hover:text-yellow-600 transition duration-200">
      <i class="fab fa-linkedin text-2xl"></i>
    </a>
    <a href="https://www.facebook.com" target="_blank" class="text-gray-400 hover:text-yellow-600 transition duration-200">
      <i class="fab fa-facebook text-2xl"></i>
    </a>
    <a href="https://www.instagram.com" target="_blank" class="text-gray-400 hover:text-yellow-600 transition duration-200">
      <i class="fab fa-instagram text-2xl"></i>
    </a>
  </div>
</footer>


<style>
  .hover-effect:hover {
    transform: scale(1.1) translateY(-5px) rotate(2deg);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    filter: brightness(1.1);
  }
</style>

</body>
</html>