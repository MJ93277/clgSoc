<?php include "dbh.php"; ?>
<!doctype html>
<html>

<head>
  <link rel="stylesheet" href="maindesign.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">


  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


  <script>
    // arrow start 
    $(document).on("click", ".arrow", function() {
      const card = $(this).closest(".card");
      const username = card.find("strong").text().split(" #")[0];
      const direction = $(this).hasClass("left-arrow") ? "prev" : "next";

      $.ajax({
        url: "navigate-image.php",
        type: "POST",
        data: {
          username: username,
          direction: direction
        },
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            card.find(".image-container").html(response.mediaHTML);
          }
        }
      });
    });


    // arrow end 
    $(document).ready(function() {
      let shownArchitects = [];

      $(document).on("click", "#load-btn", function() {
        $.ajax({
          url: "load-media.php",
          type: "POST",
          data: {
            shownArchitects: shownArchitects
          },
          dataType: "json",
          success: function(response) {
            if (response.status === "end") {
              alert("All architects have been shown.");
            } else {
              $("#imgg").html(response.html);
              shownArchitects.push(response.username);
            }
          }
        });
      });
    });
  </script>

</head>

<body>
  <!-- Header -->
  <header id="main-header" class="bg-yellow-100  shadow fixed w-full top-0 z-50 animate-slide-down sticky-header">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6 transition-all duration-300">
      <!-- <a href="javascript:history.back()" class="text-2xl font-bold text-yellow-600">UrArchitect</a> -->
      <!-- <a href="index.php" class="flex items-center space-x-2 group"> -->
      <h1 class="text-2xl select-none font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
        link<span class="text-gray-800 ">io</span>
      </h1>
      <!-- </a> -->



      <nav class="space-x-6">
        <!-- <a href="testf.php" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Back</a> -->
        <a href="javascript:history.back()" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Home</a>
        <!-- <a href="testf.php" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Find Architect</a> -->
        <!-- <a href="#services" class="text-gray-700 hover:text-yellow-500 font-medium">Services</a> -->
        <!-- <a href="#projects" class="text-gray-700 hover:text-yellow-500 font-medium">Projects</a> -->
        <!-- <a href="#about" class="text-gray-700 hover:text-yellow-500 font-medium">About</a> -->
        <!-- <a href="login.php" class="text-gray-700 hover:text-yellow-500 font-medium">Login</a> -->
        <!-- <a href="#contact" class="text-gray-700 hover:text-yellow-500 font-medium">Contact Us</a> -->
      </nav>
    </div>
  </header>
  <div id="imgg">
    <?php

    // $sql = "SELECT * FROM media  LIMIT 1 OFFSET 0";
    $sql = "SELECT media.*, basic_profile.bio
        FROM media
        LEFT JOIN basic_profile ON media.user_id = basic_profile.user_id
        LIMIT 1 OFFSET 0";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      echo '<div class="card"  style="margin-top : 80px">';
      echo '<div class="media-text-wrapper">';

      // Left: Image/Video
      echo '<div class="image-container">';
      $fileExtension = pathinfo($row['file_name'], PATHINFO_EXTENSION);
      $filePath = $row['file_path'];

      if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
        echo '<img src="' . $filePath . '" alt="media">';
      } elseif (in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg'])) {
        echo '<video controls><source src="' . $filePath . '" type="video/' . $fileExtension . '"></video>';
      } else {
        echo 'Unsupported media type.';
      }
      echo '</div>'; // image-container

      // Right: Text and Button
      echo '<div class="text-content">';
      echo '<strong>' . htmlspecialchars($row['username']) .  '</strong>';
      echo '<p>' . htmlspecialchars($row['bio']) . '</p>';

      // Load More Button
      echo '<button id="load-btn">Load More</button>';

      // Arrow Buttons (after Load More)
      echo '<div class="arrow-buttons">';
      echo '<button class="arrow left-arrow">←</button>';
      echo '<button class="arrow right-arrow">→</button>';
      echo '</div>';

      echo '</div>'; // text-content
      echo '</div>'; // media-text-wrapper
      echo '</div>'; // card



    }
    ?>
  </div>


  <!-- <button id="load-btn">Load More</button> -->

</body>

</html>