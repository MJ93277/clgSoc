<?php

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // die('User not logged in.');
  echo "<script>alert('BYE BYE '); window.location.href = 'login.php';</script>";
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Availability & Preferences - Architect Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
    <!-- Sidebar (same as previous pages) -->
    <aside class="w-64 bg-white shadow-lg">
      <!-- <div class="p-6 text-2xl font-bold text-yellow-600 border-b">ArchitectHub</div> -->
      <a href="dashboard.php" class="block p-6 text-2xl font-bold text-yellow-600 border-b">
        <?php echo htmlspecialchars($_SESSION['first_name']); ?>'s Hub
      </a>
      <nav class="mt-4 flex flex-col space-y-2 p-4 text-gray-700">
        <a href="basic-profile.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Basic Profile</a>
        <a href="professional-details.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Professional Details</a>
        <a href="work-experience.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Work Experience</a>
        <a href="social-links.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Social Links</a>
        <a href="availability.php" class="bg-yellow-100 text-yellow-800 font-medium px-4 py-2 rounded">Availability & Preferences</a>
        <a href="upload-post.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Upload Post</a>
        <!-- <a href="settings.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Notifications & Settings</a> -->
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
      <div class="text-2xl font-semibold text-gray-800 mb-6">Availability & Preferences</div>

      <form action="save-availability.php" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">

        <!-- Freelance or Full-time -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Available for</label>
          <div class="flex space-x-6">
            <div class="flex items-center">
              <input type="radio" required name="availability" value="Freelance" id="freelance" class="h-5 w-5 text-yellow-600">
              <label for="freelance" class="ml-2 text-gray-700">Freelance</label>
            </div>
            <div class="flex items-center">
              <input type="radio" required name="availability" value="Full-time" id="full-time" class="h-5 w-5 text-yellow-600">
              <label for="full-time" class="ml-2 text-gray-700">Full-time</label>
            </div>
          </div>
        </div>

        <!-- Preferred Project Types start -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Preferred Project Type</label>
          <select name="preferred_project_type" required class="w-full border rounded px-3 py-2 mt-1">
            <option value="" disabled selected>Select State</option>
            <option value="Residential">Residential</option>
            <option value="Commercial">Commercial</option>
            <option value="Urban Design">Urban Design</option>
            <option value="Institutional">Institutional</option>
            <option value="Industrial">Industrial</option>
            <option value="Landscape">Landscape</option>
            <option value="Interior Design">Interior Design</option>
            <option value="Mixed Use">Mixed Use</option>
            <option value="Hospitality">Hospitality</option>
            <option value="Cultural">Cultural</option>
            <option value="Urban Planning">Urban Planning</option>
            <option value="Public Spaces">Public Spaces</option>
            <!-- Add more as necessary -->
          </select>
        </div>

        <!-- Preferred Project Types start -->


        <!-- Preferred Work Locations start -->
        <!-- <div>
          <label class="block text-sm font-medium text-gray-700">Preferred Work Locations</label>
          <input type="text" name="preferred_locations" class="w-full border rounded px-3 py-2 mt-1" placeholder="Enter locations (e.g., Cities, States)" required>
        </div> -->

        <div class="md:col-span-2">
          <div>
            <label class="block text-sm font-medium text-gray-700">State</label>
            <select id="state" name="state" class="w-full border rounded px-3 py-2 mt-1" required>
              <option value="" disabled selected>Select State</option>

              <!-- states -->
              <option value="Andhra Pradesh">Andhra Pradesh</option>
              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
              <option value="Assam">Assam</option>
              <option value="Bihar">Bihar</option>
              <option value="Chhattisgarh">Chhattisgarh</option>
              <option value="Goa">Goa</option>
              <option value="Gujarat">Gujarat</option>
              <option value="Haryana">Haryana</option>
              <option value="Himachal Pradesh">Himachal Pradesh</option>
              <option value="Jharkhand">Jharkhand</option>
              <option value="Karnataka">Karnataka</option>
              <option value="Kerala">Kerala</option>
              <option value="Madhya Pradesh">Madhya Pradesh</option>
              <option value="Maharashtra">Maharashtra</option>
              <option value="Manipur">Manipur</option>
              <option value="Meghalaya">Meghalaya</option>
              <option value="Mizoram">Mizoram</option>
              <option value="Nagaland">Nagaland</option>
              <option value="Odisha">Odisha</option>
              <option value="Punjab">Punjab</option>
              <option value="Rajasthan">Rajasthan</option>
              <option value="Sikkim">Sikkim</option>
              <option value="Tamil Nadu">Tamil Nadu</option>
              <option value="Telangana">Telangana</option>
              <option value="Tripura">Tripura</option>
              <option value="Uttar Pradesh">Uttar Pradesh</option>
              <option value="Uttarakhand">Uttarakhand</option>
              <option value="West Bengal">West Bengal</option>
              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
              <option value="Chandigarh">Chandigarh</option>
              <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
              <option value="Delhi">Delhi</option>
              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
              <option value="Ladakh">Ladakh</option>
              <option value="Lakshadweep">Lakshadweep</option>
              <option value="Puducherry">Puducherry</option>

            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">City</label>
            <select id="city" name="city" class="w-full border rounded px-3 py-2 mt-1" required>
              <option value="" disabled selected>Select City</option>
            </select>
          </div>


        </div>


        <!-- Preferred Work Locations end -->


        <!-- Willing to Relocate/Travel -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Willing to Relocate/Travel?</label>
          <div class="flex space-x-6">
            <div class="flex items-center">
              <input type="radio" required name="willing_to_relocate" value="Yes" id="relocate-yes" class="h-5 w-5 text-yellow-600">
              <label for="relocate-yes" class="ml-2 text-gray-700">Yes</label>
            </div>
            <div class="flex items-center">
              <input type="radio" required name="willing_to_relocate" value="No" id="relocate-no" class="h-5 w-5 text-yellow-600">
              <label for="relocate-no" class="ml-2 text-gray-700">No</label>
            </div>
          </div>
        </div>

        <!-- Save Button -->
        <div class="pt-4">
          <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded">Save</button>
        </div>
      </form>
    </main>
  </div>


  <!-- javascript start -->
  <script>
    const stateCityMap = {
      "Gujarat": ["Ahmedabad", "Surat", "Rajkot", "Vadodara"],
      "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Nashik"],
      "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli"],
      "Karnataka": ["Bengaluru", "Mysuru", "Mangalore", "Hubli"],
      "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore"],
      "Arunachal Pradesh": ["Itanagar", "Naharlagun", "Pasighat"],
      "Assam": ["Guwahati", "Silchar", "Dibrugarh", "Jorhat"],
      "Bihar": ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur"],
      "Chhattisgarh": ["Raipur", "Bhilai", "Bilaspur", "Korba"],
      "Goa": ["Panaji", "Margao", "Vasco da Gama"],
      "Gujarat": ["Ahmedabad", "Surat", "Rajkot", "Vadodara"],
      "Haryana": ["Gurgaon", "Faridabad", "Panipat", "Ambala"],
      "Himachal Pradesh": ["Shimla", "Mandi", "Dharamshala"],
      "Jharkhand": ["Ranchi", "Jamshedpur", "Dhanbad"],
      "Karnataka": ["Bengaluru", "Mysuru", "Mangalore", "Hubli"],
      "Kerala": ["Thiruvananthapuram", "Kochi", "Kozhikode"],
      "Madhya Pradesh": ["Bhopal", "Indore", "Jabalpur", "Gwalior"],
      "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Nashik"],
      "Manipur": ["Imphal"],
      "Meghalaya": ["Shillong"],
      "Mizoram": ["Aizawl"],
      "Nagaland": ["Kohima", "Dimapur"],
      "Odisha": ["Bhubaneswar", "Cuttack", "Rourkela"],
      "Punjab": ["Amritsar", "Ludhiana", "Jalandhar", "Patiala"],
      "Rajasthan": ["Jaipur", "Jodhpur", "Udaipur", "Kota"],
      "Sikkim": ["Gangtok"],
      "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli"],
      "Telangana": ["Hyderabad", "Warangal"],
      "Tripura": ["Agartala"],
      "Uttar Pradesh": ["Lucknow", "Kanpur", "Varanasi", "Agra"],
      "Uttarakhand": ["Dehradun", "Haridwar"],
      "West Bengal": ["Kolkata", "Howrah", "Durgapur", "Siliguri"],
      "Andaman and Nicobar Islands": ["Port Blair"],
      "Chandigarh": ["Chandigarh"],
      "Dadra and Nagar Haveli and Daman and Diu": ["Daman", "Silvassa"],
      "Delhi": ["New Delhi", "Delhi"],
      "Jammu and Kashmir": ["Srinagar", "Jammu"],
      "Ladakh": ["Leh", "Kargil"],
      "Lakshadweep": ["Kavaratti"],
      "Puducherry": ["Puducherry"]
    };

    document.getElementById("state").addEventListener("change", function() {
      const state = this.value;
      const citySelect = document.getElementById("city");
      citySelect.innerHTML = '<option value="">Select City</option>';

      if (stateCityMap[state]) {
        stateCityMap[state].forEach(city => {
          const option = document.createElement("option");
          option.value = city;
          option.textContent = city;
          citySelect.appendChild(option);
        });
      }
    });
  </script>
  <!-- javascript end -->

</body>

</html>