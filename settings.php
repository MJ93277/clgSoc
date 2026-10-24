<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  echo "<script>alert('BYE BYE'); window.location.href = 'login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Messages - Architect Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

  <!-- Top Navbar -->
  <header class="bg-white shadow fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
     <a href="userindex.php" class="flex items-center space-x-2 group">
        <h1 class="text-2xl font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
          Ur<span class="text-gray-800">Architect</span>
        </h1>
      </a>
      <a href="dashboard.php" class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm">Go to Dashboard</a>
    </div>
  </header>

  <!-- Main Layout -->
  <div class="pt-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6">
      
      <!-- Page Title -->
      <div class="flex items-center mb-6">
        <span class="text-yellow-500 text-2xl mr-2">💬</span>
        <h2 class="text-2xl font-bold text-gray-800">Messages</h2>
      </div>

      <?php
      include "dbh.php";

      $user_id = $_SESSION['user_id'];
      $sql = "SELECT * FROM conversations WHERE architect_id = '$user_id' ORDER BY created_at DESC";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        echo "<div class='space-y-4'>";
        while ($row = $result->fetch_assoc()) {
          $c_id = $row['client_id'];
          $usersql = "SELECT first_name FROM users WHERE id = $c_id";
          $result2 = $conn->query($usersql);

          if ($result2 && $result2->num_rows > 0) {
            $userRow = $result2->fetch_assoc();
            $first_name = $userRow['first_name'];
      ?>

            <!-- Single Chat Card -->
            <div class="flex items-center p-4 bg-gray-50 border rounded-lg shadow-sm hover:shadow-md transition duration-300 group">
              <!-- Avatar -->
              <div class="w-12 h-12 bg-yellow-500 text-white font-bold rounded-full flex items-center justify-center text-xl shadow group-hover:scale-105 transition-transform">
                <?php echo substr($first_name, 0, 1); ?>
              </div>

              <!-- Details -->
              <div class="ml-4 flex-1">
                <form action="achat.php" method="post">
                  <input type="hidden" name="conversation_id" value="<?php echo $c_id; ?>">
                  <button type="submit" class="text-left w-full bg-transparent border-0">
                    <p class="text-lg font-semibold text-gray-800 group-hover:text-yellow-600 transition">
                      <?php echo htmlspecialchars($first_name); ?>
                    </p>
                    <p class="text-sm text-gray-500">Click to view conversation</p>
                  </button>
                </form>
              </div>

              <!-- Placeholder Icon -->
              <div class="text-sm text-gray-400 group-hover:text-yellow-500">🕒</div>
            </div>

      <?php
          } else {
            echo "<p class='text-red-500'>No user found with ID: $c_id</p>";
          }
        }
        echo "</div>";
      } else {
        echo "<p class='text-gray-500 text-center'>No conversations found.</p>";
      }
      ?>
    </div>
  </div>

</body>
</html>
