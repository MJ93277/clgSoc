<?php

include "dbh.php";
// Start the session to access session data
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");  // Redirect to login page if not logged in
  exit();
}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id,);
$stmt->execute();
$result = $stmt->get_result();

if ($_SESSION['role'] === 'Client') {
  echo "<script>window.location.href = 'cuser.php';</script>";
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
      <!-- <h1 class="text-white bg-yellow-500 text-xl font-extrabold px-4 py-2 rounded-full shadow-md tracking-wide  select-none  pointer-events-none inline-block  flex items-center justify-center">UrArchitect</h1> -->

      <a href="userindex.php" class="flex items-center space-x-2 group">
        <h1 class="text-2xl font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
          LINK<span class="text-gray-800 ">IO</span>
        </h1>
      </a>

      <nav class="space-x-6">
        <a href="dashboard.php" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Dashboard</a>
        <a href="testf.php" class="text-gray-700 hover:text-yellow-500 font-medium">Find new Creators</a>
        <!-- <a href="#" onclick="scrollToSection(event, 'about')" class="text-gray-700 hover:text-yellow-500 font-medium">About</a> -->
        <!-- <a href="#" onclick="scrollToSection(event, 'services')" class="text-gray-700 hover:text-yellow-500 font-medium">Features</a> -->
        <!-- <a href="#" onclick="scrollToSection(event, 'projects')" class="text-gray-700 hover:text-yellow-500 font-medium">Projects</a> -->
        <!-- <a href="#" onclick="scrollToSection(event, 'contact')" class="text-gray-700 hover:text-yellow-500 font-medium">Contact Us</a> -->
        <a href="logout.php" class="text-gray-700 hover:text-yellow-500 font-medium">Logout</a>
        <span class="text-lg text-yellow-600">Welcome, <?php echo htmlspecialchars($username); ?></span> <!-- Welcome Message -->

      </nav>
    </div>
  </header>

  <br><br>


  
  <!-- 🌟 Hero Section -->

  <section class="relative bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center" d style="background-image: url('photos/hero-bg.jpg');">

    <!-- Glass Overlay -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-md"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-24 grid grid-cols-1 md:grid-cols-2 gap-16 items-center text-white">

      <!-- 🎯 Left: Content -->
      <div class="space-y-8 animate-fade-in-down">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight tracking-tight text-yellow-400 drop-shadow-2xl">
          Build Your<br><span class="text-white">Future here</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-200 leading-relaxed">
          At <span class="text-yellow-400 font-semibold">Linkio</span>, Welcome to modern social media platform.
        </p>
        <div class="flex gap-4">
          <a href="main.php" class="px-6 py-3 rounded-full bg-yellow-500 hover:bg-yellow-600 transition text-white font-medium text-sm shadow-lg">
            Explore Creators
          </a>
          <a href="#contact" onclick="scrollToSection(event, 'contact')" class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 border border-white text-white text-sm font-medium transition backdrop-blur">
            Contact Us
          </a>
        </div>
      </div>

      <!-- 🏞️ Right: Image Card -->
      <div class="relative group">
        <div class="overflow-hidden rounded-2xl shadow-2xl border-2 border-white/20 transform transition duration-500 group-hover:scale-105 group-hover:rotate-1">
          <img src="gallery/home.webp" alt="Hero Design" class="w-full h-auto object-cover" />
        </div>
        <!-- Floating Label -->
        <div class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 bg-yellow-500 text-white px-4 py-1 text-sm font-semibold rounded-full shadow-md">
          
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



  <!-- Other sections similar to your original code -->
  <!-- (You can modify them based on user needs, for example, personalized content for the logged-in user) -->

  <!-- About Us Section -->
    <section id="about" class="pt-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
      <div>
        <h3 class="text-4xl font-bold mb-4 text-yellow-600">About Us</h3>
        <p class="text-lg mb-6">

          We are a social media platform designed to connect people from different walks of life and make sharing not only simple but also meaningful. Our platform gives you the freedom to create a personalized profile where you can express yourself, showcase your interests, and build your digital identity. Whether it’s sharing photos, videos, or your everyday thoughts, you can engage with your friends and followers while staying updated with the topics, trends, and stories that matter most to you.

          We believe social media should be more than just endless scrolling. It should be a place where you create memories, explore new ideas, learn from others, and strengthen relationships. By bringing people closer and making every interaction smooth, engaging, and enjoyable, we are committed to transforming the way you experience the online world.</p>
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
      <h3 class="text-3xl font-bold mb-10 text-yellow-600">Features</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="text-xl font-semibold mb-2">User Profiles</h4>
          <p>Create personalized profiles with bio, photos, and activity to showcase your online presence.</p>
        </div>

        <!-- Additional Development Services -->
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="text-xl font-semibold mb-2">New feed</h4>
          <p>Stay updated with posts, stories, and updates from people you follow in a real-time feed.</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="text-xl font-semibold mb-2">Messaging & Chats</h4>
          <p>Connect instantly with friends through private messages, group chats, and media sharing.</p>
        </div>
        <!-- New Services Added -->
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="text-xl font-semibold mb-2">Content sharing</h4>
          <p>Post photos, videos, and thoughts to express yourself and engage with your audience.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="text-xl font-semibold mb-2">Notificaiton</h4>
          <p>Get real-time alerts for likes, comments, friend requests, and new messages.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <h4 class="text-xl font-semibold mb-2">Groups & Communities</h4>
          <p>Join or create groups around shared interests, events, and hobbies to connect with like-minded people.</p>
        </div>
      </div>
    </div>
  </section>

<section id="contact" class="py-24 bg-gradient-to-b from-blue-100 to-white dark:from-gray-900 dark:to-gray-800">
  <div class="max-w-5xl mx-auto px-6">
    
    <!-- Heading -->
    <div class="text-center mb-12">
      <h3 class="text-4xl font-bold text-yellow-600 mb-3">Contact Us</h3>
      <p class="text-gray-600 dark:text-gray-300 text-lg max-w-xl mx-auto">
         Whether you have a question, Suggestion, or just want to give feedback — we're here for you.
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