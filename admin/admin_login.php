<?php

include '../components/connect.php';

session_start();
ob_start(); // Allows header redirection

// Show errors (for development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
   $name = trim($_POST['name']);
   $pass = sha1(trim($_POST['pass'])); // Not recommended for production, see notes below

   // Debugging output - remove after testing
   echo 'Input Username: ' . $name . '<br>';
   echo 'Input Password (SHA1): ' . $pass . '<br>';

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);

   echo 'Rows found: ' . $select_admin->rowCount() . '<br>'; // For debug

   if ($select_admin->rowCount() > 0) {
      $row = $select_admin->fetch(PDO::FETCH_ASSOC);

      // Optional: Show matched user data
      echo 'Matched Admin ID: ' . $row['id'] . '<br>';

      $_SESSION['admin_id'] = $row['id'];
      header('Location: dashboard.php');
      exit();
   } else {
      $message[] = 'Incorrect username or password!';
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php
if (isset($message)) {
   foreach ($message as $msg) {
      echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<section class="form-container">

   <form action="" method="post">
      <h3>Admin Login</h3>
      <input type="text" name="name" required placeholder="Admin Username" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Admin Password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Login Now" class="btn" name="submit">
   </form>

</section>

</body>
</html>
