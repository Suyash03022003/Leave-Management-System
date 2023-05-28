<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<?php session_start();?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu </title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/65712a75e6.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/sideNavbar_comman.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="../css/Staff_HomePage.css?v=<?php echo time(); ?>">
   </head>
<body>
  <div class="sidebar open">
    <div class="logo-details">
    <img class="bitlogo" src="../../assets/bitlogo_transparent.png" alt="profileImg">
        <div class="logo_name">LMS</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
          <i class='bx bx-search' ></i>
         <input type="text" placeholder="Search...">
         <span class="tooltip">Search</span>
      </li>
      <li>
        <a href="./Principal_dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="./HOD_myteam.php">
        <i class="fas fa-users"></i>
          <span class="links_name">Departments</span>
        </a>
         <span class="tooltip">Departments</span>
      </li>
      <li>
       <a href="./HOD_apply_leave.php">
       <i class="fas fa-sticky-note"></i>
         <span class="links_name">Apply Leave</span>
       </a>
       <span class="tooltip">Apply Leave</span>
     </li>
     <li>
       <a href="./Principal_staff_approval.php">
       <i class="fa-solid fa-building-user"></i>
         <span class="links_name">Staff Requests</span>
       </a>
       <span class="tooltip">Staff Requests</span>
     </li>
     <li class="profile">
         <div class="profile-details">
         <!-- <img src="assets/ganesh.jpg" alt="profileImg"> -->
         <img src="../../assets/ganesh.jpg" alt="profileImg">
           
          
           <div class="name_job">
             <div class="name"><?php echo $_SESSION['fullname']?></div>
             <div class="job">ID: <?php echo $_SESSION['id']?></div>
           </div>
         </div>
         <a href="../logout.php" class="logouthyperlink"><i class="fa-solid fa-right-from-bracket" id="log_out"></i></a>
 
         <!-- <i class='bx bx-log-out' id="log_out" ></i> -->
     </li>
    </ul>
  </div>
  <script src="../../js/script.js"></script>
</body>
</html>