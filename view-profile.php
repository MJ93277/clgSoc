<?php
$user_id = $_POST['user_id']; // Assuming the user_id is passed as a URL parameter

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user_id'])) {
  $user_id = $_POST['user_id'];
  // ab user_id ke sath kaam karo
} else {
  // Agar user_id empty hai ya galat request hai, to login page pe redirect
  header('Location: login.php');
  exit();
}

include "dbh.php"; // Your database connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch all the details from all tables
$query = "SELECT 
            users.*, 
            basic_profile.*, 
            professional_details.*, 
            work_experience.*, 
            social_links.*, 
            availability_preferences.*
          FROM basic_profile 
          JOIN users ON basic_profile.user_id = users.id
          LEFT JOIN professional_details ON users.id = professional_details.user_id
          LEFT JOIN work_experience ON users.id = work_experience.user_id
          LEFT JOIN social_links ON users.id = social_links.user_id
          LEFT JOIN availability_preferences ON users.id = availability_preferences.user_id
          WHERE users.id = ?";

// Check if prepare() is successful
$stmt = $conn->prepare($query);

if ($stmt === false) {
  // Output the SQL error if prepare fails
  die("MySQL prepare error: " . $conn->error);
}

$stmt->bind_param("i", $user_id);  // Bind the user_id parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  // Fetch data from each table and store in variables
  // Users Table
  $user_id = $row['user_id'];
  $first_name = $row['first_name'];
  $surname = $row['surname'];
  $email = $row['email'];
  $phone = $row['phone'];

  // Basic Profile Table
  $bp_professional_title = $row['professional_title'];
  $bp_dob = $row['dob'];
  $bp_bio = $row['bio'];
  $bp_overall_experience = $row['overall_experience'];
  $bp_achievements = $row['achievements'];
  $bp_country = $row['country'];
  $bp_state = $row['state']; // Differentiated if needed
  $bp_city = $row['city'];
  $bp_profile_picture = $row['profile_picture'];

  // Professional Details Table
  $pd_firm_name = $row['firm_name'];
  $pd_type_of_architect = $row['type_of_architect'];
  $pd_expertise_areas = $row['expertise_areas'];
  $pd_affiliated_organizations = $row['affiliated_organizations'];
  $pd_license_number = $row['license_number'];
  $pd_degree = $row['degree'];
  $pd_institution = $row['institution'];
  $pd_passing_year = $row['passing_year'];
  $pd_specialization = $row['specialization'];
  $pd_certification_name = $row['certification_name'];
  $pd_certification_institution = $row['certification_institution'];
  $pd_certification_year = $row['certification_year'];
  $pd_certification_number = $row['certification_number'];
  $pd_language = $row['language'];

  // Work Experience Table
  $we_experience_firm_name = $row['experience_firm_name'];
  $we_duration_days = $row['duration_days'];
  $we_role_responsibilities = $row['role_responsibilities'];
  $we_key_projects = $row['key_projects'];

  // Social Links Table
  $sl_linkedin = $row['linkedin'];
  $sl_facebook = $row['facebook'];
  $sl_instagram = $row['instagram'];

  // Availability Preferences Table
  $ap_availability = $row['availability'];
  $ap_preferred_project_type = $row['preferred_project_type'];
  $ap_state = $row['state'];  // If the same as in 'basic_profile', consider using a distinct name
  $ap_city = $row['city'];
  $ap_willing_to_relocate = $row['willing_to_relocate'];

  // You can now use these variables to display the fetched data
} else {
  echo "No results found.";
}

// $stmt->close();
// $conn->close();
?>


<!-- HTML Section to Display Profile -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>View Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

  <!-- Top Header and chatting-->
  <header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

      <!-- Left side: Logo -->
      <!-- <a href="index.php" class="flex items-center space-x-2 group"> -->
      <h1 class="text-2xl font-extrabold select-none tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
        link<span class="text-gray-800 ">io</span>
      </h1>
      <!-- </a> -->

      <!-- Right side: Chat and Go Back buttons -->
      <div class="flex items-center space-x-4">
        <a href="cchat.php?user_id=<?php echo $row['user_id']; ?>" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">
          Chat
        </a>
        <a href="javascript:history.back()" class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm">
          ← Go Back
        </a>
      </div>

    </div>
  </header>



  <!-- header and chatting end -->
  <!-- Main Content with Sidebar -->
  <div class="pt-12 flex min-h-screen">

    <!-- Sidebar -->
    <!-- <div class="w-1/4 bg-white p-6 shadow-md"> -->
    <div class="w-64 bg-yellow p-6 shadow-md fixed top-15 h-[calc(120vh-5rem)] overflow-y-auto">

      <div class="flex justify-center mb-4">
        <?php if (!empty($bp_profile_picture)): ?>
          <img src="data:image/jpeg;base64,<?php echo base64_encode($bp_profile_picture); ?>" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover shadow-md">
        <?php else: ?>
          <img src="default-profile.png" alt="Profile" class="w-32 h-32 rounded-full object-cover shadow-md">
        <?php endif; ?>
      </div>
      <div class="text-xl font-bold text-yellow-600"><?php echo htmlspecialchars($first_name . ' ' . $surname); ?></div>
      <div class="text-sm text-gray-600 mt-2">
        <strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
      </div>
      <div class="text-sm text-gray-600 mt-2">
        <strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?>
      </div>

      <div class="mt-4">
        <h3 class="text-lg font-semibold text-gray-700">Basic Info</h3>
        <div class="text-sm text-gray-600 mt-2">
          <strong>Professional Title:</strong> <?php echo htmlspecialchars($bp_professional_title); ?>
        </div>
        <div class="text-sm text-gray-600 mt-2">
          <strong>Date of Birth:</strong> <?php echo htmlspecialchars($bp_dob); ?>
        </div>
        <div class="text-sm text-gray-600 mt-2">
          <strong>Overall Experience:</strong> <?php echo htmlspecialchars($bp_overall_experience); ?> years
        </div>
        <div class="text-sm text-gray-600 mt-2">
          <strong>Achievements:</strong> <?php echo htmlspecialchars($bp_achievements); ?>
        </div>
        <div class="text-sm text-gray-600 mt-2">
          <strong>Location:</strong> <?php echo htmlspecialchars($bp_city . ', ' . $bp_state . ', ' . $bp_country); ?>
        </div>

      </div>

    </div>

    <!-- Main Content -->
    <div class="flex justify-center ml-64 items-start min-h-screen bg-gray-100 ">
      <div class="w-full max-w-6xl p-8 bg-white shadow-2xl rounded-2xl space-y-12">

        <!-- Profile Header -->
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">



          <!-- Name and Title -->
          <div>
            <h1 class="text-4xl font-extrabold text-gray-800">
              <?php echo htmlspecialchars($first_name . ' ' . $surname); ?>
            </h1>
            <p class="text-xl text-yellow-600 mt-2">
              <?php echo htmlspecialchars($bp_professional_title); ?>
            </p>
            <p class="text-gray-500 mt-1">
              <?php echo htmlspecialchars($bp_bio); ?>
            </p>
          </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-300"></div>

        <!-- Profile Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

          <!-- Contact Information -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Contact Information</h2>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
          </div>

          <!-- Basic Profile -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Basic Profile</h2>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($bp_dob); ?></p>
            <p><strong>Experience:</strong> <?php echo htmlspecialchars($bp_overall_experience); ?> years</p>
            <p><strong>Achievements:</strong> <?php echo htmlspecialchars($bp_achievements); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($bp_city . ', ' . $bp_state . ', ' . $bp_country); ?></p>
          </div>

          <!-- Professional Details -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Professional Details</h2>
            <p><strong>Firm Name:</strong> <?php echo htmlspecialchars($pd_firm_name); ?></p>
            <p><strong>Type of Architect:</strong> <?php echo htmlspecialchars($pd_type_of_architect); ?></p>
            <p><strong>Expertise Areas:</strong> <?php echo htmlspecialchars($pd_expertise_areas); ?></p>
            <p><strong>License Number:</strong> <?php echo htmlspecialchars($pd_license_number); ?></p>
            <p><strong>Degree:</strong> <?php echo htmlspecialchars($pd_degree); ?></p>
            <p><strong>Institution:</strong> <?php echo htmlspecialchars($pd_institution); ?></p>
            <p><strong>Passing Year:</strong> <?php echo htmlspecialchars($pd_passing_year); ?></p>
          </div>

          <!-- Work Experience -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Work Experience</h2>
            <p><strong>Firm:</strong> <?php echo htmlspecialchars($we_experience_firm_name); ?></p>
            <p><strong>Duration:</strong> <?php echo htmlspecialchars($we_duration_days); ?> days</p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($we_role_responsibilities); ?></p>
            <p><strong>Key Projects:</strong> <?php echo htmlspecialchars($we_key_projects); ?></p>
          </div>

          <!-- Social Links -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Social Links</h2>
            <div class="space-y-2">
              <p><strong>LinkedIn:</strong> <a href="<?php echo htmlspecialchars($sl_linkedin); ?>" class="text-blue-600 hover:underline" target="_blank"><?php echo htmlspecialchars($sl_linkedin); ?></a></p>
              <p><strong>Facebook:</strong> <a href="<?php echo htmlspecialchars($sl_facebook); ?>" class="text-blue-600 hover:underline" target="_blank"><?php echo htmlspecialchars($sl_facebook); ?></a></p>
              <p><strong>Instagram:</strong> <a href="<?php echo htmlspecialchars($sl_instagram); ?>" class="text-pink-2000 hover:underline" target="_blank"><?php echo htmlspecialchars($sl_instagram); ?></a></p>
            </div>
          </div>

          <!-- Availability Preferences -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Availability Preferences</h2>
            <p><strong>Availability:</strong> <?php echo htmlspecialchars($ap_availability); ?></p>
            <p><strong>Preferred Project Type:</strong> <?php echo htmlspecialchars($ap_preferred_project_type); ?></p>
            <p><strong>Willing to Relocate:</strong> <?php echo htmlspecialchars($ap_willing_to_relocate); ?></p>
            <p><strong>Location Preference:</strong> <?php echo htmlspecialchars($ap_city . ', ' . $ap_state); ?></p>
          </div>

        </div>



        <!-- gallery------------------------------------------------------------------ -->
        <div class="bg-gray-200 p-6 rounded-xl shadow">
          <div class="text-3xl font-semibold text-gray-800 mb-4">Your Gallery</div>

          <?php
          // $user_id = $_SESSION['user_id'];

          $sql = "SELECT file_path, file_name, description FROM media WHERE user_id = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $user_id);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            echo "<div style='display: flex; flex-wrap: wrap; gap: 20px;'>";

            while ($media = $result->fetch_assoc()) {
              $filePath = $media['file_path'];
              $fileExtension = pathinfo($media['file_name'], PATHINFO_EXTENSION);

              echo "<div class='media-card shadow-lg rounded-xl border border-gray-300 bg-white p-4 w-full md:w-[300px] flex flex-col justify-between transition hover:shadow-[0_10px_25px_rgba(255,153,0,0.97)]
'>";

              echo "<div class='media-content flex justify-center items-center mb-4'>";
              if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                echo "<img src='" . $filePath . "' alt='media' class='rounded-lg max-w-full h-auto object-contain'>";
              } elseif (in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg'])) {
                echo "<video controls class='rounded-lg max-w-full h-auto'>
                      <source src='" . $filePath . "' type='video/" . strtolower($fileExtension) . "'>
                      Your browser does not support the video tag.
                    </video>";
              } else {
                echo "<p class='text-red-500'>Unsupported media type.</p>";
              }
              echo "</div>";

              echo "<div class='text-center mt-2'>
                  <p class='text-gray-700 text-sm break-words'>" . htmlspecialchars($media['description']) . "</p>
                </div>";

              echo "</div>"; // end card


            }

            echo "</div>"; // end flex container
          } else {
            echo "<p class='text-gray-600'>No media found in your gallery.</p>";
          }
          ?>
        </div>


      </div>

    </div>



  </div>

</body>

</html>