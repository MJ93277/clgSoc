<!DOCTYPE html>
<html lang="en" class="light">

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
            /* padding: 10px; */
        }

        .profile-card-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            min-height: 30vh;
            margin: 0;
            padding: 0;
        }

        .search-bar {
            margin-bottom: 10px;
        }

        .profile-card {
            /* padding-left: 10px; */
            /* padding-right: 10px; */
            margin: -15px;

            width: 320px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 5px;
        }

        .top-nav {
            padding: 10px;
            font-size: 14px;
            color: #54A7FF;
            font-weight: bold;
        }

        .profile-tag {
            background: rgb(255, 145, 0);
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
            border: 4px solid #54A7FF;
            background-size: cover;
            background-position: center;
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

<body class="bg-white-100">

    <!-- Top Header -->
    <!-- <header id="main-header" class="backdrop-blur-lg bg-white dark:bg-gray-900 shadow-lg fixed w-full top-0 z-50 border-b border-gray-200 dark:border-gray-700 transition-all duration-300"> -->
    <header id="main-header" class="backdrop-blur-lg bg-white shadow-lg fixed w-full top-0 z-50 border-b border-gray-200 transition-all duration-300">


        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">


            <!-- Logo / Brand -->
            <!-- <a href="index.php" class="flex items-center space-x-2 group"> -->
                <h1 class="text-2xl select-none font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
                    link<span class="text-gray-800">IO</span>
                </h1>
             

            <!-- Search Bar with Button -->
            <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4 w-full max-w-xl">

                <!-- Home Button -->
                <button onclick="history.back()"
                    class="relative inline-flex items-center justify-center gap-2 px-7 py-3 bg-gradient-to-r from-yellow-500 to-yellow-400 text-white text-sm font-semibold rounded-full shadow-md hover:shadow-xl hover:from-yellow-600 hover:to-yellow-500 transition-all duration-300 ease-in-out group">

                    <span class="absolute inset-0 rounded-full bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>

                    <i class="fa fa-home text-base"></i>
                    <span class="relative z-10 tracking-wider">Go Back Home</span>
                </button>


                <!-- Search Input -->
                <div class="flex-1 w-full">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search..."
                        class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 rounded-lg px-4 py-2 transition duration-200 outline-none shadow-sm">
                </div>

            </div>

        </div>
    </header>









    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto main-content ">


        <!-- Div where the search results will be dynamically inserted -->
        <div id="searchResults">
            <!-- Results will appear here after AJAX call -->
        </div>




    </main>
    </div>
    <script>
        document.getElementById("searchInput").addEventListener("input", function() {
            let searchTerm = this.value; // Get the value of the search input

            // Check if search term is empty
            if (searchTerm.length > 0) {
                // Make an AJAX request to the server
                fetch('searchData.php?search=' + searchTerm)
                    .then(response => response.text())
                    .then(data => {
                        // Update the search results container with the fetched data
                        document.getElementById("searchResults").innerHTML = data;
                    })
                    .catch(error => console.error("Error fetching data: ", error));
            } else {
                // If the search bar is empty, clear the results
                document.getElementById("searchResults").innerHTML = "";
            }
        });




        // select option
        document.getElementById("searchInput").addEventListener("input", function() {
            let searchTerm = this.value; // Get the value of the search input

            // Check if search term is empty
            if (searchTerm.length > 0) {
                // Make an AJAX request to the server
                fetch('searchData.php?search=' + searchTerm)
                    .then(response => response.text())
                    .then(data => {
                        // Update the search results container with the fetched data
                        document.getElementById("searchResults").innerHTML = data;
                    })
                    .catch(error => console.error("Error fetching data: ", error));
            } else {
                // If the search bar is empty, clear the results
                document.getElementById("searchResults").innerHTML = "";
            }
        });

        // Listen for changes in select filters and trigger AJAX requests
        document.getElementById("professionalTitle").addEventListener("change", function() {
            let professionalTitle = this.value;
            applyFilters(professionalTitle, 'professionalTitle');
        });

        document.getElementById("specialization").addEventListener("change", function() {
            let specialization = this.value;
            applyFilters(specialization, 'specialization');
        });

        document.getElementById("experience").addEventListener("change", function() {
            let experience = this.value;
            applyFilters(experience, 'experience');
        });

        function applyFilters(filterValue, filterType) {
            // Check if the filter value is empty
            if (filterValue.length > 0) {
                // Make an AJAX request to fetch filtered data
                fetch(`searchData.php?${filterType}=${filterValue}`)
                    .then(response => response.text())
                    .then(data => {
                        // Update the search results container with the filtered data
                        document.getElementById("searchResults").innerHTML = data;
                    })
                    .catch(error => console.error("Error fetching filtered data: ", error));
            } else {
                // If the filter is empty, clear the results
                document.getElementById("searchResults").innerHTML = "";
            }
        }
    </script>

</body>

</html>