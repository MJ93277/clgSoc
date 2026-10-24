<?php
// Simple function to display selected values
function displaySelections($title, $items) {
    if (!empty($items)) {
        echo "<h2>$title:</h2>";
        echo "<ul>";
        foreach ($items as $item) {
            echo "<li>" . htmlspecialchars($item) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h2>$title:</h2>";
        echo "<p>None selected.</p>";
    }
}

// Form submission check
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h1>Selected Filters</h1>";

    // Professional Title
    if (isset($_POST['professional_title'])) {
        displaySelections('Professional Title', $_POST['professional_title']);
    } else {
        echo "<p>No Professional Titles selected.</p>";
    }

    // Specialization
    if (isset($_POST['specialization'])) {
        displaySelections('Specialization', $_POST['specialization']);
    } else {
        echo "<p>No Specializations selected.</p>";
    }

    // Experience
    if (isset($_POST['experience'])) {
        displaySelections('Experience', $_POST['experience']);
    } else {
        echo "<p>No Experience selected.</p>";
    }
} else {
    echo "<h1>No data received.</h1>";
}
?>
