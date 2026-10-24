<?php
// Start the session to access session data
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login page if not logged in
    exit();
}

// Get user details from session (example: username)
// $re_id = $_GET['user_id'];
// $_SESSION['archi_id'] = $_GET['user_id'];
$_SESSION['archi_id'] = $_GET['user_id'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>UrArchitect - Chat</title>
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
<!-- <body class="bg-gray-50 text-gray-800"> -->
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">



<!-- header start -->
  <header class="bg-white shadow fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      
        <h1 class="text-2xl select-none font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
          LINK<span class="text-gray-800 dark:text-white">IO</span>
        </h1>
 
      <a href="javascript:history.back()" class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm">
  ← Go Back
</a>
    </div>
  </header>


<!-- Header end-->

<!-- Chat Content start -->

    <!-- Chat Interface -->
<!-- <main class="pt-24 h-[80vh] max-w-7xl mx-auto bg-gray-200 rounded shadow flex overflow-hidden"> -->
    <!-- Chat Content start -->
<div class="flex-1 flex justify-center">
  <main class="pt-24 w-full max-w-7xl bg-gray-200 rounded shadow flex overflow-hidden">




<!-- Right Chat Panel -->
<section class="w-2/3 bg-gray-100 ml-56 flex flex-col items-center justify-center">
<!-- <section class="w-2/3 bg-gray-100 ml-56 flex flex-col items-center justify-start h-[80vh]"> -->
  <!-- Chat header -->
  <div class="p-4 border-b border-gray-300 bg-white w-full">
    <h3 class="text-lg font-semibold text-gray-700 text-center">Welcome to chat</h3>
  </div>

  <!-- Chat messages -->
  <!-- Chat Interface -->
<div class="flex-1 p-6 overflow-y-auto flex items-center justify-center text-gray-500 text-xl w-full">
  Welcome to UrArchitect
</div>

<div id="chatBox" class="p-6 w-full space-y-2 bg-white overflow-y-auto h-96">
  <?php
  // Fetching messages from database
  require 'dbh.php'; 
  $sender_id = $_SESSION['user_id'];
  $receiver_id = $_SESSION['archi_id'];
  
  $query = "SELECT * FROM messages 
            WHERE (sender_id = $sender_id AND receiver_id = $receiver_id) 
               OR (sender_id = $receiver_id AND receiver_id = $sender_id)
            ORDER BY timestamp ASC";

  $result = mysqli_query($conn, $query);

 try {
    while ($row = mysqli_fetch_assoc($result)) {
        $msg = htmlspecialchars($row['message']);
        $isOwn = $row['sender_id'] == $sender_id;

        echo '<div class="' . ($isOwn ? 'text-right' : 'text-left') . '">';
        echo '<span class="inline-block px-4 py-2 rounded-lg ' .
             ($isOwn ? 'bg-yellow-200' : 'bg-gray-300') . '">' .
             $msg .
             '</span></div>';
    }
} catch (Throwable $e) {
    echo "This Profile is not updated till yet and cannot be chat with this user.";
}
  ?>
</div>
 

<!-- Message input area -->
<div class="p-4 border-t border-gray-300 bg-white w-full">
  <div class="flex items-center space-x-2 w-full justify-center">
    <form id="messageForm" method="POST">
      <!-- Hidden Inputs for sender_id and receiver_id -->
      <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user_id']; ?>">
      <input type="hidden" name="receiver_id" value="<?php echo $_SESSION['archi_id']; ?>">

      <!-- Message Input -->
      <input type="text" id="messageInput" name="message" placeholder="Type a message..." class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400 w-2/3">
    
      <!-- Send Button -->
      <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-600">
        Send
      </button>
    </form>
  </div>
</div>





<!-- Message display area -->
<script>
    // auto scrolling start
   window.addEventListener('load', () => {
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
  });
    // auto scrolling end


  // Handle the form submission via AJAX
  document.getElementById('messageForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent the default form submission

    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value.trim();

    if (message === '') {
      alert("Please enter a message");
      return;
    }

    // Get the sender_id and receiver_id from hidden inputs
    const sender_id = document.querySelector('[name="sender_id"]').value;
    const receiver_id = document.querySelector('[name="receiver_id"]').value;

    // Prepare data to send in the AJAX request
    const data = new FormData();
    data.append('sender_id', sender_id);
    data.append('receiver_id', receiver_id);
    data.append('message', message);

    // AJAX request to send the message
    fetch('send-message.php', {
      method: 'POST',
      body: data
    })
    .then(response => response.text())
    .then(data => {
      if (data === 'Message sent successfully') {
        // Add the new message to the chatBox (client-side)
        const chatBox = document.getElementById('chatBox');
        chatBox.innerHTML += `<div class="text-right"><span class="inline-block bg-yellow-200 px-4 py-2 rounded-lg">${message}</span></div>`;
        
        // Clear the input field
        messageInput.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;
      } else {
        console.error('Message sending failed:', data);
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
</script>




</section>

</main>
</div>


<!-- Chat Content end-->

<!-- Footer -->
<footer class="bg-gray-800 text-white py-4">
  <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-start md:items-center text-center md:text-left">
    
    <!-- Left Side: Copyright + Legal -->
    <div class="mb-4 md:mb-0">
      <p>&copy; 2025 UrArchitect. All rights reserved.</p>
      <div class="mt-1 text-sm">
        <a href="#" class="text-gray-400 hover:text-yellow-600">Privacy Policy</a> |
        <a href="#" class="text-gray-400 hover:text-yellow-600">Terms of Service</a>
      </div>
    </div>

    <div class="flex justify-center space-x-4 mt-3">
    <a href="https://www.linkedin.com" target="_blank" class="text-gray-400 hover:text-yellow-600 transition duration-200">
      <i class="fab fa-linkedin text-xl"></i>
    </a>
    <a href="https://www.facebook.com" target="_blank" class="text-gray-400 hover:text-yellow-600 transition duration-200">
      <i class="fab fa-facebook text-xl"></i>
    </a>
    <a href="https://www.instagram.com" target="_blank" class="text-gray-400 hover:text-yellow-600 transition duration-200">
      <i class="fab fa-instagram text-xl"></i>
    </a>
  </div>

    <!-- Right Side: Contact Info -->
    <div class="text-right text-sm">
      <p>Email: <a href="mailto:info@urarchitect.com" class="text-yellow-500 hover:text-yellow-400">info@urarchitect.com</a></p>
      <p>Phone: <a href="tel:+1234567890" class="text-yellow-500 hover:text-yellow-400">+1 234 567 890</a></p>
      <p>Office: 123 Architecture St, Cityname, Country</p>
    </div>
  </div>

  <!-- Social Media (Centered Below) -->
 
</footer>


</body>
</html>
