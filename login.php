<!-- login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login - ArchitectHub</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

  <!-- Header start -->
  <header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <!-- <a href="index.php" class="text-2xl font-bold text-yellow-600">UrArchitect</a> -->
      <a href="index.php" class="flex items-center space-x-2 group">
        <h1 class="text-2xl font-extrabold tracking-widest text-yellow-500 uppercase transition duration-300 group-hover:scale-105">
          link<span class="text-gray-800 ">io</span>
        </h1>
      </a>

    </div>
  </header>
  <!-- Header start -->

  <div class="flex h-screen justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
      <div class="text-2xl font-semibold text-gray-800 mb-6 text-center">Login</div>

      <form action="login-action.php" method="POST" class="space-y-6">
        <!-- Username -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" name="username" class="w-full border rounded px-3 py-2 mt-1" placeholder="Enter your Username" required>
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" class="w-full border rounded px-3 py-2 mt-1" placeholder="Enter your password" required>
        </div>



        <!-- Login Button -->
        <div class="pt-4">
          <button type="submit" class="bg-yellow-600 hover:bg-red-700 text-white px-6 py-2 rounded w-full">Login</button>
        </div>
      </form>

      <!-- Forgotten Password and Register Links -->
      <div class="text-center mt-4">
        <p class="text-sm text-gray-600">
          Don't have an account?
          <a href="registration.php" class="text-blue-600 hover:underline font-medium">Register</a>
        </p>
        <p class="text-sm text-gray-600 mt-2">
          <a href="forgetten-psw.php" class="text-blue-600 hover:underline font-medium">Forgotten Password?</a>
        </p>
      </div>
    </div>
  </div>

</body>

</html>