
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Architect Dashboard with New Profile Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 10px;
        }

        .profile-card-container {
            display: flex;
            justify-content: flex-start;
            /* Horizontal center */
            align-items: center;
            /* Vertical center */
            min-height: 100vh;
            /* Full height of the screen */
            margin: 0;
            padding: 0;
            /* Remove padding */
        }

        .search-bar {
            margin-bottom: 10px;
            /* Adjust margin to reduce space */
        }

        .profile-card {
            width: 320px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 5px;
            /* Reduced padding */
        }

        .top-nav {
            padding: 10px;
            font-size: 14px;
            color: #54A7FF;
            font-weight: bold;
        }

        .profile-tag {
            background: #54A7FF;
            padding: 5px 10px;
            border-radius: 30px;
            color: #fff;
            font-size: 12px;
        }

        .user-content {
            padding: 10px 0;
            position: relative;
        }

        .user-pro-edit {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 10px;
            /* Reduced margin */
            border: 4px solid #54A7FF;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .user-pro-edit>i {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #357AD8;
            padding: 8px;
            border-radius: 50%;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }

        .user-name {
            font-size: 20px;
            font-weight: 600;
            margin-top: 10px;
            color: #333;
        }

        .user-job-profile {
            font-size: 14px;
            color: #777;
            margin-bottom: 5px;
        }

        .user-title {
            padding: 5px;
            font-size: 13px;
            color: #57D291;
        }

        .user-skill {
            margin-top: 10px;
        }

        .skill-tag {
            background: #e0e0e0;
            color: #555;
            font-size: 12px;
            border-radius: 30px;
            padding: 5px 10px;
            margin: 3px;
            display: inline-block;
            cursor: pointer;
            transition: 0.3s;
        }

        .skill-tag:hover {
            background: #54A7FF;
            color: #fff;
        }

        .user-desc {
            font-size: 13px;
            color: #666;
            margin: 15px 0;
            padding: 0 10px;
        }

        .user-view {
            background: #54A7FF;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 14px;
            display: inline-block;
            text-decoration: none;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .user-view:hover {
            background: #357AD8;
        }
    </style>
</head>

<body>

    <!-- Top Header -->
    <header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="#" class="text-2xl font-bold text-yellow-600">UrArchitect</a>
        </div>
    </header>

    <!-- Sidebar + Main -->
    <div class="flex h-screen pt-20">

        <!-- Sidebar - Filters -->
        <aside class="w-64 bg-white shadow-lg overflow-y-auto p-6">
            <div class="text-2xl font-bold text-yellow-600 mb-6">Filters</div>

           <form class="space-y-6" method="POST" action="search.php">

    <!-- Professional Title Filter (Checkboxes) -->
    <div>
        <div class="text-sm font-semibold text-gray-700 mb-2">Professional Title</div>
        <div class="space-y-2">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Junior Architect" class="form-checkbox text-yellow-500">
                <span>Junior Architect</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Senior Architect" class="form-checkbox text-yellow-500">
                <span>Senior Architect</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Principal Architect" class="form-checkbox text-yellow-500">
                <span>Principal Architect</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Architectural Consultant" class="form-checkbox text-yellow-500">
                <span>Architectural Consultant</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Project Architect" class="form-checkbox text-yellow-500">
                <span>Project Architect</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Urban Planner" class="form-checkbox text-yellow-500">
                <span>Urban Planner</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Landscape Architect" class="form-checkbox text-yellow-500">
                <span>Landscape Architect</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Interior Architect" class="form-checkbox text-yellow-500">
                <span>Interior Architect</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Design Lead" class="form-checkbox text-yellow-500">
                <span>Design Lead</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="professional_title[]" value="Freelance Architect" class="form-checkbox text-yellow-500">
                <span>Freelance Architect</span>
            </label>
        </div>
    </div>

    <!-- Specialization Filter (Checkboxes) -->
    <div>
        <div class="text-sm font-semibold text-gray-700 mb-2">Specialization</div>
        <div class="space-y-2">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Urban Design" class="form-checkbox text-yellow-500">
                <span>Urban Design</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Landscape Architecture" class="form-checkbox text-yellow-500">
                <span>Landscape Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Interior Architecture" class="form-checkbox text-yellow-500">
                <span>Interior Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Sustainable Architecture" class="form-checkbox text-yellow-500">
                <span>Sustainable Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Architectural Conservation" class="form-checkbox text-yellow-500">
                <span>Architectural Conservation</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Housing Architecture" class="form-checkbox text-yellow-500">
                <span>Housing Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Industrial Architecture" class="form-checkbox text-yellow-500">
                <span>Industrial Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Heritage and Conservation" class="form-checkbox text-yellow-500">
                <span>Heritage and Conservation</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Urban and Regional Planning" class="form-checkbox text-yellow-500">
                <span>Urban and Regional Planning</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Building Science and Technology" class="form-checkbox text-yellow-500">
                <span>Building Science and Technology</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Digital Architecture" class="form-checkbox text-yellow-500">
                <span>Digital Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Construction Management" class="form-checkbox text-yellow-500">
                <span>Construction Management</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Project Management" class="form-checkbox text-yellow-500">
                <span>Project Management</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Environmental Architecture" class="form-checkbox text-yellow-500">
                <span>Environmental Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Transport Planning" class="form-checkbox text-yellow-500">
                <span>Transport Planning</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Architectural Design" class="form-checkbox text-yellow-500">
                <span>Architectural Design</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Town Planning" class="form-checkbox text-yellow-500">
                <span>Town Planning</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Smart Cities and Urban Development" class="form-checkbox text-yellow-500">
                <span>Smart Cities and Urban Development</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Real Estate Development" class="form-checkbox text-yellow-500">
                <span>Real Estate Development</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Architectural Journalism" class="form-checkbox text-yellow-500">
                <span>Architectural Journalism</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Set Design (Film and TV)" class="form-checkbox text-yellow-500">
                <span>Set Design (Film and TV)</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Lighting Design" class="form-checkbox text-yellow-500">
                <span>Lighting Design</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Healthcare Architecture" class="form-checkbox text-yellow-500">
                <span>Healthcare Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Hospitality Architecture" class="form-checkbox text-yellow-500">
                <span>Hospitality Architecture</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Retail Design" class="form-checkbox text-yellow-500">
                <span>Retail Design</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Exhibition and Museum Design" class="form-checkbox text-yellow-500">
                <span>Exhibition and Museum Design</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Parametric Design" class="form-checkbox text-yellow-500">
                <span>Parametric Design</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="BIM (Building Information Modeling)" class="form-checkbox text-yellow-500">
                <span>BIM (Building Information Modeling)</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="specialization[]" value="Furniture Design" class="form-checkbox text-yellow-500">
                <span>Furniture Design</span>
            </label>
        </div>
    </div>

    <!-- Experience Filter -->
    <div>
        <div class="text-sm font-semibold text-gray-700 mb-2">Experience</div>
        <div class="space-y-2">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="experience[]" value="0-2 Years" class="form-checkbox text-yellow-500">
                <span>0-2 Years</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="experience[]" value="2-5 Years" class="form-checkbox text-yellow-500">
                <span>2-5 Years</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="experience[]" value="5+ Years" class="form-checkbox text-yellow-500">
                <span>5+ Years</span>
            </label>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white w-full py-2 rounded">
        Apply Filters
    </button>

</form>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">

            <!-- Search Bar -->
            <div class="flex justify-end mb-6">
                <input type="text" placeholder="Search..." class="w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- New Profile Card -->
            <div class="profile-card-container">
                <div class="profile-card">
                    <div class="top-nav">
                        <span class="profile-tag">ArchitectHub</span>
                    </div>
                    <div class="user-content">
                        <div class="user-pro-edit" style="background-image: url('https://i.dailymail.co.uk/i/pix/2013/06/14/article-0-043DFCEA00000514-169_306x423.jpg');">
                            <!-- <i class="fa fa-pencil" aria-hidden="true"></i> -->
                        </div>

                        <div class="user-name" name="first_name">Jermaine Beck</div>
                        <div class="user-job-profile" name="professional_title">Java Developer</div>
                        
                        

                        <p class="user-desc" name="bio">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non bibendum turpis. Donec quis diam ut quam facilisis elementum sit amet in neque. Fusce id tortor dui.
                        </p>

                        <a href="#" class="user-view">View Profile</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>