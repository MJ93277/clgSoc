<?php
// Start the session to access session data
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");  // Redirect to login page if not logged in
  exit();
}

// Get user details from session (example: username)
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UrArchitect</title>
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
      background-color: #facc15;
      /* Tailwind's yellow-400 */
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
      <!-- <h1 class="text-2xl font-bold text-yellow-600">UrArchitect</h1> -->
      <a href="cuser.php" class="flex items-center space-x-2 group">
        <h1 class="text-2xl font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
          link<span class="text-gray-800 ">io</span>
        </h1>
      </a>
      <nav class="space-x-6">
        <!-- <a href="cchat.php" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Chats</a> -->
        <a href="testf.php" class="text-gray-700 hover:text-yellow-500 font-medium">Find Architect</a>
        <a href="#services" class="text-gray-700 hover:text-yellow-500 font-medium">Services</a>
        <a href="#projects" class="text-gray-700 hover:text-yellow-500 font-medium">Projects</a>
        <a href="#about" class="text-gray-700 hover:text-yellow-500 font-medium">About</a>
        <a href="#contact" class="text-gray-700 hover:text-yellow-500 font-medium">Contact Us</a>
        <a href="logout.php" class="text-gray-700 hover:text-yellow-500 font-medium">Logout</a>
        <span class="text-lg text-yellow-600">Welcome, <?php echo htmlspecialchars($username); ?></span> <!-- Welcome Message -->

      </nav>
    </div>
  </header>

  <br><br>

  <!-- 🌟 Hero Section -->

  <section class="relative bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center" d style="background-image: url('photos/hero-bg.png');">

    <!-- Glass Overlay -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-md"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 grid grid-cols-1 md:grid-cols-2 gap-16 items-center text-white">

      <!-- 🎯 Left: Content -->
      <div class="space-y-8 animate-fade-in-down">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight tracking-tight text-yellow-400 drop-shadow-2xl">
          Designing Dreams,<br><span class="text-white">Building Futures</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-200 leading-relaxed">
          At <span class="text-yellow-400 font-semibold">UrArchitect</span>, we blend modern design with timeless vision to craft spaces that inspire, function, and endure.
        </p>
        <div class="flex gap-4">
          <a href="main.php" class="px-6 py-3 rounded-full bg-yellow-500 hover:bg-yellow-600 transition text-white font-medium text-sm shadow-lg">
            Explore Projects
          </a>
          <a href="#contact" onclick="scrollToSection(event, 'contact')" class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 border border-white text-white text-sm font-medium transition backdrop-blur">
            Contact Us
          </a>
        </div>
      </div>

      <!-- 🏞️ Right: Image Card -->
      <div class="relative group">
        <div class="overflow-hidden rounded-2xl shadow-2xl border-2 border-white/20 transform transition duration-500 group-hover:scale-105 group-hover:rotate-1">
          <img src="gallery/home.png" alt="Hero Design" class="w-full h-auto object-cover" />
        </div>
        <!-- Floating Label -->
        <div class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 bg-yellow-500 text-white px-4 py-1 text-sm font-semibold rounded-full shadow-md">
          Premium Architecture
        </div>
      </div>

    </div>

    <!-- ⬇️ Scroll Cue -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-20">
      <div class="animate-bounce text-white text-2xl opacity-70">
        <i class="fas fa-angle-down"></i>
      </div>
    </div>
  </section>

  <!-- 💼 About Us Section -->
  <section id="about" class="pt-28 pb-20 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

      <!-- 🧱 Left Content -->
      <div class="space-y-6 animate-fade-in-down">
        <h3 class="text-4xl sm:text-5xl font-extrabold text-yellow-500 leading-snug tracking-tight drop-shadow-md">
          Who <span class="text-gray-800 dark:text-white">We Are</span>
        </h3>
        <p class="text-lg sm:text-xl text-gray-700 dark:text-gray-300 leading-relaxed">
          At <span class="text-yellow-500 font-semibold">UrArchitect</span>, we are a collective of passionate minds dedicated to transforming spaces into timeless stories. Our goal is to design environments that are as functional as they are inspiring — from visionary residential projects to cutting-edge commercial architecture.
        </p>
        <p class="text-md sm:text-lg text-gray-600 dark:text-gray-400">
          With a deep focus on client collaboration, sustainability, and innovative design, we bring every dream to life with unmatched quality and professionalism. Your vision is our blueprint.
        </p>
        <a href="#contact" onclick="scrollToSection(event, 'contact')" class="inline-block mt-4 bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-full shadow-md transition duration-300 font-medium text-sm">
          Get in Touch
        </a>
      </div>
      <!-- 🎥 Enhanced Lottie Animation Block -->
      <div class="relative group animate-fade-in-down">
        <div class="relative w-full rounded-3xl overflow-hidden shadow-2xl border border-yellow-500/20 bg-gradient-to-tr from-white via-yellow-50 to-yellow-100 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 p-3 transition-all duration-500 group-hover:scale-105 group-hover:shadow-yellow-300/30">

          <!-- Lottie Animation -->
          <lottie-player
            src="https://assets10.lottiefiles.com/packages/lf20_jcikwtux.json"
            background="transparent"
            speed="1"
            loop
            autoplay
            class="w-full h-[300px] md:h-[400px] rounded-2xl">
          </lottie-player>

          <!-- 🧩 Decorative Circle -->
          <div class="absolute -top-4 -left-4 w-16 h-16 bg-yellow-400 opacity-20 rounded-full blur-2xl pointer-events-none"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Other sections similar to your original code -->
  <!-- (You can modify them based on user needs, for example, personalized content for the logged-in user) -->

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


  <!-- Featured Projects Section with Background Image like Hero -->
  <section id="projects" class="relative bg-cover bg-center bg-no-repeat py-24" style="background-image: url('https://images.unsplash.com/photo-1505843513577-22bb7d21e455?auto=format&fit=crop&w=1350&q=80');">
    <div class="bg-black bg-opacity-60 absolute inset-0 z-0"></div> <!-- Dark overlay -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center text-white">
      <h3 class="text-3xl font-bold text-yellow-400 mb-10">Featured Projects</h3>
      <div class="carousel-container flex justify-center space-x-4">

        <!-- Project 1 -->
        <div class="w-1/3 px-2 group">
          <div class="transition duration-500 transform group-hover:scale-110 group-hover:-translate-y-1 group-hover:-rotate-1 group-hover:shadow-2xl rounded-lg overflow-hidden ring-2 ring-transparent group-hover:ring-yellow-400">
            <img onclick="showPopup('photos/project 2.jpg')" src="photos/project 2.jpg" alt="Project 2"
              class="w-full h-60 object-cover rounded-lg cursor-pointer group-hover:brightness-110 hover-effect">
          </div>
        </div>

        <!-- Project 2 -->
        <div class="w-1/3 px-2 group">
          <div class="transition duration-500 transform group-hover:scale-110 group-hover:-translate-y-1 group-hover:-rotate-1 group-hover:shadow-2xl rounded-lg overflow-hidden ring-2 ring-transparent group-hover:ring-yellow-400">
            <img onclick="showPopup('photos/project 2.jpg')" src="photos/project 2.jpg" alt="Project 2"
              class="w-full h-60 object-cover rounded-lg cursor-pointer group-hover:brightness-110 hover-effect">
          </div>
        </div>

        <!-- Project 3 -->
        <div class="w-1/3 px-2 group">
          <div class="transition duration-500 transform group-hover:scale-110 group-hover:-translate-y-1 group-hover:rotate-1 group-hover:shadow-2xl rounded-lg overflow-hidden ring-2 ring-transparent group-hover:ring-yellow-400">
            <img onclick="showPopup('photos/project 3.jpg')" src="photos/project 3.jpg" alt="Project 3"
              class="w-full h-60 object-cover rounded-lg cursor-pointer group-hover:brightness-110 hover-effect">
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Image Popup Modal -->
  <div id="popupModal" class="fixed inset-0 bg-black bg-opacity-5 hidden items-center justify-center z-50 backdrop-blur-sm">
    <div class="relative bg-white rounded-lg shadow-lg p-2 max-w-3xl w-full">
      <button onclick="closePopup()" class="absolute top-2 right-4 text-2xl text-gray-700 hover:text-red-500 font-bold">&times;</button>
      <img id="popupImage" src="" alt="Popup Project" class="w-full h-auto rounded-lg">
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function showPopup(imageSrc) {
      const modal = document.getElementById('popupModal');
      const popupImage = document.getElementById('popupImage');
      popupImage.src = imageSrc;
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closePopup() {
      const modal = document.getElementById('popupModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  </script>



  <section id="contact" class="py-24 bg-gradient-to-b from-blue-100 to-white dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-5xl mx-auto px-6">

      <!-- Heading -->
      <div class="text-center mb-12">
        <h3 class="text-4xl font-bold text-yellow-600 mb-3">Contact Us</h3>
        <p class="text-gray-600 dark:text-gray-300 text-lg max-w-xl mx-auto">
          Whether you have a question, project idea, or just want to connect — we're here for you.
        </p>
      </div>

      <!-- Contact Form Card -->
      <div class="bg-blue-300 dark:bg-gray-900 shadow-xl rounded-2xl p-10 border border-yellow-100 dark:border-gray-700">
        <!-- <form action="#" method="POST" class="space-y-6"> -->
        <form action="https://formsubmit.co/yourmail.com" method="POST" class="space-y-6">

          <input type="hidden" name="_captcha" value="false">
          <input type="hidden" name="_next" value="http://localhost/simple/index.php">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="text" name="name" placeholder="Full Name" required
              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-yellow-500 focus:outline-none transition">
            <input type="email" name="email" placeholder="Email Address" required
              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-yellow-500 focus:outline-none transition">
          </div>

          <textarea name="message" rows="5" placeholder="Your Message" required
            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-yellow-500 focus:outline-none transition"></textarea>

          <div class="text-center">
            <button type="submit"
              class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-8 py-3 rounded-full shadow-md transition duration-300">
              Send Message
            </button>
          </div>

        </form>
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