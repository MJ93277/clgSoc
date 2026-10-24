<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-yellow-100 via-white to-yellow-200 min-h-screen flex flex-col items-center justify-start py-10">

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


  <!-- Reset Form -->
  <form id="userpage" action="" method="post" onsubmit="return myfu()" class="bg-white shadow-lg rounded-lg p-8 mt-10 w-full max-w-md space-y-6">
    <h3 class="text-2xl font-bold text-yellow-600 text-center">Password Reset</h3>

    <div>
      <label class="block text-sm font-medium text-gray-700">OTP</label>
      <input type="text" name="otpfromuser" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500"/>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">New Password</label>
      <input type="password" id="npsw" name="npsw" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500"/>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
      <input type="password" id="cpsw" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500"/>
    </div>

    <div class="flex items-center space-x-2">
      <input type="checkbox" onclick="myFunction()" class="accent-yellow-500">
      <label class="text-sm text-gray-700">Show Password</label>
    </div>

    <div>
      <input type="submit" value="Change Password" class="w-full bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 font-semibold"/>
    </div>
  </form>

  <script>
    function myFunction() {
      var x = document.getElementById("npsw");
      var y = document.getElementById("cpsw");
      if (x.type === "password" || y.type === "password") {
        x.type = "text";
        y.type = "text";
      } else {
        x.type = "password";
        y.type = "password";
      }   
    }

    function myfu() { 
      var x = document.getElementById("npsw").value;
      var y = document.getElementById("cpsw").value;  
      var npage = document.getElementById("userpage");

      if(x === y){
        npage.action = "resetconnect.php";
        return true;
      } else {
        alert("Password does not match");
        return false;
      }
    }
  </script>

</body>
</html>
