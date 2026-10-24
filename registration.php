<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - UrArchitect</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
<!-- <body class="bg-gray-100 font-sans pt-20"> -->


  <!-- Header start -->
  <header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <a href="index.php" class="flex items-center space-x-2 group">
        <h1 class="text-2xl font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
          link<span class="text-gray-800 ">io</span>
        </h1>
      </a>

    </div>
  </header>
  <!-- Header start -->




  <!-- Registration Section -->
  <main class="flex items-center justify-center min-h-screen py-8 px-4">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-2xl">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Create Your Account</h2>

      <form action="save-user.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4" onsubmit="return validateForm()">
  <!-- First Name -->
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
    <input type="text" name="first_name" required minlength="2" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" />
  </div>

  <!-- Surname -->
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Surname</label>
    <input type="text" name="surname" required minlength="2" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" />
  </div>

  <!-- Username -->
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
    <input type="text" name="username" required minlength="4" maxlength="20" 
           pattern="^[^\s]+$" 
           title="Username should not contain spaces" 
           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" />
</div>

  <!-- Email -->
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
    <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" />
  </div>

  <!-- Phone -->
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
    <input type="text" name="phone" required pattern="[0-9]{10}" title="Enter 10 digit phone number" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" />
  </div>

  <!-- Password -->
  <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
    <input type="password" name="password" required minlength="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" />
  </div>

  <!-- Role -->
  <!-- <div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
    <select name="role" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
      <option value="" disabled selected>Select Role</option>
      <option value="Client">Client</option>
      <option value="Architect">Architect</option>
    </select>
  </div> -->

  <div class="md:col-span-2">
    <button type="submit" class="w-full bg-yellow-600 text-white font-medium py-3 rounded-lg hover:bg-red-700 transition">Register</button>
  </div>

  
</form>
<div class="text-center mt-4">
        <p class="text-sm text-gray-600">
          already have an account?
          <a href="login.php" class="text-blue-600 hover:underline font-medium">Login</a>
        </p>
        
      </div>
    </div>
  </main>


  <script>
function validateForm() {
  const phone = document.querySelector('input[name="phone"]').value;
  const password = document.querySelector('input[name="password"]').value;

  if (!/^\d{10}$/.test(phone)) {
    alert("Phone number must be 10 digits.");
    return false;
  }

  if (password.length < 6) {
    alert("Password must be at least 6 characters.");
    return false;
  }

  return true; // All good
}
</script>


</body>
</html>
