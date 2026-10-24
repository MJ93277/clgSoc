<?php

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // die('User not logged in.');
  echo "<script>alert('BYE BYE '); window.location.href = 'login.php';</script>";
} ?>

<!-- professional-details.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Professional Details - Architect Dashboard</title>
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
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
      <a href="dashboard.php" class="block p-6 text-2xl font-bold text-yellow-600 border-b">
        <?php echo htmlspecialchars($_SESSION['first_name']); ?>'s Hub
      </a>
      <nav class="mt-4 flex flex-col space-y-2 p-4 text-gray-700">
        <a href="basic-profile.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Basic Profile</a>
        <a href="professional-details.php" class="bg-yellow-100 text-yellow-800 font-medium px-4 py-2 rounded">Professional Details</a>
        <a href="work-experience.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Work Experience</a>
        <a href="social-links.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Social Links</a>
        <a href="availability.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Availability & Preferences</a>
        <a href="upload-post.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Upload Post</a>
        <!-- <a href="settings.php" class="hover:bg-yellow-100 px-4 py-2 rounded">Notifications & Settings</a> -->
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
      <div class="text-2xl font-semibold text-gray-800 mb-6">Professional Details</div>

      <form action="save-professional-details.php" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">

        <!-- Architectural Firm Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Architectural Firm Name</label>
          <input type="text" name="firm_name" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>

        <!-- Type of Architect -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Type of Architect</label>
          <!-- type of architect  start-->
          <select name="type_of_architect" class="w-full border rounded px-3 py-2 mt-1" required>
            <option value="">Select Type</option>
            <option value="Residential">Residential</option>
            <option value="Commercial">Commercial</option>
            <option value="Urban Designer">Urban Designer</option>
            <option value="Landscape Architect">Landscape Architect</option>
            <option value="Interior Designer">Interior Designer</option>
            <option value="Industrial Architect">Industrial Architect</option>
            <option value="Hospitality Architect">Hospitality Architect</option>
            <option value="Educational Architect">Educational Architect</option>
            <option value="Healthcare Architect">Healthcare Architect</option>
            <option value="Sustainability/Green Architect">Sustainability/Green Architect</option>
            <option value="Restoration Architect">Restoration Architect</option>
            <option value="Transportation Architect">Transportation Architect</option>
            <option value="Exhibition/Stage Designer">Exhibition/Stage Designer</option>
            <option value="Mixed-use Architect">Mixed-use Architect</option>

          </select>
          <!-- type of architect end -->


        </div>

        <!-- Specializations start -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Expertise Areas</label>
          <select name="expertise_areas" class="w-full border rounded px-3 py-2 mt-1">
            <option value="">Select Specialization</option>
            <option value="Sustainable Design">Sustainable Design</option>
            <option value="Urban Planning">Urban Planning</option>
            <option value="Landscape Design">Landscape Design</option>
            <option value="Historic Preservation">Historic Preservation</option>
            <option value="Interior Design">Interior Design</option>
            <option value="Facade Design">Facade Design</option>
            <option value="BIM (Building Information Modeling)">BIM (Building Information Modeling)</option>
            <option value="Construction Management">Construction Management</option>
            <option value="Lighting Design">Lighting Design</option>
            <option value="Acoustic Design">Acoustic Design</option>
            <option value="Architectural Visualization">Architectural Visualization</option>
            <option value="Urban Revitalization">Urban Revitalization</option>
            <option value="Green Building">Green Building</option>
            <option value="Smart Building Design">Smart Building Design</option>
            <option value="Hospitality Design">Hospitality Design</option>
            <option value="Retail Architecture">Retail Architecture</option>
            <option value="Residential Design">Residential Design</option>
            <option value="Commercial Design">Commercial Design</option>
            <option value="Public Space Design">Public Space Design</option>
            <option value="Transportation Infrastructure">Transportation Infrastructure</option>
          </select>
        </div>

        <!-- Specializations end -->

        <!-- Affiliated Organizations start-->

        <div>
          <label class="block text-sm font-medium text-gray-700">Affiliated Organizations</label>
          <select name="affiliated_organizations" class="w-full border rounded px-3 py-2 mt-1">
            <option value="">Select an Organization</option>
            <option value="Council of Architecture (COA)">Council of Architecture (COA)</option>
            <option value="American Institute of Architects (AIA)">American Institute of Architects (AIA)</option>
            <option value="Royal Institute of British Architects (RIBA)">Royal Institute of British Architects (RIBA)</option>
            <option value="International Union of Architects (UIA)">International Union of Architects (UIA)</option>
            <option value="Architects Association of India (AAI)">Architects Association of India (AAI)</option>
            <option value="International Code Council (ICC)">International Code Council (ICC)</option>
            <option value="National Council of Architectural Registration Boards (NCARB)">National Council of Architectural Registration Boards (NCARB)</option>
          </select>
        </div>



        <!-- Affiliated Organizations end-->

        <!-- Professional License/Registration Number start -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Professional License/Registration Number</label>
          <input type="text" name="license_number" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <!-- Professional License/Registration Number end -->


        <hr style="border-top: 1px solid black;">

        <!-- Education Details start -->
        <div>
          <label class="block text-xl font-semibold text-gray-800">Education Details</label>
          <div class="space-y-4">
            <!-- Education Entry 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

              <!-- Degree  start-->
              <div>
                <label class="block text-sm font-medium text-gray-700">Degree</label>
                <select name="degree" class="w-full border rounded px-3 py-2 mt-1" required>
                  <option value="" disabled selected>Select your Degree</option>

                  <optgroup label="Bachelor's Degrees">
                    <option value="Bachelor of Architecture (B.Arch)">Bachelor of Architecture (B.Arch)</option>
                    <option value="Bachelor of Design (B.Des) – Architecture">Bachelor of Design (B.Des) – Architecture</option>
                    <option value="Bachelor of Planning (B.Plan)">Bachelor of Planning (B.Plan)</option>
                    <option value="Bachelor of Fine Arts (BFA)">Bachelor of Fine Arts (BFA) – Architecture/Design</option>
                    <option value="Bachelor of Science in Architecture (B.Sc Arch)">Bachelor of Science in Architecture (B.Sc Arch)</option>
                    <option value="Bachelor of Interior Architecture (BIA)">Bachelor of Interior Architecture (BIA)</option>
                    <option value="Bachelor of Landscape Architecture (BLA)">Bachelor of Landscape Architecture (BLA)</option>
                    <option value="Bachelor of Urban and Regional Planning (BURP)">Bachelor of Urban and Regional Planning (BURP)</option>
                    <option value="Bachelor of Construction Technology (BCT)">Bachelor of Construction Technology (BCT)</option>
                    <option value="Bachelor of Sustainable Built Environment">Bachelor of Sustainable Built Environment</option>
                    <option value="Bachelor of Building Science">Bachelor of Building Science</option>
                    <option value="Bachelor of Environmental Design">Bachelor of Environmental Design</option>
                    <option value="Bachelor of Project Management (Construction)">Bachelor of Project Management (Construction)</option>
                  </optgroup>

                  <optgroup label="Master's Degrees">
                    <option value="Master of Architecture (M.Arch)">Master of Architecture (M.Arch)</option>
                    <option value="Master of Landscape Architecture (MLA)">Master of Landscape Architecture (MLA)</option>
                    <option value="Master of Urban Planning (MUP)">Master of Urban Planning (MUP)</option>
                    <option value="Master of City Planning (MCP)">Master of City Planning (MCP)</option>
                    <option value="Master of Sustainable Design (MSD)">Master of Sustainable Design (MSD)</option>
                    <option value="Master of Interior Architecture (MIA)">Master of Interior Architecture (MIA)</option>
                    <option value="Master of Construction Management (MCM)">Master of Construction Management (MCM)</option>
                    <option value="Master of Heritage Conservation (MHC)">Master of Heritage Conservation (MHC)</option>
                    <option value="Master of Environmental Design (MEDes)">Master of Environmental Design (MEDes)</option>
                    <option value="Master of Urban Design (MUD)">Master of Urban Design (MUD)</option>
                    <option value="Master of Building Engineering and Management">Master of Building Engineering and Management</option>
                    <option value="Master of Planning (M.Plan)">Master of Planning (M.Plan)</option>
                  </optgroup>

                  <optgroup label="Diploma & Certification">
                    <option value="Diploma in Architecture">Diploma in Architecture</option>
                    <option value="Diploma in Interior Design">Diploma in Interior Design</option>
                    <option value="Diploma in Urban Planning">Diploma in Urban Planning</option>
                    <option value="Diploma in Landscape Architecture">Diploma in Landscape Architecture</option>
                    <option value="Advanced Diploma in Architectural Technology">Advanced Diploma in Architectural Technology</option>
                    <option value="Diploma in Sustainable Architecture">Diploma in Sustainable Architecture</option>
                    <option value="Diploma in Construction Management">Diploma in Construction Management</option>
                    <option value="Postgraduate Diploma in Urban Planning and Management">Postgraduate Diploma in Urban Planning and Management</option>
                  </optgroup>

                  <optgroup label="Doctorate Programs">
                    <option value="Ph.D. in Architecture">Ph.D. in Architecture</option>
                    <option value="Ph.D. in Urban Planning">Ph.D. in Urban Planning</option>
                    <option value="Ph.D. in Architectural Conservation">Ph.D. in Architectural Conservation</option>
                    <option value="Doctor of Architecture (D.Arch)">Doctor of Architecture (D.Arch)</option>
                  </optgroup>

                  <optgroup label="Emerging & Interdisciplinary Fields">
                    <option value="Smart Cities and Urban Analytics">Smart Cities and Urban Analytics</option>
                    <option value="Green Architecture">Green Architecture</option>
                    <option value="Sustainable Urbanism">Sustainable Urbanism</option>
                    <option value="Disaster Resilient Architecture">Disaster Resilient Architecture</option>
                    <option value="Architectural Robotics">Architectural Robotics</option>
                    <option value="Digital Architecture (AI/VR/AR)">Digital Architecture (AI/VR/AR)</option>
                    <option value="Environmental and Energy-efficient Design">Environmental and Energy-efficient Design</option>
                  </optgroup>
                </select>
                <!-- degree end  -->
              </div>

              <!-- Institution -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Institution</label>
                <select name="institution" class="w-full border rounded px-3 py-2 mt-1" required>
                  <option value="" disabled selected>Select your Institution</option>

                  <optgroup label="Top Indian Architecture Colleges">
                    <option value="Indian Institute of Technology (IIT) Kharagpur">Indian Institute of Technology (IIT) Kharagpur</option>
                    <option value="Indian Institute of Technology (IIT) Roorkee">Indian Institute of Technology (IIT) Roorkee</option>
                    <option value="School of Planning and Architecture (SPA) Delhi">School of Planning and Architecture (SPA) Delhi</option>
                    <option value="School of Planning and Architecture (SPA) Bhopal">School of Planning and Architecture (SPA) Bhopal</option>
                    <option value="School of Planning and Architecture (SPA) Vijayawada">School of Planning and Architecture (SPA) Vijayawada</option>
                    <option value="Sir J.J. College of Architecture, Mumbai">Sir J.J. College of Architecture, Mumbai</option>
                    <option value="CEPT University, Ahmedabad">CEPT University, Ahmedabad</option>
                    <option value="Chandigarh College of Architecture, Chandigarh">Chandigarh College of Architecture, Chandigarh</option>
                    <option value="Birla Institute of Technology (BIT) Mesra, Ranchi">Birla Institute of Technology (BIT) Mesra, Ranchi</option>
                    <option value="Manipal School of Architecture and Planning, Manipal">Manipal School of Architecture and Planning, Manipal</option>
                    <option value="Jamia Millia Islamia, Delhi">Jamia Millia Islamia, Delhi</option>
                    <option value="NIT Calicut - Department of Architecture">NIT Calicut - Department of Architecture</option>
                    <option value="NIT Trichy - Department of Architecture">NIT Trichy - Department of Architecture</option>
                    <option value="RV College of Architecture, Bangalore">RV College of Architecture, Bangalore</option>
                    <option value="Rizvi College of Architecture, Mumbai">Rizvi College of Architecture, Mumbai</option>
                    <option value="Dr. D.Y. Patil College of Architecture, Pune">Dr. D.Y. Patil College of Architecture, Pune</option>
                    <option value="BMS College of Architecture, Bangalore">BMS College of Architecture, Bangalore</option>
                    <option value="Sinhgad College of Architecture, Pune">Sinhgad College of Architecture, Pune</option>
                    <option value="Amity School of Architecture and Planning, Noida">Amity School of Architecture and Planning, Noida</option>
                    <option value="SRM Institute of Science and Technology, Chennai">SRM Institute of Science and Technology, Chennai</option>
                    <option value="VIT School of Architecture, Vellore">VIT School of Architecture, Vellore</option>
                    <option value="Lovely Professional University (LPU), Punjab">Lovely Professional University (LPU), Punjab</option>
                    <option value="Chitkara School of Planning and Architecture, Punjab">Chitkara School of Planning and Architecture, Punjab</option>
                    <option value="M.S. Ramaiah Institute of Technology, Bangalore">M.S. Ramaiah Institute of Technology, Bangalore</option>
                  </optgroup>

                  <optgroup label="Top International Architecture Colleges">
                    <option value="Massachusetts Institute of Technology (MIT), USA">Massachusetts Institute of Technology (MIT), USA</option>
                    <option value="University College London (UCL) - Bartlett School of Architecture, UK">University College London (UCL) - Bartlett School of Architecture, UK</option>
                    <option value="Delft University of Technology (TU Delft), Netherlands">Delft University of Technology (TU Delft), Netherlands</option>
                    <option value="ETH Zurich - Swiss Federal Institute of Technology, Switzerland">ETH Zurich - Swiss Federal Institute of Technology, Switzerland</option>
                    <option value="Harvard University Graduate School of Design (GSD), USA">Harvard University Graduate School of Design (GSD), USA</option>
                    <option value="Politecnico di Milano, Italy">Politecnico di Milano, Italy</option>
                    <option value="University of California, Berkeley (UCB), USA">University of California, Berkeley (UCB), USA</option>
                    <option value="University of Cambridge, UK">University of Cambridge, UK</option>
                    <option value="University of Melbourne, Australia">University of Melbourne, Australia</option>
                    <option value="National University of Singapore (NUS)">National University of Singapore (NUS)</option>
                    <option value="University of Hong Kong (HKU)">University of Hong Kong (HKU)</option>
                    <option value="Tsinghua University, China">Tsinghua University, China</option>
                    <option value="Cornell University, USA">Cornell University, USA</option>
                    <option value="Columbia University (GSAPP), USA">Columbia University (GSAPP), USA</option>
                    <option value="University of Tokyo, Japan">University of Tokyo, Japan</option>
                    <option value="University of British Columbia (UBC), Canada">University of British Columbia (UBC), Canada</option>
                    <option value="McGill University, Canada">McGill University, Canada</option>
                    <option value="Royal Danish Academy of Fine Arts, Denmark">Royal Danish Academy of Fine Arts, Denmark</option>
                  </optgroup>

                  <optgroup label="Other Institutions">
                    <option value="Other Indian Institution">Other Indian Institution</option>
                    <option value="Other International Institution">Other International Institution</option>
                  </optgroup>

                </select>

              </div>

              <!-- Year of Passing -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Year of Passing</label>
                <select name="passing_year" class="w-full border rounded px-3 py-2 mt-1" required>
                  <option value="" selected disabled>Select Year</option>
                  <!-- Years will be populated dynamically via JavaScript -->
                </select>
              </div>

              <!-- Specialization -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Specialization (if any)</label>
                <select name="specialization" class="w-full border rounded px-3 py-2 mt-1">
                  <option value="" disabled selected>Select your Specialization (if any)</option>

                  <optgroup label="Architecture Specializations">
                    <option value="Urban Design">Urban Design</option>
                    <option value="Landscape Architecture">Landscape Architecture</option>
                    <option value="Interior Architecture">Interior Architecture</option>
                    <option value="Sustainable Architecture">Sustainable Architecture</option>
                    <option value="Architectural Conservation">Architectural Conservation</option>
                    <option value="Housing Architecture">Housing Architecture</option>
                    <option value="Industrial Architecture">Industrial Architecture</option>
                    <option value="Heritage and Conservation">Heritage and Conservation</option>
                    <option value="Urban and Regional Planning">Urban and Regional Planning</option>
                    <option value="Building Science and Technology">Building Science and Technology</option>
                    <option value="Digital Architecture">Digital Architecture</option>
                    <option value="Construction Management">Construction Management</option>
                    <option value="Project Management">Project Management</option>
                    <option value="Environmental Architecture">Environmental Architecture</option>
                    <option value="Transport Planning">Transport Planning</option>
                    <option value="Architectural Design">Architectural Design</option>
                    <option value="Town Planning">Town Planning</option>
                    <option value="Smart Cities and Urban Development">Smart Cities and Urban Development</option>
                    <option value="Real Estate Development">Real Estate Development</option>
                    <option value="Architectural Journalism">Architectural Journalism</option>
                    <option value="Set Design (Film and TV)">Set Design (Film and TV)</option>
                    <option value="Lighting Design">Lighting Design</option>
                    <option value="Healthcare Architecture">Healthcare Architecture</option>
                    <option value="Hospitality Architecture">Hospitality Architecture</option>
                    <option value="Retail Design">Retail Design</option>
                    <option value="Exhibition and Museum Design">Exhibition and Museum Design</option>
                    <option value="Parametric Design">Parametric Design</option>
                    <option value="BIM (Building Information Modeling)">BIM (Building Information Modeling)</option>
                    <option value="Furniture Design">Furniture Design</option>
                  </optgroup>

                  <optgroup label="Other Specializations">
                    <option value="Other Specialization">Other Specialization</option>
                  </optgroup>
                </select>

              </div>

            </div>
          </div>
        </div>

        <!-- Year of Passing: Auto-fill with JavaScript -->
        <script>
          const yearSelects = document.getElementsByName('passing_year');
          const currentYear = new Date().getFullYear();
          const startYear = 1980;

          for (let year = currentYear; year >= startYear; year--) {
            let option = document.createElement('option');
            option.value = year;
            option.text = year;
            yearSelects.forEach(select => select.add(option.cloneNode(true)));
          }
        </script>



        <!-- Education Details end -->

        <hr style="border-top: 1px solid black;">
        <!-- Certifications & Courses start -->
        <div>
          <label class="block text-xl font-semibold text-gray-800">Certifications & Courses</label>
          <div class="space-y-4 mt-2">
            <!-- Certification Entry 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Certification Name</label>
                <input type="text" name="certification_name" class="w-full border rounded px-3 py-2 mt-1" placeholder="e.g., LEED Certification" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Institution/Organization</label>
                <input type="text" name="certification_institution" class="w-full border rounded px-3 py-2 mt-1" placeholder="e.g., Green Building Council" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Year of Completion</label>
                <input type="number" name="certification_year" class="w-full border rounded px-3 py-2 mt-1" placeholder="e.g., 2021" min="1900" max="2099" required>

              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Certification Number/Code</label>
                <input type="text" name="certification_number" class="w-full border rounded px-3 py-2 mt-1" placeholder="e.g., 12345XYZ" required>
              </div>
            </div>

            <!-- Certifications & Courses end -->


            <!-- Languages Spoken start-->
            <label class="block text-sm font-medium text-gray-700">Well know language</label>

            <select name="language" class="w-full border rounded px-3 py-2 mt-1">
              <option value="">Select Language</option>
              <option value="Hindi">Hindi</option>
              <option value="Bengali">Bengali</option>
              <option value="Telugu">Telugu</option>
              <option value="Marathi">Marathi</option>
              <option value="Tamil">Tamil</option>
              <option value="Urdu">Urdu</option>
              <option value="Gujarati">Gujarati</option>
              <option value="Malayalam">Malayalam</option>
              <option value="Kannada">Kannada</option>
              <option value="Odia">Odia</option>
              <option value="Punjabi">Punjabi</option>
              <option value="Assamese">Assamese</option>
              <option value="Maithili">Maithili</option>
              <option value="Santali">Santali</option>
              <option value="Kashmiri">Kashmiri</option>
              <option value="Nepali">Nepali</option>
              <option value="Sindhi">Sindhi</option>
              <option value="Dogri">Dogri</option>
              <option value="Manipuri">Manipuri</option>
              <option value="Bodo">Bodo</option>
              <option value="Sanskrit">Sanskrit</option>
              <option value="Khasi">Khasi</option>
              <option value="Mizo">Mizo</option>
              <option value="Hindi (Dialect)">Hindi (Dialect)</option>
              <option value="Marwari">Marwari</option>
              <option value="Tulu">Tulu</option>
              <option value="Konkani">Konkani</option>
              <option value="Rajasthani">Rajasthani</option>
              <option value="Awadhi">Awadhi</option>
              <option value="Chhattisgarhi">Chhattisgarhi</option>
              <option value="Haryanvi">Haryanvi</option>
              <option value="Bundeli">Bundeli</option>
            </select>

            <!-- Languages Spoken end -->


            <!-- Save Button -->
            <div class="pt-4">
              <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded">Save</button>
            </div>
      </form>
    </main>
  </div>
</body>

</html>