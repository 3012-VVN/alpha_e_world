<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">

      <div class="logo">
        <a href="/" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
        </a>
        <a href="/" class="simple-text logo-normal" style="font-weight: Bold;">
          FX Zone
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
    
      <div class="sidebar-wrapper">
        
        <ul class="nav">
          <li class="<?php if($page=="home"){ echo "active";}?>">
            <a href="./index.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="<?php if($page=="user"){ echo "active";}?>">
            <a href="./user.php">
              <i class="nc-icon nc-single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="<?php if($page=="inviteuser"){ echo "active";}?>">
            <a href="./inviteuser.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Invite User</p>
            </a>
          </li>
          <?php 
          if ($plan !=1)
          {?>
          <li class="<?php if($page=="payoutplan"){ echo "active";}?>">
            <a href="./payoutplan.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Playout Schedule</p>
            </a>
          </li>
          <?php }?>
         <!-- <li>
            <a href="./icons.html">
              <i class="nc-icon nc-diamond"></i>
              <p>Icons</p>
            </a>
          </li>
          <li>
            <a href="./map.html">
              <i class="nc-icon nc-pin-3"></i>
              <p>Maps</p>
            </a>
          </li>
          <li>
            <a href="./notifications.html">
              <i class="nc-icon nc-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>
          
          <li>
            <a href="./tables.html">
              <i class="nc-icon nc-tile-56"></i>
              <p>Table List</p>
            </a>
          </li>
          <li>
            <a href="./typography.html">
              <i class="nc-icon nc-caps-small"></i>
              <p>Typography</p>
            </a>
          </li>-->
          <li class="active-pro">
            <a href="./upgrade.html">
              <i class="nc-icon nc-spaceship"></i>
              <p>Add TopUp</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
    <?php include "menu.php"; ?>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">
  
  <canvas id="bigDashboardChart"></canvas>
  
  
</div> -->