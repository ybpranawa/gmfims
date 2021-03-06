<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../images/gmflogo.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['username'];?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php
          if ($_SESSION['role']>'4'&&$_SESSION['role']<='8') {
          ?>
            <li><a href="dashboardwelcome.php"><i class="fa fa-dashboard"></i> <span>Main Dashboard</span></a></li>
          <?php
          }
          if ($_SESSION['role']=='1') {
          ?>
            <li><a href="dashboardadmin.php"><i class="fa fa-dashboard"></i> <span>Dashboard Admin</span></a></li>
          <?php
          }
          if ($_SESSION['role']=='2'||$_SESSION['role']=='5'||$_SESSION['role']=='6'||$_SESSION['role']=='7') {
          ?>
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard Requester</span></a></li>
          <?php
          }
          if ($_SESSION['role']=='3'||$_SESSION['role']=='5'||$_SESSION['role']=='7'||$_SESSION['role']=='8') {
          ?>
            <li><a href="dashboardcp.php"><i class="fa fa-dashboard"></i> <span>Dashboard Central Planner</span></a></li>
          <?php
          }
          if ($_SESSION['role']=='4'||$_SESSION['role']=='6'||$_SESSION['role']=='7'||$_SESSION['role']=='8') {
          ?>
            <li><a href="dashboardprovider.php"><i class="fa fa-dashboard"></i> <span>Dashboard Provider</span></a></li>
          
          <?php
          }
          ?>
        </ul>
      </li>
      
      <?php
      if ($_SESSION['role']=='1') {
      ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-pencil"></i>
          <span>Insert Data</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="addstation.php"><i class="fa fa-circle-o"></i> Add Station</a></li>
          <li><a href="addqualification.php"><i class="fa fa-circle-o"></i> Add Qualification</a></li>
          <li><a href="addaircraft.php"><i class="fa fa-circle-o"></i> Add Aircraft</a></li>
          <li><a href="addmanpower.php"><i class="fa fa-circle-o"></i> Add Data Manpower</a></li>
          <li><a href="addunit.php"><i class="fa fa-circle-o"></i> Add Unit</a></li>
          <li><a href="addrole.php"><i class="fa fa-circle-o"></i> Add Role</a></li>
          <li><a href="adduser.php"><i class="fa fa-circle-o"></i> Add User Account</a></li>
          <li><a href="addcustomer.php"><i class="fa fa-circle-o"></i> Add Customer</a></li>
          <li><a href="addrating.php"><i class="fa fa-circle-o"></i> Add Rating</a></li>
          <li><a href="addmanager.php"><i class="fa fa-circle-o"></i> Add Manager</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-edit"></i>
          <span>Edit Data</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="editstation.php"><i class="fa fa-circle-o"></i> Edit Station</a></li>
          <li><a href="editqualification.php"><i class="fa fa-circle-o"></i> Edit Qualification</a></li>
          <li><a href="editaircraft.php"><i class="fa fa-circle-o"></i> Edit Aircraft</a></li>
          <li><a href="editmanpower.php"><i class="fa fa-circle-o"></i> Edit Data Manpower</a></li>
          <li><a href="editunit.php"><i class="fa fa-circle-o"></i> Edit Unit</a></li>
          <li><a href="editrole.php"><i class="fa fa-circle-o"></i> Edit Role</a></li>
          <li><a href="edituser.php"><i class="fa fa-circle-o"></i> Edit User Account</a></li>
          <li><a href="editcustomer.php"><i class="fa fa-circle-o"></i> Edit Customer</a></li>
          <li><a href="editrating.php"><i class="fa fa-circle-o"></i> Edit Rating</a></li>
          <li><a href="editmanager.php"><i class="fa fa-circle-o"></i> Edit Manager</a></li>
        </ul>
      </li>
      <?php
      }
      if ($_SESSION['role']=='2'||$_SESSION['role']=='5'||$_SESSION['role']=='6'||$_SESSION['role']=='7') {
      ?>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-plus"></i>
          <span>Request</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="addrequest.php"><i class="fa fa-circle-o"></i> Make Request</a></li>
          <li><a href="editrequest.php"><i class="fa fa-circle-o"></i> Edit Requests</a></li>
          <li><a href="historyrequester.php"><i class="fa fa-circle-o"></i> History</a></li>
        </ul>
      </li>
      <?php
      }
      if ($_SESSION['role']=='3'||$_SESSION['role']=='5'||$_SESSION['role']=='7'||$_SESSION['role']=='8') {
      ?>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-hand-o-up"></i>
          <span>Assign</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="viewrequest.php"><i class="fa fa-circle-o"></i> View Requests</a></li>
          <li><a href="editsignrequest.php"><i class="fa fa-circle-o"></i> Edit Signed Requests</a></li>
          <li><a href="searchunit.php"><i class="fa fa-circle-o"></i> Search Unit</a></li>
          <li><a href="historycp.php"><i class="fa fa-circle-o"></i> History</a></li>
        </ul>
      </li>
      <?php
      }
      if ($_SESSION['role']=='4'||$_SESSION['role']=='6'||$_SESSION['role']=='7'||$_SESSION['role']=='8') {
      ?>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-truck"></i>
          <span>Provide</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="viewassrequest.php"><i class="fa fa-circle-o"></i> View Assigned Request</a></li>
          <li><a href="editassmanpower.php"><i class="fa fa-circle-o"></i> Edit Manpower Assignment</a></li>
          <li><a href="historyprovider.php"><i class="fa fa-circle-o"></i> History</a></li>
        </ul>
      </li>
      <?php
      }
      ?>
      
      <li class="header">Documentation</li>
      <li><a href="#"><i class="fa fa-book"></i> <span>How to Use IMS</span></a></li>
      <li><a href="specification.php"><i class="fa fa-book"></i> <span>App Specification</span></a></li>
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>