<?php

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // die('User not logged in.');
  echo "<script>alert('BYE BYE '); window.location.href = 'login.php';</script>";
} ?>

<!-- work-experience.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Work Experience - Architect Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Function to calculate the difference between two dates in days
    function calculateDaysDifference(startDate, endDate) {
      const start = new Date(startDate);
      const end = new Date(endDate);
      const timeDiff = end - start; // Time difference in milliseconds
      const daysDiff = timeDiff / (1000 * 3600 * 24); // Convert milliseconds to days
      return daysDiff;
    }

    // Function to update the duration display in days
    function updateDuration() {
      const startDate = document.getElementById("work_start_date").value;
      const endDate = document.getElementById("work_end_date").value;

      if (startDate && endDate) {
        const days = calculateDaysDifference(startDate, endDate);
        document.getElementById("work_duration_display").textContent = `${Math.floor(days)} days`;
      } else {
        document.getElementById("work_duration_display").textContent = "";
      }
    }

    // Event listener to trigger update when either start or end date changes
    document.addEventListener("DOMContentLoaded", function() {
      const startDateInput = document.getElementById("work_start_date");
      const endDateInput = document.getElementById("work_end_date");

      startDateInput.addEventListener("change", updateDuration);
      endDateInput.addEventListener("change", updateDuration);
    });
  </script>
</head>

<body class="bg-gray-100 font-sans">
  <!-- Top Header -->
  <header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <!-- <a href="userindex.php" class="text-2xl font-bold text-yellow-600">UrArchitect</a> -->
      <a href="userindex.php" class="flex items-center space-x-2 group">
        <h1 class="text-2xl font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
          link<span class="text-gray-800 ">io</span>
        </h1>
      </a>
    </div>
  </header>

  <div class="flex h-screen pt-20">
    <!-- Sidebar (same as index.php) -->
    <aside class="w-64 bg-white shadow-lg">
      <!-- <div class="p-6 text-2xl font-bold text-yellow-600 border-b">ArchitectHub</div> -->
      <a href="dashboard.php" class="block p-6 text-2xl font-bold text-yellow-600 border-b">
        <?php echo htmlspecialchars($_SESSION['first_name']); ?>'s Hub
      </a>
      <nav class="mt-4 flex flex-col space-y-2 p-4 text-gray-700">
        <a href="basic-profile.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Basic Profile</a>
        <a href="professional-details.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Professional Details</a>
        <a href="work-experience.php" class="bg-yellow-100 text-yellow-800 font-medium px-4 py-2 rounded">Work Experience</a>
        <a href="social-links.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Social Links</a>
        <a href="availability.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Availability & Preferences</a>
        <a href="upload-post.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Upload Post</a>
        <!-- <a href="settings.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Notifications & Settings</a> -->
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
      <div class="text-2xl font-semibold text-gray-800 mb-6">Work Experience</div>

      <form action="save-work-experience.php" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">
        <!-- Work Experience Entry -->
        <div class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Previous Firm/Organization</label>
              <input type="text" name="experience_firm_name" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Duration of Work</label>
              <div class="flex space-x-4">
                <input type="month" id="work_start_date" name="work_start_date" class="w-full border rounded px-3 py-2 mt-1" required>
                <input type="month" id="work_end_date" name="work_end_date" class="w-full border rounded px-3 py-2 mt-1" required>
              </div>
              <p class="mt-2 text-sm text-gray-600" id="work_duration_display"></p>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Role/Responsibilities</label>
            <textarea name="role_responsibilities" class="w-full border rounded px-3 py-2 mt-1" rows="4" required></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Key Projects Handled</label>
            <textarea name="key_projects" class="w-full border rounded px-3 py-2 mt-1" rows="4" required></textarea>
          </div>
        </div>

        <div class="pt-4">
          <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded">Save</button>
        </div>
      </form>
    </main>
  </div>

</body>

</html>