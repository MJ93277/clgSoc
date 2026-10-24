<?php
session_start();
require 'dbh.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Whitelist of editable fields and their corresponding table + column
$editable_fields = [
    'professional_title'           => ['table' => 'basic_profile', 'column' => 'professional_title'], // ok
    // 'email'                        => ['table' => 'users', 'column' => 'email'],
    // 'phone'                        => ['table' => 'users', 'column' => 'phone'],
    'bio'                          => ['table' => 'basic_profile', 'column' => 'bio'],  // ok 
    // 'dob'                          => ['table' => 'basic_profile', 'column' => 'dob'],
    // 'first_name'                   => ['table' => 'users', 'column' => 'first_name'],
    // 'surname'                      => ['table' => 'users', 'column' => 'surname'],
    'language'                     => ['table' => 'professional_details', 'column' => 'language'],
    'type_of_architect'            => ['table' => 'professional_details', 'column' => 'type_of_architect'], // ✅ added this line
    'expertise_areas'              => ['table' => 'professional_details', 'column' => 'expertise_areas'],
    'availability'         => ['table' => 'availability_preferences', 'column' => 'availability'],
    'preferred_project_type'         => ['table' => 'availability_preferences', 'column' => 'preferred_project_type'],
    'willing_to_relocate' => ['table' => 'availability_preferences', 'column' => 'willing_to_relocate'],

    

];

$field = $_GET['field'] ?? null;

if (!$field || !array_key_exists($field, $editable_fields)) {
    die("Invalid or unsupported field.");
    
}

$table = $editable_fields[$field]['table'];
$column = $editable_fields[$field]['column'];

// Fetch current value
$stmt = $conn->prepare("SELECT $column FROM $table WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($current_value);
$stmt->fetch();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_value = trim($_POST['new_value']);

    if ($new_value === '') {
        $error = "Value cannot be empty.";
    } else {
        $update = $conn->prepare("UPDATE $table SET $column = ? WHERE user_id = ?");
        $update->bind_param("si", $new_value, $user_id);
        $update->execute();
        $update->close();

        header("Location: dashboard.php"); // Redirect back to dashboard
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $field))) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold text-yellow-600 mb-4">Edit <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $field))) ?></h1>

    <?php if (!empty($error)): ?>
      <p class="text-red-600 mb-2"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <?php if ($field === 'professional_title'): ?>
        <label class="block text-sm font-medium text-gray-700">Professional Title</label>
        <select name="new_value" class="w-full border rounded px-3 py-2 mt-1" required>
          <option value="" disabled>Select Professional Title</option>
          <?php
            $titles = [
              "Junior Architect", "Senior Architect", "Principal Architect", "Architectural Consultant",
              "Project Architect", "Urban Planner", "Landscape Architect", "Interior Architect",
              "Design Lead", "Freelance Architect"
            ];
            foreach ($titles as $title) {
                $selected = ($title === $current_value) ? 'selected' : '';
                echo "<option value=\"$title\" $selected>$title</option>";
            }
          ?>
        </select>

      <?php elseif ($field === 'type_of_architect'): ?>
        <label class="block text-sm font-medium text-gray-700">Type of Architect</label>
        <select name="new_value" class="w-full border rounded px-3 py-2 mt-1" required>
          <option value="">Select Type</option>
          <?php
            $types = [
              "Residential", "Commercial", "Urban Designer", "Landscape Architect",
              "Interior Designer", "Industrial Architect", "Hospitality Architect",
              "Educational Architect", "Healthcare Architect", "Sustainability/Green Architect",
              "Restoration Architect", "Transportation Architect", "Exhibition/Stage Designer",
              "Mixed-use Architect"
            ];
            foreach ($types as $type) {
              $selected = ($type === $current_value) ? 'selected' : '';
              echo "<option value=\"$type\" $selected>$type</option>";
            }
          ?>
        </select>
        <?php elseif ($field === 'expertise_areas'): ?>
        <label class="block text-sm font-medium text-gray-700">Area of Expertise</label>
        <select name="new_value" class="w-full border rounded px-3 py-2 mt-1" required>
          <?php
            $expertise_options = [
              "Sustainable Design", "Urban Planning", "Landscape Design", "Historic Preservation",
              "Interior Design", "Facade Design", "BIM (Building Information Modeling)",
              "Construction Management", "Lighting Design", "Acoustic Design", "Architectural Visualization",
              "Urban Revitalization", "Green Building", "Smart Building Design", "Hospitality Design",
              "Retail Architecture", "Residential Design", "Commercial Design", "Public Space Design",
              "Transportation Infrastructure"
            ];
            foreach ($expertise_options as $option) {
                $selected = ($option === $current_value) ? 'selected' : '';
                echo "<option value=\"$option\" $selected>$option</option>";
            }
          ?>
        </select>
        <!-- //languange start-->

        <?php elseif ($field === 'language'): ?>
  <label class="block text-sm font-medium text-gray-700">Language</label>
  <select name="new_value" class="w-full border rounded px-3 py-2 mt-1" required>
    <?php
      $languages = [
        "Hindi", "Bengali", "Telugu", "Marathi", "Tamil", "Urdu", "Gujarati", "Malayalam",
        "Kannada", "Odia", "Punjabi", "Assamese", "Maithili", "Santali", "Kashmiri", "Nepali",
        "Sindhi", "Dogri", "Manipuri", "Bodo", "Sanskrit", "Khasi", "Mizo", "Hindi (Dialect)",
        "Marwari", "Tulu", "Konkani", "Rajasthani", "Awadhi", "Chhattisgarhi", "Haryanvi", "Bundeli"
      ];
      foreach ($languages as $lang) {
          $selected = ($lang === $current_value) ? 'selected' : '';
          echo "<option value=\"$lang\" $selected>$lang</option>";
      }
    ?>
  </select>
        <!-- //languange end-->

        <!-- availability start -->
        <?php elseif ($field === 'availability'): ?>
  <label class="block text-sm font-medium text-gray-700">Firm</label>
  <select name="new_value" class="w-full border rounded px-3 py-2 mt-1" required>
    <option value="">Select Firm Type</option>
    <option value="Freelance" <?= ($current_value === "Freelance") ? 'selected' : '' ?>>Freelance</option>
    <option value="Full-time" <?= ($current_value === "Full-time") ? 'selected' : '' ?>>Full-time</option>
  </select>
        <!-- availability end -->

         <!-- preferred_project_type start -->
         <?php elseif ($field === 'preferred_project_type'): ?>
  <!-- <label class="block text-sm font-medium text-gray-700"></label> -->
  <label class="block text-sm font-medium text-gray-700">Preferred Project Type</label>
  <select name="new_value" class="w-full border rounded px-3 py-2 mt-1" required>
    <option value="" disabled>Select Project Type</option>
    <?php
      $options = [
        "Residential", "Commercial", "Urban Design", "Institutional",
        "Industrial", "Landscape", "Interior Design", "Mixed Use",
        "Hospitality", "Cultural", "Urban Planning", "Public Spaces"
      ];
      foreach ($options as $option) {
          $selected = ($option === $current_value) ? 'selected' : '';
          echo "<option value=\"$option\" $selected>$option</option>";
      }
    ?>
  </select>
        <!-- preferred_project_type end -->

        <!-- realocate start -->
        <?php elseif ($field === 'willing_to_relocate'): ?>
  <label class="block text-sm font-medium text-gray-700">Willing to Relocate?</label>
  <select name="new_value" class="w-full border rounded px-3 py-2 mt-1" required>
    <option value="">Select Option</option>
    <option value="Yes" <?= ($current_value === "Yes") ? 'selected' : '' ?>>Yes</option>
    <option value="No" <?= ($current_value === "No") ? 'selected' : '' ?>>No</option>
  </select>
        <!--realocate end -->



      <?php else: ?>
        <label class="block">
          <span class="text-gray-700"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $field))) ?>:</span>
          <input type="text" name="new_value" value="<?= htmlspecialchars($current_value) ?>" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        </label>
      <?php endif; ?>

      <div class="flex justify-end space-x-2">
        <a href="dashboard.php" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Save</button>
      </div>
    </form>
  </div>
</body>
</html>
