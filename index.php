<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body class="home-body">
   
   <?php include 'components/user_header.php'; ?>

   <section class="index">
      <div class="content">
   <h3>WELCOME TO TAISEI</h3>
   <p>Build your dream with us.</p>
   <a href="shop.php" class="btn">Shop Now</a>
</div>

   </section>


   


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>


</body>
</html>