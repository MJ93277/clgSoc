







<?php




include "dbh.php";  // Assuming this includes the database connection

//selection option code

// $professionalTitle = isset($_GET['professionalTitle']) ? $_GET['professionalTitle'] : '';
// $specialization = isset($_GET['specialization']) ? $_GET['specialization'] : '';
// $experience = isset($_GET['experience']) ? $_GET['experience'] : '';

// // Constructing SQL query based on filters
// $query = "SELECT * FROM architects WHERE 1";

// // Apply filters to the query
// if ($professionalTitle) {
//     $query .= " AND professional_title LIKE '%$professionalTitle%'";
// }
// if ($specialization) {
//     $query .= " AND specialization LIKE '%$specialization%'";
// }
// if ($experience) {
//     $query .= " AND experience_level LIKE '%$experience%'";
// }

// // Run the query
// // (assuming a connection to the database is established)
// $result = mysqli_query($conn, $query);

// // Fetch and display the filtered results
// while ($row = mysqli_fetch_assoc($result)) {
//     // Output the results in your desired format
//     echo "<div class='profile-card'>";
//     echo "<h3>" . $row['name'] . "</h3>";
//     echo "<p>" . $row['professional_title'] . "</p>";
//     echo "<p>" . $row['specialization'] . "</p>";
//     echo "<p>" . $row['experience_level'] . "</p>";
//     echo "</div>";
// }





// Check if the search term is set and not empty
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);

    // Query to search for the term in the database
    $query = "SELECT basic_profile.*, users.first_name, users.surname 
              FROM basic_profile 
              INNER JOIN users ON basic_profile.user_id = users.id
              WHERE users.surname LIKE '%$searchTerm%' 
                 or users.first_name LIKE '%$searchTerm%'
                 or basic_profile.city LIKE '%$searchTerm%'
                 or basic_profile.state LIKE '%$searchTerm%' 
                 ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Start the container div for cards (same as in test.php)
        echo "<div class='container mx-auto   py-10'>";
        echo "<div class='grid grid-cols-1 md:grid-cols-2 margin-top: 20px lg:grid-cols-4 gap-10'>"; 

        while ($row = mysqli_fetch_assoc($result)) {
            // Output each profile card with the same styling as test.php
            echo "<div class='profile-card' style='width: 300px; height: 450px; border: 1px solid #ddd; border-radius: 10px; padding: 20px; margin-top : 10px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between;'>";

            echo "<div class='top-nav'>
                    <span class='profile-tag'>Profile</span>
                  </div>";

            echo "<div class='user-content' style='flex-grow: 1;'>";  // Allow content to take up available space

            // Flexbox approach for centering the image (same as in test.php)
            echo "<div style='display: flex; justify-content: center; align-items: center; margin-bottom: 20px;'>
                    <img src='data:image/jpeg;base64," . base64_encode($row['profile_picture']) . "' alt='Profile Picture' style='width: 100px; height: 100px; border-radius: 50%; object-fit: cover;'>
                  </div>";

            echo "<div class='user-name' style='text-align: center; font-weight: bold;'>" . $row['first_name'] . " " . $row['surname'] . "</div>";
            echo "<div class='user-job-profile' style='text-align: center; color: #777;'>" . $row['professional_title'] . "</div>";

            $short_bio = strlen($row['bio']) > 200 ? substr($row['bio'], 0, 50) . '...' : $row['bio'];
            echo "<p class='user-desc' style='text-align: center; font-size: 14px; margin-top: 10px;'>$short_bio</p>";

            echo "</div>";  // End user content

            // Fixed "View Profile" button at the bottom (same style as in test.php)
            echo "<form action='view-profile.php' method='POST' style='margin-top: 10px; text-align: center;'>
                    <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                    <button type='submit' class='user-view' style='padding: 10px; background-color: rgba(255, 153, 0, 0.97); color: white; border-radius: 5px; border: none; text-decoration: none; cursor: pointer; width: 100%;'>
                        View Profile
                    </button>
                  </form>";

            echo "</div>";  // End profile card
        }

        // Close the grid container
        echo "</div>";  // End grid
        echo "</div>";  // End container
        exit();

    } else {
        echo "<p class='text-center text-lg text-gray-700'>No profiles found.</p>";

        // echo "<p>No profiles found.</p>";
    }

} else {
    echo "<p class='text-center text-lg text-gray-700'>No search term provided.</p>";
    
    // echo "<p>No search term provided.</p>";
}
?>
