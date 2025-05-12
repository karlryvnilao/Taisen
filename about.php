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
   <title>About Us</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
   <?php include 'components/user_header.php'; ?>

   <section class="about">
      <div class="row">

         <div class="image">
            <img src="images/taisei.gif" alt="">
         </div>
         <div class="content">
            <h3>About Us</h3>
            <p>
               About Taisei Electronics (Philippines), Inc.
Overview: Taisei Electronics (Philippines), Inc. is a subsidiary of the TAISEI Group, established primarily for manufacturing and trading wire harnesses for export. Founded in 2013, the company operates in Lipa City, Batangas, and employs around 836 people.

Company Overview
Parent Company: TAISEI Group (Japan, est. 1948)
Purpose: Manufacture and trade wire harnesses for export
Location and Operations
Location: Lipa City, Batangas
Employees: ~836 people
Business Focus
Products: Wire harnesses for electronics and automotive
Market: Primarily for export
More from Taisei Group
Taisei Philippine Construction Inc. has supported major infrastructure projects such as Iloilo Airport and the Manila North-South Commuter Train Project. Services include consulting, design, construction, and maintenance.
            </p>
            <a href="contact.php" class="btn">Contact us</a>
         </div>
      </div>
   </section>


<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>