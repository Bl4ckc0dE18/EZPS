<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li class=""><a href="home.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="header">MANAGE</li>
        
        <!-- <li><a href="attendance.php"><i class="fa fa-th-list"></i> <span>Attendance</span></a></li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Employees</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="employee.php"><i class="fa fa-circle-o"></i> Employee List</a></li>
            <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Overtime</a></li>
            <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Schedules</a></li>
          </ul>
        </li> -->
        <!--  -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Deductions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="deduction.php"><i class="fa fa-circle-o"></i> Benefits</a></li>
            <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> Cash Advance</a></li>
          </ul>
        </li> -->
        <!--  -->
        
        <!--  -->
        <li><a href="attendance.php"><i class="fa fa-th-list"></i> <span>Attendance</span></a></li>
        <li><a href="salary.php"><i class="fa fa-file-text-o"></i> <span>Salary</span></a></li>
        <li><a href="bonus.php"><i class="fa fa-file-text-o"></i> <span>Bonus</span></a></li>
        <li><a href="benefits.php"><i class="fa fa-file-o"></i> <span>Deductions</span></a></li>
        <li><a href="loan.php"><i class="fa fa-file-o"></i> <span>Loans</span></a></li>
        <li><a href="leave.php"><i class="fa ion-log-out"></i> <span>Leave</span></a></li>
        
        <!--  -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>