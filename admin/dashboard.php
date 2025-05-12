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
   <div class="inventory-container">
       <div class="inventory-chart">
         <canvas id="paymentStatusPie" width="400" height="400"></canvas>
      </div>
      <div class="top-sellers">
         <h3>Top Seller Products</h3>
         <ul>
            <?php
               // Fetch top-selling products
               $top_query = $conn->query("
                  SELECT p.name, SUM(o.total_price) as total_sales
                  FROM orders o
                  JOIN products p ON o.total_products LIKE CONCAT('%', p.name, '%')
                  WHERE o.payment_status = 'completed'
                  GROUP BY p.name
                  ORDER BY total_sales DESC
                  LIMIT 5
               ");

               $top_sellers = $top_query->fetchAll(PDO::FETCH_ASSOC);

               // Find max sales for percentage width
               $max_sales = 0;
               foreach ($top_sellers as $product) {
                  if ($product['total_sales'] > $max_sales) {
                     $max_sales = $product['total_sales'];
                  }
               }

               foreach ($top_sellers as $product) {
                  $percent = $max_sales > 0 ? ($product['total_sales'] / $max_sales) * 100 : 0;
                  echo '<div class="seller-bar">';
                  echo '<div class="label">' . htmlspecialchars($product['name']) . ' - ₱' . number_format($product['total_sales'], 2) . '</div>';
                  echo '<div class="bar" style="width:' . $percent . '%"></div>';
                  echo '</div>';
               }
               ?>

         </ul>
      </div>
   </div>
</section>


<?php
   // Fetch counts for payment statuses
   $pending_count = $conn->query("SELECT COUNT(*) FROM orders WHERE payment_status = 'pending'")->fetchColumn();
   $completed_count = $conn->query("SELECT COUNT(*) FROM orders WHERE payment_status = 'completed'")->fetchColumn();
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const paymentStatusCtx = document.getElementById('paymentStatusPie').getContext('2d');
const paymentStatusChart = new Chart(paymentStatusCtx, {
   type: 'pie',
   data: {
      labels: ['Pending', 'Completed'],
      datasets: [{
         label: 'Orders',
         data: [<?= $pending_count ?>, <?= $completed_count ?>],
         backgroundColor: ['#f39c12', '#2ecc71'],
         borderWidth: 1
      }]
   },
   options: {
      responsive: true,
      plugins: {
         legend: {
            position: 'bottom'
         },
         title: {
            display: true,
            text: 'Payment Status Distribution'
         }
      }
   }
});
</script>



<style>

.inventory-container {
   display: flex;
   flex-direction: row;
   justify-content: flex-start;
   align-items: flex-start;
   gap: 2rem;
   padding: 1rem;
   flex-wrap: wrap;
}

.inventory-chart {
   display: flex;
   flex-direction: column;
   gap: 1.5rem;
   max-width: 500px;
   width: 100%;
   flex: 1;
}

.inventory canvas {
   max-width: 100%;
   height: auto;
}

.top-sellers {
   flex: 2; /* Allow it to grow more */
   max-width: 100%;
   background-color: #fff;
   border: 1px solid #ddd;
   padding: 2rem;
   border-radius: 12px;
   text-align: left;
   min-width: 350px;
   box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.top-sellers h3 {
   font-size: 1.8rem;
   margin-bottom: 1.5rem;
}



.seller-bar {
   margin-bottom: 2rem;
}

.seller-bar .label {
   font-weight: 600;
   font-size: 1rem;
   margin-bottom: 0.5rem;
   color: #333;
}

.seller-bar .bar {
   height: 20px;
   background: #3498db;
   border-radius: 6px;
   transition: width 0.4s ease;
}


</style>

</body>
</html>
