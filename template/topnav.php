<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
  <span class="sr-only">Toggle navigation</span>
</a>

<div class="col-md-8 text-center" style="color: #FFFFFF;font-size: 24px; padding: 5px; floating:left;">
  Integrated <b>Manpower </b>System
</div>

<div class="navbar-custom-menu" style="floating:left;">
  <ul class="nav navbar-nav">
    <?php
    if (isset($_SESSION['username'])) {
    ?>
    <!-- Notifications: style can be found in dropdown.less -->
    <?php
    $sqlnav="SELECT COUNT(request_id) AS jumreq FROM request WHERE (requester_id='".$_SESSION['username']."' OR centralplanner_id='".$_SESSION['username']."' OR provider_id='".$_SESSION['username']."' OR centralplanner_id='') AND status_request<3 AND status_request>0 ";
    $resultnav=mysqli_query($conn,$sqlnav);
    $rownav=mysqli_fetch_array($resultnav);
    $jumreq=$rownav['jumreq'];
    ?>
    <li class="dropdown notifications-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning"><?php echo $rownav['jumreq'];?></span>
      </a>

      <ul class="dropdown-menu">
        <li class="header">Requests</li>
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
            <?php
            $sqlnav="SELECT request_id FROM request WHERE (requester_id='".$_SESSION['username']."' OR centralplanner_id='".$_SESSION['username']."' OR provider_id='".$_SESSION['username']."' OR centralplanner_id='') AND status_request<3 AND status_request>0 ";
            $resultnav=mysqli_query($conn,$sqlnav);
            
            while ($rownav=mysqli_fetch_array($resultnav)) {
            ?>
              <li>
                <a href="#">
                  <i class="fa fa-plus text-aqua"></i> <?php echo $rownav['request_id'];?>
                </a>
              </li>
            <?php
            }
            ?>
            
          </ul>
        </li>
        <!-- <li class="footer"><a href="#">View all</a></li> -->
      </ul>
    </li>
    <!-- Tasks: style can be found in dropdown.less -->

    <li class="dropdown tasks-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-flag-o"></i>
        <span class="label label-danger"><?php echo $jumreq;?></span>
      </a>
      <ul class="dropdown-menu">
        <li class="header">Status</li>
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
            <?php
            $sqlnav="SELECT status_request, request_id FROM request WHERE (requester_id='".$_SESSION['username']."' OR centralplanner_id='".$_SESSION['username']."' OR provider_id='".$_SESSION['username']."' OR centralplanner_id='') AND status_request<3 AND status_request>0 ";
            $resultnav=mysqli_query($conn,$sqlnav);
            
            while ($rownav=mysqli_fetch_array($resultnav)) {
            ?>
            <li><!-- Task item -->
              <a href="#">
                <h3>
                  <?php echo $rownav['request_id'];
                  if ($rownav['status_request']==1) {
                  ?>
                    <small class="pull-right">30%</small>  
                  <?php
                  }elseif ($rownav['status_request']==2) {
                  ?>
                    <small class="pull-right">60%</small>
                  <?php
                  }
                  ?>
                  
                </h3>
                <?php 
                
                if ($rownav['status_request']==1) {
                ?>
                <div class="progress xs">
                 
                    <div class="progress-bar progress-bar-yellow" style="width: 30%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class="sr-only">30% Complete</span>
                    </div>
                </div>
                <?php
                }elseif ($rownav['status_request']==2) {
                ?>
                <div class="progress xs">
                 
                    <div class="progress-bar progress-bar-aqua" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class="sr-only">60% Complete</span>
                    </div>
                </div>
                <?php
                }
                ?>
              </a>
            </li>
            <!-- end task item -->
            <?php
            }
            ?>
            
          </ul>
        </li>
        <li class="footer">
          <a href="#">View all tasks</a>
        </li>
      </ul>
    </li>
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="../images/gmflogo.jpg" class="user-image" alt="User Image">
        <span class="hidden-xs"><?php echo $_SESSION['username'];?></span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img src="../images/gmflogo.jpg" class="img-circle" alt="User Image">

          <p>
            <?php 
            echo $_SESSION['username'];
            $sqldate="SELECT last_login FROM user_account WHERE user_id='".$_SESSION['username']."'";
            $resultdate=mysqli_query($conn,$sqldate);
            $rowdate=mysqli_fetch_array($resultdate);
            ?>
            <small>last login : <?php echo $rowdate['last_login'];?></small>
          </p>
        </li>
        
        <!-- Menu Footer-->
        <li class="user-footer">
          <?php
          if ($_SESSION['role']!='1') {
          ?>
          <div class="pull-left">
            <a href="editprofile.php" class="btn btn-default btn-flat">Profile</a>
          </div>
          <?php
          }
          ?>
          <div class="pull-right">
            <a href="../controller/logoutmethod.php" class="btn btn-default btn-flat">Sign out</a>
          </div>
        </li>
      </ul>
    </li>
    
    <?php
    }
    else
    {
    ?>
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="../images/gmflogo.jpg" class="user-image" alt="User Image">
        <span class="hidden-xs">VISITOR</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img src="../images/gmflogo.jpg" class="img-circle" alt="User Image">

          <p>
            Welcome VISITOR, <small>Please login to access this system</small>
            <small>Garuda Maintenance Facility Aeroasia</small>
          </p>
        </li>
       
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-right">
            <a href="../internallogin.php" class="btn btn-default btn-flat">Login</a>
          </div>
        </li>
      </ul>
    </li>
   
    <?php
    }
    ?>
  </ul>
</div>