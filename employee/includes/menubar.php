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
        <li class=""><a href="home"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="header">MANAGE</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th-list"></i>
            <span>Attendance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"> 
            <li><a href="attendance"><i class="fa fa-circle-o"></i> Attendance List</a></li>              
            <li><a href="attendance_overwrite"><i class="fa fa-circle-o"></i> Attendance Overwrite</a></li>          
          </ul>
        </li>
       
        <li><a href="salary"><i class="fa fa-file-text-o"></i> <span>Salary</span></a></li>
        <!-- <li><a href="bonus"><i class="fa fa-file-text-o"></i> <span>Bonus</span></a></li> -->
        <li><a href="benefits"><i class="fa fa-file-o"></i> <span>Deductions</span></a></li>
        <li><a href="loan"><i class="fa fa-file-o"></i> <span>Loans</span></a></li>
        <li><a href="leave"><i class="fa ion-log-out"></i> <span>Leave</span></a></li>
        
        <!--  -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>