<?php $position = $user['position']; ?>


<aside class="main-sidebar"  style="height:100%">
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
        <li class=""><a href="home"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="header">MANAGE</li>   
              <li><a href="attendance"><i class="fa fa-th-list"></i> <span>Attendance</span></a></li>  
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if($position == 'Admin' ||$position == 'Human Resources' ){?>
            <li><a href="employee"><i class="fa fa-circle-o"></i> Employee List</a></li>    
            <li><a href="schedule"><i class="fa fa-circle-o"></i> Schedules</a></li>
            <li><a href="leave"><i class="fa fa-circle-o"></i> Manage Employees Leave</a></li>
            
            <?php }?>

            <?php if($position == 'Admin' ||$position == 'Accountant' ){?>
            <li><a href="bonus"><i class="fa fa-circle-o"></i> Bonus</a></li>
            <?php }?>
          </ul>
        </li>
        <!--  -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-clock-o"></i>
            <span>Schedules</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if($position == 'Admin' ||$position == 'Human Resources' ){?>
            
            <li><a href="schedule_employees"><i class="fa fa-circle-o"></i> Schedules</a></li>
            <li><a href="leave"><i class="fa fa-circle-o"></i> Manage Employee Schedules</a></li>
            <li><a href="schedule_employee"><i class="fa fa-clock-o"></i> <span> Print Schedule</span></a></li>
            <?php }?>

            
          </ul>
        </li>
        <!--  -->
        <?php 
            if($position == 'Admin' ||$position == 'Accountant' ){
              ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Deductions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="benefits"><i class="fa fa-circle-o"></i> Benefit Records</a></li>
            <li><a href="sss"><i class="fa fa-circle-o"></i> SSS</a></li>
            <li><a href="pagibig"><i class="fa fa-circle-o"></i> PAG-IBIG</a></li>
            <li><a href="philhealth"><i class="fa fa-circle-o"></i> PHILHEALTH</a></li> 
            <li><a href="loan"><i class="fa fa-circle-o"></i> Loan</a></li>
            <li><a href="cashadvance"><i class="fa fa-circle-o"></i> Cash Advance</a></li>

          </ul>
        </li>

        <?php }?>
        <!--  -->
        
        <!--  -->
        
        <?php if($position == 'Admin' ||$position == 'Human Resources' ){?>
        <li><a href="position"><i class="fa fa-building"></i> <span>Positions</span></a></li>
        <?php } if($position == 'Admin' ){?>
        <li><a href="user"><i class="fa fa-user"></i> <span>User</span></a></li>
        <?php }?>
        <?php if($position == 'Admin' ||$position == 'Human Resources' ){?>
        <li><a href="audit"><i class="fa fa-history"></i> <span>Audit Trail Record</span></a></li>
        <?php }?>
        <li class="header">PRINTABLES</li>
        <?php if($position == 'Admin' ||$position == 'Accountant' ){?>
        <li><a href="payroll"><i class="fa fa-columns"></i> <span>Payroll</span></a></li>
        <?php } if($position == 'Admin' ||$position == 'Human Resources' ){?>
        
        <li><a href="dtr"><i class="fa fa-calendar"></i><span>Date and Time Record</span></a></li>
       
        <?php }?>
        <!-- <li class="header">
        <div class="hidden-xs">
          <b>All rights reserved</b>
        </div></li>
        <li class="header">
        <strong>Copyright &copy; 2023 <a href="">JJACA</a></strong>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>