<style>
.sidebar[data-color="white"]:after,
.off-canvas-sidebar[data-color="white"]:after {

    background-color: #08141b;
    /*opacity: 0.9;*/
}

.sidebar[data-color="white"] .nav li a i {
    opacity: .7;
    color: white;
}

.sidebar[data-color="white"] .nav li a i p,
.sidebar[data-color="white"] .nav li a p {
    color: white;
    font-weight: bold;
}

.navbar.navbar-transparent a:not(.dropdown-item):not(.btn) {
    color: #f9f9f9;
}

.navbar.navbar-transparent .nav-item .nav-link:not(.btn) {
    color: #ffffff;
}
</style>
<div class="wrapper">

    <div class="sidebar" data-color="white" data-active-color="danger">

        <div class="logo">
            <!-- <a href="/" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
        </a>-->
            <a href="/" class="simple-text logo-normal" style="font-weight: Bold;">
                <div class="logo-image-big">
                    <img src="/assets/logo2.png" style="width: 60px;margin-left: 36%;">
                </div>
            </a>
        </div>

        <div class="sidebar-wrapper">

            <ul class="nav">
                <li class="<?php if ($page == "home") {echo "active";}?>">
                    <a href="/Dashboard">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php
$email = $_SESSION['userid'];
if ($email != 1 && $email != 2) {
    ?>
                <li class="<?php if ($page == "user") {echo "active";}?>">
                    <a href="/UserInfo">
                        <i class="nc-icon nc-single-02"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <?php }?>
                <li class="<?php if ($page == "inviteuser") {echo "active";}?>">
                    <a href="/InviteUser">
                        <i class="nc-icon nc-send"></i>
                        <p>Invite User</p>
                    </a>
                </li>
                <?php
if ($plan != 1) {
    $email = $_SESSION['userid'];
    if ($email != 1 && $email != 2) {
        ?>
                <li class="<?php if ($page == "payoutplan") {echo "active";}?>">
                    <a href="./GenerationSch">
                        <i class="nc-icon nc-calendar-60"></i>
                        <p>Generation Schedule</p>
                    </a>
                </li>
                <?php }}?>
                <?php
$email = $_SESSION['userid'];

if ($email != 1 && $email != 2) {
    ?>
                <li class="<?php if ($page == "support") {
        echo "active";
    }?>">
                    <a href="./Support">
                        <i class="nc-icon nc-chat-33"></i>
                        <p>Support</p>
                    </a>
                </li>
                <?php
}
$email = $_SESSION['userid'];

if ($email == 1 || $email == 2) {?>
                <li class="<?php if ($page == "adminuserlist") {echo "active";}?>">
                    <a href="./AdminUserList">
                        <i class="nc-icon nc-bullet-list-67"></i>
                        <p>All User List</p>
                    </a>
                </li>

                <li class="<?php if ($page == "admintopuplist") {echo "active";}?>">
                    <a href="./AdminTopUpList">
                        <i class="nc-icon nc-bullet-list-67"></i>
                        <p>User TopUp List</p>
                    </a>
                </li>

                <li class="<?php if ($page == "adminuseraclist") {echo "active";}?>">
                    <a href="./AdminUserAccountApp">
                        <i class="nc-icon nc-glasses-2"></i>
                        <p>Approve Document</p>
                    </a>
                </li>
                <li class="<?php if ($page == "adminsupport") {echo "active";}?>">
                    <a href="./AdminSupport">
                        <i class="nc-icon nc-chat-33"></i>
                        <p>Admin Support</p>
                    </a>
                </li>

                <li class="<?php if ($page == "admingeneration") {echo "active";}?>">
                    <a href="./Generation">
                        <i class="nc-icon nc-calendar-60"></i>
                        <p>Generation Schedule</p>
                    </a>
                </li>

                <?php }?>

                <li class="<?php if ($page == "TradeBuddies") {echo "active";}?>">
                    <a href="./TradeBuddies">
                        <i class="nc-icon nc-vector"></i>
                        <p>Trade Buddies</p>
                    </a>
                </li>

                <li class="<?php if ($page == "TopUp") {echo "active";}?>">
                    <a href="./TopUp">
                        <i class="nc-icon nc-vector"></i>
                        <p>Top Up</p>
                    </a>
                </li>

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
                <!--<li class="active-pro">
            <a href="./upgrade.html">
              <i class="nc-icon nc-spaceship"></i>
              <p>Add TopUp</p>
            </a>
          </li> -->
            </ul>
        </div>
    </div>
    <div class="main-panel"
        style="background: url(/login_files/background-2.jpg) no-repeat; background-position: center;background-repeat: no-repeat;background-size: cover;">
        <?php include "menu.php";?>
        <!-- End Navbar -->
        <!-- <div class="panel-header panel-header-lg">

  <canvas id="bigDashboardChart"></canvas>


</div> -->