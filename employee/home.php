<?php include 'includes/session.php'; ?>
<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  	<?php include 'includes/navbar.php'; ?>
  	<?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        HOME
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-olive">
              <div class="inner">
                <?php
                  $look="Pending";
                  $employee_id=$user['employee_id'];
                  $sql = "SELECT * FROM leave_record WHERE leave_status like '$look'  AND employee_id like '$employee_id' ";
                  $query = $conn->query($sql);

                  echo "<h3>".$query->num_rows."</h3>";
                ?>

                <p>Leave Request</p>
              </div>
              <div class="icon">
                <i class="ion ion-log-out"></i>
              </div>
              <a href="leave" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <?php
                  $look="Paid";
                  $sql = "SELECT *, SUM(loanbalance) AS salary FROM loan WHERE  employee_id like '$employee_id' ";
                  $query = $conn->query($sql);
      	          $row = $query->fetch_assoc();
                  $totalamount = $row['salary'];
                  
                  echo "<h3>".number_format($row['salary'], 2)."</h3>";
                
                ?>

                <p>Loan Paid</p>
              </div>
              <div class="icon">
                <i class="ion ">₱</i>
              </div>
              <a href="loan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <?php
                  $look="Paid";
                  $sql = "SELECT *, SUM(totaldeduction) AS salary FROM payslip WHERE deduction_status like '$look' AND employee_id like '$employee_id' ";
                  $query = $conn->query($sql);
      	          $row = $query->fetch_assoc();
                  $totalamount = $row['salary'];
                  
                  echo "<h3>".number_format($row['salary'], 2)."</h3>";
                
                ?>

                <p>Deduction Paid</p>
              </div>
              <div class="icon">
                <i class="ion ">₱</i>
              </div>
              <a href="benefits" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Attendance</h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                      <?php
                        for($i=2015; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- Chart Data -->
<?php
  $and = 'AND YEAR(date) = '.$year;
  $months = array();
  $ontime = array();
  $late = array();
  $dayoff = array();
  $leave = array();
  $employee_ids=$user['id'];
  for( $m = 1; $m <= 12; $m++ ) {
    $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 1 $and AND employee_id='$employee_ids'" ;
    $oquery = $conn->query($sql);
    array_push($ontime, $oquery->num_rows);

    $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 0 $and AND employee_id='$employee_ids'" ;
    $lquery = $conn->query($sql);
    array_push($late, $lquery->num_rows);

    $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 4 $and AND employee_id='$employee_ids'" ;
    $lquery = $conn->query($sql);
    array_push($dayoff, $lquery->num_rows);

    $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 3 $and AND employee_id='$employee_ids'" ;
    $lquery = $conn->query($sql);
    array_push($leave, $lquery->num_rows);

    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $late = json_encode($late);
  $ontime = json_encode($ontime);
  $dayoff = json_encode($dayoff);
  $leave = json_encode($leave);

?>
<!-- End Chart Data -->
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Ontime',
        fillColor           : 'rgba(240, 173, 78,1)',
        strokeColor         : 'rgba(240, 173, 78,1)',
        pointColor          : 'rgba(240, 173, 78,1)',
        pointStrokeColor    : 'rgba(240, 173, 78,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(240, 173, 78,1)',
        data                : <?php echo $ontime; ?>
      }
      ,
      {
        label               : 'Late',
        fillColor           : 'rgba(217, 83, 79, 1)',
        strokeColor         : 'rgba(217, 83, 79, 1)',
        pointColor          : 'rgba(217, 83, 79, 1)',
        pointStrokeColor    : 'rgba(217, 83, 79, 1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(217, 83, 79, 1)',
        data                : <?php echo $late; ?>
      }
      
      ,
      
      {
        label               : 'Day Off',
        fillColor           : 'rgba(2, 117, 216,1)',
        strokeColor         : 'rgba(2, 117, 216,1)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(2, 117, 216,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(2, 117, 216,1)',
        data                : <?php echo $dayoff; ?>
      }
      ,
      {
        label               : 'Leave',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : 'rgba(210, 214, 222, 1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(210, 214, 222, 1)',
        data                : <?php echo $leave; ?>
      }
      

    ]
  }
  //barChartData.datasets[1].fillColor   = '#00a65a'
  //barChartData.datasets[1].strokeColor = '#00a65a'
  //barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
</script>
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home?year='+$(this).val();
  });
});
</script>
</body>
</html>
