<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Scroll Random User</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-[300vh]"> <!-- 300vh height for scroll -->

<main id="card" class="flex items-center justify-center bg-white rounded-2xl shadow-2xl h-48 w-96 mt-10 text-2xl font-bold text-gray-800 transition-all duration-500 mx-auto">
  Loading Name...
</main>

<script>
// Function to fetch random user
function fetchRandomUser() {
    fetch('random_user.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error(data.error);
            return;
        }
        // Only update the name
        document.getElementById('card').textContent = data.name;
    })
    .catch(error => {
        console.error('Error fetching user:', error);
    });
}

// New Scroll Detection
window.addEventListener('scroll', function() {
    if (window.scrollY + window.innerHeight >= document.body.scrollHeight - 100) {
        console.log('Reached bottom, fetching new user...');
        fetchRandomUser();
    }
});

// Load first random user
window.onload = fetchRandomUser;
</script>

</body>
</html>
