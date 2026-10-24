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

// $_SESSION['archi_id'] = htmlspecialchars($_POST['c_id']);
$_SESSION['archi_id'] = $_POST['conversation_id'];
echo  $_POST['conversation_id'];


// $_SESSION['archi_id'] = $_POST['c_id'];
if (isset($_POST['conversation_id'])) {
  $conversation_id = $_POST['conversation_id'];
} else {
  $conversation_id = null; // or handle the error
}

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

    #chatBox::-webkit-scrollbar {
  width: 6px;
}
#chatBox::-webkit-scrollbar-thumb {
  background-color: rgba(0,0,0,0.2);
  border-radius: 3px;
}

  </style>
</head>
<!-- <body class="bg-gray-50 text-gray-800"> -->
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

<!-- header start -->
  <header class="bg-white shadow fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
     <a href="userindex.php" class="flex items-center space-x-2 group">
        <h1 class="text-2xl font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
          link<span class="text-gray-800 dark:text-white">io</span>
        </h1>
      </a>
      <a href="javascript:history.back()" class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm">
  ← Go Back
</a>
    </div>
  </header>


<!-- Header end-->

<!-- Chat Interface -->
<div class="flex-1 flex justify-center">
  <!-- <main class="pt-24 w-full max-w-7xl bg-gray-200 rounded shadow flex overflow-hidden"> -->
    <main class="pt-24 pb-32 w-full max-w-7xl bg-gray-200 rounded shadow flex overflow-hidden flex-1">

    <!-- Right Chat Panel -->
    <!-- <section class="w-2/3 bg-gray-100 ml-56 flex flex-col h-[80vh] rounded-lg overflow-hidden"> -->
      <section class="w-2/3 bg-gray-100 ml-56 flex flex-col h-[70vh] rounded-lg overflow-hidden">


      <!-- Chat header -->
      <div class="p-4 border-b border-gray-300 bg-white w-full text-center">
        <h3 class="text-lg font-semibold text-gray-700">Chat with Architect</h3>
      </div>

      <!-- Chat messages -->
      <!-- <div id="chatBox" class="flex-1 p-4 space-y-3 bg-white overflow-y-auto"> -->
      <div id="chatBox" class="p-4 space-y-3 bg-white overflow-y-auto" style="height: calc(80vh - 132px);">

        <?php
        require 'dbh.php'; 
        $sender_id = $_SESSION['user_id'];
        $receiver_id = $_SESSION['archi_id'];

        $query = "SELECT * FROM messages 
                  WHERE (sender_id = $sender_id AND receiver_id = $receiver_id) 
                     OR (sender_id = $receiver_id AND receiver_id = $sender_id)
                  ORDER BY timestamp ASC";

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $msg = htmlspecialchars($row['message']);
            $isOwn = $row['sender_id'] == $sender_id;

            echo '<div class="flex ' . ($isOwn ? 'justify-end' : 'justify-start') . '">';
            echo '<div class="max-w-xs sm:max-w-md px-4 py-2 rounded-lg text-sm shadow ' . 
                 ($isOwn ? 'bg-yellow-200 text-gray-800' : 'bg-gray-300 text-gray-800') . '">' . 
                 $msg . 
                 '</div></div>';
        }
        ?>
      </div>

      <!-- Message input area -->
      <div class="p-4 border-t border-gray-300 bg-white">
        <form id="messageForm" method="POST" class="flex items-center space-x-3">
          <!-- Hidden Inputs -->
          <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user_id']; ?>">
          <input type="hidden" name="receiver_id" value="<?php echo $_SESSION['archi_id']; ?>">

          <!-- Message Input -->
          <input type="text" id="messageInput" name="message" placeholder="Type your message..." 
            class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400 bg-gray-50" />

          <!-- Send Button -->
          <button type="submit" 
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-full shadow-md transition">
            Send
          </button>
        </form>
      </div>

      <script>
        window.addEventListener('load', () => {
          const chatBox = document.getElementById('chatBox');
          chatBox.scrollTop = chatBox.scrollHeight;
        });

        document.getElementById('messageForm').addEventListener('submit', function(event) {
          event.preventDefault();

          const messageInput = document.getElementById('messageInput');
          const message = messageInput.value.trim();
          if (message === '') {
            alert("Please enter a message");
            return;
          }

          const sender_id = document.querySelector('[name="sender_id"]').value;
          const receiver_id = document.querySelector('[name="receiver_id"]').value;

          const data = new FormData();
          data.append('sender_id', sender_id);
          data.append('receiver_id', receiver_id);
          data.append('message', message);

          fetch('send-message.php', {
            method: 'POST',
            body: data
          })
          .then(response => response.text())
          .then(data => {
            if (data === 'Message sent successfully') {
              const chatBox = document.getElementById('chatBox');
              chatBox.innerHTML += `<div class="flex justify-end"><div class="max-w-xs sm:max-w-md px-4 py-2 rounded-lg text-sm shadow bg-yellow-200 text-gray-800">${message}</div></div>`;
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

<footer class="bg-gray-800 text-white py-4 fixed bottom-0 left-0 w-full z-40">
  <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-start md:items-center text-center md:text-left">
    
    <!-- Left Side: Copyright + Legal -->
    <div class="mb-4 md:mb-0">
      <p>&copy; 2025 UrArchitect. All rights reserved.</p>
      <div class="mt-1 text-sm">
        <a href="#" class="text-gray-400 hover:text-yellow-600">Privacy Policy</a> |
        <a href="#" class="text-gray-400 hover:text-yellow-600">Terms of Service</a>
      </div>
    </div>

    <!-- Social Media -->
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
</footer>



</body>
</html>
