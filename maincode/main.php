
<?php include "dbh.php"; ?>
<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="maindesign.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!-- Lottie Player Script (only included once) -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


  <script>

    // arrow start 
    $(document).on("click", ".arrow", function () {
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
    success: function (response) {
      if (response.status === "success") {
        card.find(".image-container").html(response.mediaHTML);
      }
    }
  });
});


    // arrow end 
  $(document).ready(function () {
    let shownArchitects = [];

    $(document).on("click", "#load-btn", function () {
      $.ajax({
        url: "load-media.php",
        type: "POST",
        data: { shownArchitects: shownArchitects },
        dataType: "json",
        success: function (response) {
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
<header id="main-header" class="bg-yellow-100 shadow fixed w-full top-0 z-50 animate-slide-down sticky-header">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6 transition-all duration-300">
    <!-- <h1 class="text-2xl font-bold text-yellow-600">UrArchitect</h1> -->
     <h1 class="text-white bg-yellow-500 text-xl font-extrabold px-4 py-2 rounded-full shadow-md tracking-wide  select-none  pointer-events-none inline-block  flex items-center justify-center">UrArchitect</h1>
     <!-- <h1 class="text-white bg-yellow-500 text-xl font-extrabold px-4 py-2 rounded-full shadow-md tracking-wide  select-none  pointer-events-none inline-block  flex items-center justify-center">UrArchitect</h1> -->
     
    <nav class="space-x-6">
        <!-- <a href="dashboard.php" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Dashboard</a> -->
        <a href="testf.php" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Search Architect</a>
        <a href="#services" class="text-gray-700 hover:text-yellow-500 font-medium">Services</a>
        <a href="#projects" class="text-gray-700 hover:text-yellow-500 font-medium">Projects</a>
        <a href="#about" class="text-gray-700 hover:text-yellow-500 font-medium">About</a>
        <a href="#contact" class="text-gray-700 hover:text-yellow-500 font-medium">Contact Us</a>
        <a href="logout.php" class="text-gray-700 hover:text-yellow-500 font-medium">Logout</a>
        
    </nav>
  </div>
</header>

<div id="imgg">
  <?php
  
    $sql = "SELECT * FROM media LIMIT 1 OFFSET 0";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      echo '<div class="card" style="margin-top: 60px";>';
      echo '<div class="media-text-wrapper">';

      // Left: Image/Video
      echo '<div class="image-container">';
      $fileExtension = pathinfo($row['file_name'], PATHINFO_EXTENSION);
      $filePath = $row['file_path'] . '/' . $row['file_name'];
      
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
            echo '<strong>' . htmlspecialchars($row['username']) . ' #' . $row['user_id'] . '</strong>';
            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
      
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
