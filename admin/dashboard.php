<?php

include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit;
}

// Counts
$total_users = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_messages = $conn->query("SELECT COUNT(*) FROM messages")->fetchColumn();
$total_orders = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$total_products = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();

// Total sales (assuming 'orders' table has 'total_price' column and 'status' = 'completed')
$total_sales = $conn->query("SELECT SUM(total_price) FROM orders WHERE payment_status = 'completed'")->fetchColumn();
$total_sales = $total_sales ? $total_sales : 0;

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Admin Dashboard</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">
   <h1 class="heading">Admin Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3><?= $total_users ?></h3>
         <p>Regular Users</p>
         <a href="users_accounts.php" class="btn">See Users</a>
      </div>

      <div class="box">
         <h3><?= $total_messages ?></h3>
         <p>Messages</p>
         <a href="messages.php" class="btn">See Messages</a>
      </div>

      <div class="box">
         <h3><?= $total_orders ?></h3>
         <p>Orders</p>
         <a href="placed_orders.php" class="btn">See Orders</a>
      </div>

      <div class="box">
         <h3><?= $total_products ?></h3>
         <p>Products</p>
         <a href="products.php" class="btn">See Products</a>
      </div>

      <div class="box">
         <h3>$<?= number_format($total_sales, 2) ?></h3>
         <p>Total Sales</p>
      </div>

   </div>
</section>

<!-- Inventory Section -->
<section class="inventory">
   <h2 class="heading">Inventory</h2>
   <div class="inventory-table">
      <table>
         <thead>
            <tr>
               <th>Product Name</th>
               <th>Category</th>
               <th>Price</th>
               <th>Stock</th>
               <th>Status</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $select_products = $conn->query("SELECT * FROM products");
               while ($product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  echo '<tr>
                     <td>' . htmlspecialchars($product['name']) . '</td>
                     <td>$' . number_format($product['price'], 2) . '</td>
                     <td>' . $product['stocks'] . '</td>
                     <td>' . ($product['stocks'] > 0 ? 'Available' : 'Out of Stock') . '</td>
                  </tr>';
               }
            ?>
         </tbody>
      </table>
   </div>
</section>

<script src="../js/admin_script.js"></script>

<style>
   .inventory-table table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2rem;
   }
   .inventory-table th, .inventory-table td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
   }
   .inventory-table th {
      background-color: #f5f5f5;
   }
   .inventory-table td {
      background-color: #fff;
   }
   .inventory .heading {
      text-align: center;
      margin: 2rem 0 1rem;
   }
</style>

</body>
</html>
