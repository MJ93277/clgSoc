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
        <a href="#services" class="text-gray-700 hover:text-yellow-500 font-medium">Services</a>
        <a href="#projects" class="text-gray-700 hover:text-yellow-500 font-medium">Projects</a>
        <a href="about.php" class="text-gray-700 hover:text-yellow-500 font-medium">About</a>
        <a href="login.php" class="text-gray-700 hover:text-yellow-500 font-medium">Login</a>
        <a href="contect.php" class="text-gray-700 hover:text-yellow-500 font-medium">Contact Us</a>
    </nav>
  </div>
</header>
<body>
<!-- About Us Section -->
  <section id="about" class="pt-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
      <div>
        <h3 class="text-4xl font-bold mb-4 text-yellow-600">About Us</h3>
        <p class="text-lg mb-6">
          We are a group of passionate architects who believe in creating spaces that are both functional and inspiring. Our team works closely with clients to understand their needs, blending creativity with technical expertise to bring ideas to life. We take pride in transforming dreams into reality, ensuring that every project reflects the unique vision and purpose of its occupants. From residential to commercial projects, we approach every challenge with a commitment to quality and sustainability. At UrArchitect, we are dedicated to making every design experience seamless and memorable, always putting the client's needs first.
        </p>
      </div>
      <div>
        <!-- Lottie Animation for Architecture -->
        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_jcikwtux.json" background="transparent" speed="1" loop autoplay></lottie-player>
      </div>
    </div>
  </section>

  <!-- Services Section -->
<section id="services" class="py-20 bg-gray-100">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h3 class="text-3xl font-bold mb-10 text-yellow-600">Our Services</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      <!-- <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">Residential Design</h4>
        <p>Custom homes that blend style with functionality, built to suit your lifestyle and dreams.</p>
      </div> -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">Commercial Spaces</h4>
        <p>Modern, efficient, and aesthetic workspaces designed to boost productivity and appeal.</p>
      </div>
      <!-- <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">3D Visualization</h4>
        <p>Bring your ideas to life with stunning 3D renders and walkthroughs that inspire and engage.</p>
      </div> -->
      <!-- Additional Development Services -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">Web Development</h4>
        <p>Building responsive and user-friendly websites for architects and design firms, with custom features and integration.</p>
      </div>
      <!-- <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">Custom Software Solutions</h4>
        <p>Creating tailored software tools for design visualization, project management, and workflow optimization.</p>
      </div> -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">Digital Portfolio Development</h4>
        <p>Developing online portfolios for architects and designers to showcase their work in a visually engaging and professional way.</p>
      </div>
      <!-- New Services Added -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">Chatting System</h4>
        <p>Integrating real-time chat systems into your website, enabling seamless communication between architects and clients for quicker project discussions and feedback.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">Manage Dashboard</h4>
        <p>Building powerful, user-friendly dashboards for architects to manage projects, timelines, and client communications all in one place.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h4 class="text-xl font-semibold mb-2">Connect with Specified Location Architect</h4>
        <p>Creating a feature that allows clients to find and connect with architects based on their specific location or project requirements, making the process more targeted and efficient.</p>
      </div>
    </div>
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