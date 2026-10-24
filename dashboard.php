  <?php
  // Start the session to access session data
  session_start();

  // $user_id = $_SESSION['user_id'];


  // Check if the user is logged in
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login page if not logged in
    exit();
  }

  // Get user details from session (example: username)
  $username = $_SESSION['username'];
  ?>







  <!-- index.php -->
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Architect Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="bg-gray-100 font-sans">

    <!-- Top Header -->
    <header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
      <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

        <!-- Left: Logo -->
        <a href="userindex.php" class="flex items-center space-x-2 group">
          <h1 class="text-2xl font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
            link<span class="text-gray-800 ">io</span>
          </h1>
        </a>

        <!-- Right: Home Buttons -->
        <div class="flex gap-4">
          <button onclick="window.location.href='userindex.php'" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">
            Home
          </button>
          <button onclick="window.location.href='settings.php'" class="text-white bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">
            CHAT
          </button>
        </div>

      </div>
    </header>


    <!-- Sidebar + Main -->
    <div class="flex h-screen pt-20 ">
      <aside class="w-64 bg-white shadow-lg">
        <div class="p-6 flex flex-col items-center border-b">

          <?php
          $user_id = $_SESSION['user_id'];
          include "dbh.php";

          $profile_pic_data = null;
          $query = "SELECT profile_picture FROM basic_profile WHERE user_id = ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("i", $user_id);
          $stmt->execute();
          $stmt->bind_result($profile_pic_data);
          $stmt->fetch();
          $stmt->close();
          $conn->close();
          ?>

          <?php if (!empty($profile_pic_data)): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($profile_pic_data); ?>" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover shadow-md mb-3">
          <?php else: ?>
            <img src="default-profile.png" alt="Default Profile" class="w-24 h-24 rounded-full object-cover shadow-md mb-3">
          <?php endif; ?>

          <div class="text-xl font-bold text-yellow-600">
            <?php echo htmlspecialchars($_SESSION['first_name']); ?>
          </div>
        </div>

        <nav class="mt-4 flex flex-col space-y-2 p-4 text-gray-700">
          <a href="basic-profile.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Basic Profile</a>
          <a href="professional-details.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Professional Details</a>
          <a href="work-experience.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Work Experience</a>
          <a href="social-links.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Social Links</a>
          <a href="availability.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Availability & Preferences</a>
          <a href="upload-post.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Upload Post</a>
          <!-- <a href="settings.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Notifications & Settings</a> -->
        </nav>
      </aside>


      <!-- Main Content -->
      <main class="flex-1 p-6">

        <!-- database code for display picture -->
        <?php
        $user_id = $_SESSION['user_id'];

        include "dbh.php";
        // $conn = new mysqli($host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Fetch profile picture
        $profile_pic_data = null;
        $query = "SELECT profile_picture FROM basic_profile WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($profile_pic_data);
        $stmt->fetch();
        $stmt->close();
        $conn->close();
        ?>

        <!-- design for picture display -->
        <?php
        include "dbh.php";
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT u.first_name, u.surname, u.email, u.phone,
               bp.professional_title, bp.dob, bp.bio, bp.overall_experience, bp.achievements, bp.country AS bp_country, bp.state AS bp_state, bp.city AS bp_city,
               pd.firm_name, pd.type_of_architect, pd.expertise_areas, pd.affiliated_organizations, pd.license_number, pd.degree, pd.institution, pd.passing_year, pd.specialization,
               pd.certification_name, pd.certification_institution, pd.certification_year, pd.certification_number, pd.language,
               we.experience_firm_name, we.duration_days, we.role_responsibilities, we.key_projects,
               sl.linkedin, sl.facebook, sl.instagram,
               ap.availability, ap.preferred_project_type, ap.state AS ap_state, ap.city AS ap_city, ap.willing_to_relocate
        FROM users u
        LEFT JOIN basic_profile bp ON u.id = bp.user_id
        LEFT JOIN professional_details pd ON u.id = pd.user_id
        LEFT JOIN work_experience we ON u.id = we.user_id
        LEFT JOIN social_links sl ON u.id = sl.user_id
        LEFT JOIN availability_preferences ap ON u.id = ap.user_id
        WHERE u.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        ?>

        <div class="text-3xl font-semibold text-gray-800 mb-4">Welcome to Your Dashboard</div>
        <!-- <p class="text-gray-600 mb-6">Here's a summary of your profile information:</p> -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6">
          <!-- Basic Info -->
          <!-- Basic Info -->
          <!-- Basic Info -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold text-yellow-600 mb-2">Basic Info</h2>
            <p class="flex justify-between items-center">
              <span><strong>Name:</strong> <?= $row['first_name'] . ' ' . $row['surname'] ?></span>
              <!-- <a href="edit-profile.php?field=name" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Email:</strong> <?= $row['email'] ?></span>
              <!-- <a href="edit-profile.php?field=email" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Phone:</strong> <?= $row['phone'] ?></span>
              <!-- <a href="edit-profile.php?field=phone" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Date of Birth:</strong> <?= $row['dob'] ?></span>
              <!-- <a href="edit-profile.php?field=dob" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Bio:</strong> <?= $row['bio'] ?></span>
              <a href="edit-profile.php?field=bio" class="text-blue-500 hover:text-blue-700">✏️</a>
            </p>
          </div>

          <!-- Professional Details -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold text-yellow-600 mb-2">Professional Details</h2>
            <p class="flex justify-between items-center">
              <span><strong>Title:</strong> <?= $row['professional_title'] ?></span>
              <a href="edit-profile.php?field=professional_title" class="text-blue-500 hover:text-blue-700">✏️</a>
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Firm:</strong> <?= $row['firm_name'] ?></span>
              <!-- <a href="edit-profile.php?field=firm_name" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Type:</strong> <?= $row['type_of_architect'] ?></span>
              <a href="edit-profile.php?field=type_of_architect" class="text-blue-500 hover:text-blue-700">✏️</a>
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Expertise:</strong> <?= $row['expertise_areas'] ?></span>
              <a href="edit-profile.php?field=expertise_areas" class="text-blue-500 hover:text-blue-700">✏️</a>
            </p>
            <p class="flex justify-between items-center">
              <span><strong>License:</strong> <?= $row['license_number'] ?></span>
              <!-- <a href="edit-profile.php?field=license_number" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Language:</strong> <?= $row['language'] ?></span>
              <a href="edit-profile.php?field=language" class="text-blue-500 hover:text-blue-700">✏️</a>
            </p>
          </div>

          <!-- Education & Certification -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold text-yellow-600 mb-2">Education & Certification</h2>
            <p class="flex justify-between items-center">
              <span><strong>Degree:</strong> <?= $row['degree'] ?> (<?= $row['passing_year'] ?>)</span>
              <!-- <a href="edit-profile.php?field=degree" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Institution:</strong> <?= $row['institution'] ?></span>
              <!-- <a href="edit-profile.php?field=institution" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Specialization:</strong> <?= $row['specialization'] ?></span>
              <!-- <a href="edit-profile.php?field=specialization" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Certification:</strong> <?= $row['certification_name'] ?> (<?= $row['certification_year'] ?>)</span>
              <!-- <a href="edit-profile.php?field=certification_name" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>From:</strong> <?= $row['certification_institution'] ?></span>
              <!-- <a href="edit-profile.php?field=certification_institution" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Cert. Number:</strong> <?= $row['certification_number'] ?></span>
              <!-- <a href="edit-profile.php?field=certification_number" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
          </div>

          <!-- Work Experience -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold text-yellow-600 mb-2">Work Experience</h2>
            <p class="flex justify-between items-center">
              <span><strong>Firm:</strong> <?= $row['experience_firm_name'] ?></span>
              <!-- <a href="edit-profile.php?field=experience_firm_name" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Duration:</strong> <?= $row['duration_days'] ?> days</span>
              <!-- <a href="edit-profile.php?field=duration_days" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Responsibilities:</strong> <?= $row['role_responsibilities'] ?></span>
              <!-- <a href="edit-profile.php?field=role_responsibilities" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Key Projects:</strong> <?= $row['key_projects'] ?></span>
              <!-- <a href="edit-profile.php?field=key_projects" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
          </div>

          <!-- Social Links -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold text-yellow-600 mb-2">Social Links</h2>
            <p class="flex justify-between items-center">
              <span><strong>LinkedIn:</strong> <?= $row['linkedin'] ?></span>
              <!-- <a href="edit-profile.php?field=linkedin" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Facebook:</strong> <?= $row['facebook'] ?></span>
              <!-- <a href="edit-profile.php?field=facebook" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Instagram:</strong> <?= $row['instagram'] ?></span>
              <!-- <a href="edit-profile.php?field=instagram" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
          </div>

          <!-- Availability & Preferences -->
          <div class="bg-gray-200 p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold text-yellow-600 mb-2">Availability & Preferences</h2>
            <p class="flex justify-between items-center">
              <span><strong>Available:</strong> <?= $row['availability'] ?></span>
              <a href="edit-profile.php?field=availability" class="text-blue-500 hover:text-blue-700">✏️</a>
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Preferred Project:</strong> <?= $row['preferred_project_type'] ?></span>
              <a href="edit-profile.php?field=preferred_project_type" class="text-blue-500 hover:text-blue-700">✏️</a>
            </p>
            <p class="flex justify-between items-center">
              <span><strong>City Preference:</strong> <?= $row['ap_city'] ?>, <?= $row['ap_state'] ?></span>
              <!-- <a href="edit-profile.php?field=ap_city_state" class="text-blue-500 hover:text-blue-700">✏️</a> -->
            </p>
            <p class="flex justify-between items-center">
              <span><strong>Willing to Relocate:</strong> <?= $row['willing_to_relocate'] ?></span>
              <a href="edit-profile.php?field=willing_to_relocate" class="text-blue-500 hover:text-blue-700">✏️</a>
            </p>
          </div>


        </div>


        <!-- gallery------------------------------------------------------------------ -->
        <div class="bg-gray-200 p-6 rounded-xl shadow">
          <div class="text-3xl font-semibold text-gray-800 mb-4">Your Gallery</div>

          <?php
          $user_id = $_SESSION['user_id'];

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




      </main>
    </div>
  </body>

  </html>