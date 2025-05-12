<?php

// Include DB connection if not already included
include '../components/connect.php';

// Get admin ID from session
$admin_id = $_SESSION['admin_id'] ?? null;

// Fetch admin profile if ID is available
$fetch_profile = null;
if ($admin_id) {
   $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
   $select_profile->execute([$admin_id]);
   $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
}

// Display any messages
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
<link rel="stylesheet" href="../css/admin_style.css">

<!-- Overlay for mobile -->
<div id="overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar starts -->
<aside class="sidebar">

   <div class="sidebar-header">
      <b><a href="../admin/dashboard.php" class="logo">ADMIN</a></b>
      <div id="close-btn" class="fas fa-times" onclick="toggleSidebar()"></div>
   </div>

   <nav class="sidebar-nav">
      <a href="../admin/dashboard.php"><i class="fas fa-home"></i> Home</a>
      <a href="../admin/products.php"><i class="fas fa-box"></i> Products</a>
      <a href="../admin/placed_orders.php"><i class="fas fa-shopping-cart"></i> Orders</a>
      <a href="../admin/admin_accounts.php"><i class="fas fa-user-shield"></i> Admins</a>
      <a href="../admin/users_accounts.php"><i class="fas fa-users"></i> Users</a>
      <a href="../admin/messages.php"><i class="fas fa-envelope"></i> Messages</a>
      <a href="../index.php"><i class="fas fa-store"></i> Shop</a>
   </nav>

   <div class="profile">
      <div class="profile-toggle" onclick="toggleProfile()">
         <p><strong>Admin Profile</strong> <i class="fas fa-caret-down"></i></p>
      </div>

      <div class="profile-content" style="display: none;">
         <p><?= htmlspecialchars($fetch_profile['name'] ?? 'Admin'); ?></p>
         <a href="../admin/update_profile.php" class="btn">Update Profile</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">Register</a>
            <a href="../admin/admin_login.php" class="option-btn">Login</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('Logout from the website?');">Logout</a>
      </div>
   </div>

</aside>

<!-- Toggle button for mobile -->
<div class="menu-toggle">
   <i id="menu-btn" class="fas fa-bars" onclick="toggleSidebar()"></i>
</div>

<script>
function toggleSidebar() {
   const sidebar = document.querySelector('.sidebar');
   const overlay = document.getElementById('overlay');
   sidebar.classList.toggle('active');
   overlay.classList.toggle('active');
}

function toggleProfile() {
   const content = document.querySelector('.profile-content');
   if (content.style.display === "none" || content.style.display === "") {
      content.style.display = "block";
   } else {
      content.style.display = "none";
   }
}
</script>
