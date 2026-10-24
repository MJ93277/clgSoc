<!-- preview.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile Summary - Architect Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
      <div class="p-6 text-2xl font-bold text-blue-600 border-b">ArchitectHub</div>
      <nav class="mt-4 flex flex-col space-y-2 p-4 text-gray-700">
        <a href="basic-profile.php" class="hover:bg-blue-100 px-4 py-2 rounded">Basic Profile</a>
        <a href="professional-details.php" class="hover:bg-blue-100 px-4 py-2 rounded">Professional Details</a>
        <a href="work-experience.php" class="hover:bg-blue-100 px-4 py-2 rounded">Work Experience</a>
        <a href="social-links.php" class="hover:bg-blue-100 px-4 py-2 rounded">Social Links</a>
        <a href="availability.php" class="hover:bg-blue-100 px-4 py-2 rounded">Availability & Preferences</a>
        <a href="verification.php" class="hover:bg-blue-100 px-4 py-2 rounded">Verification & Legal</a>
        <a href="settings.php" class="hover:bg-blue-100 px-4 py-2 rounded">Notifications & Settings</a>
        <a href="preview.php" class="bg-blue-100 text-blue-800 font-medium px-4 py-2 rounded">Preview Profile</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
      <h1 class="text-2xl font-semibold text-gray-800 mb-6">Final Profile Preview</h1>

      <!-- Basic Info -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Basic Information</h2>
        <p><strong>Full Name:</strong> John Doe</p>
        <p><strong>Email:</strong> john@example.com</p>
        <p><strong>Phone:</strong> +91-9876543210</p>
        <p><strong>Location:</strong> Chennai, Tamil Nadu</p>
      </div>

      <!-- Professional Details -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Professional Details</h2>
        <p><strong>Title:</strong> Senior Architect</p>
        <p><strong>Years of Experience:</strong> 7</p>
        <p><strong>Type of Architect:</strong> Urban Planner</p>
        <p><strong>Specializations:</strong> Sustainable Design, Interior Design</p>
        <p><strong>Firm Name:</strong> UrbanEdge Architects</p>
        <p><strong>License No.:</strong> COA123456</p>
        <p><strong>Affiliations:</strong> Council of Architecture (COA)</p>
      </div>

      <!-- Education -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Education & Certifications</h2>
        <p><strong>Degree:</strong> B.Arch - NIT Trichy (2016)</p>
        <p><strong>Certifications:</strong> LEED Certified - 2020</p>
      </div>

      <!-- Work Experience -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Work Experience</h2>
        <p><strong>Company:</strong> XYZ Constructions</p>
        <p><strong>Duration:</strong> 750 days</p>
        <p><strong>Key Projects:</strong> Residential Township in Bangalore</p>
        <p><strong>Roles:</strong> Lead Architect, Design Planning</p>
      </div>

      <!-- Social Links -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Social Links</h2>
        <p><strong>LinkedIn:</strong> linkedin.com/in/johndoe</p>
        <p><strong>Facebook:</strong> facebook.com/johndoe</p>
        <p><strong>Instagram:</strong> instagram.com/johndoe_architect</p>
      </div>

      <!-- Preferences -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Preferences & Notifications</h2>
        <p><strong>Preferred Projects:</strong> Residential, Commercial, Urban Design</p>
        <p><strong>Languages:</strong> English, Hindi, Tamil</p>
        <p><strong>Email Notifications:</strong> Enabled</p>
      </div>

      <!-- Final Submit -->
      <div class="text-right mt-6">
        <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit Final Profile</button>
      </div>
    </main>
  </div>

</body>
</html>
