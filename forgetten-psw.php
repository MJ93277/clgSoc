<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- <link href="css/reset.css" rel="stylesheet" /> -->
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <form method="POST" action="forgetten-psw-connect.php" class="space-y-4 w-full max-w-md bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-semibold text-center">Forgot Password</h2>

    <input type="text" name="username" placeholder="Enter your Username" class="w-full border px-3 py-2 rounded" required>

    <!-- <button type="submit" name="check_phone" class="w-full bg-yellow-500 text-white py-2 rounded">Continue</button> -->
     <input type="submit"  class="w-full bg-yellow-500 text-white py-2 rounded"  value="Send OTP">

    <p class="text-sm text-center mt-4">
      <a href="login.php" class="text-blue-600 underline">Back to Login</a>
    </p>
  </form>

</body>
</html>
