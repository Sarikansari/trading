<?php 
ob_start();
session_start();
if($_SESSION['userid']=="")
{
	header("location:index.php?msg1=notauthorized");
	exit();
}
	?>
	
<?php include ("include/connection.php");?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo websetting($con)['title']; ?> Admin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
<?php include ("include/header.inc.php");?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php include ("include/navigation.inc.php");
function counter($table){
$rs=mysql_query("select count(*) from `$table`");
$row = mysql_fetch_row($rs);
return $row["0"];
} 
 
 ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="desktop.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!--<div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>1</h3>

              <p>Student</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
          </div>
        </div>-->
        <!-- ./col -->
        
        <!-- ./col -->
      </div>
     
      <!-- /.row (main row) -->
     
<div class="col-lg-3 col-md-6">
         <div class="panel panel-green">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-users fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                   
                     <div>Registered Users</div>
                       <div class="huge">
                     <?php
	$sql = "SELECT * from tbl_user";
	if ($tbl_user = mysqli_query($con, $sql)) {
	$rowcount = mysqli_num_rows( $tbl_user );
	printf(" %d\n", $rowcount);
}
?>
</div>
                  </div>
               </div>
            </div>
            <a href="manage_user.php">
               <div class="panel-footer">
                  <span class="pull-left">See in Detail</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-green">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-credit-card fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                   
                     <div>Total Withdrawal Request</div>
                       <div class="huge">
           <?php
	$sql = "SELECT * from `tbl_withdrawal` where `status`='1'";
	if ($tbl_withdrawal = mysqli_query($con, $sql)) {
	$rowcount = mysqli_num_rows( $tbl_withdrawal );
	printf(" %d\n", $rowcount);
}
?>
</div>
                  </div>
               </div>
            </div>
            <a href="manage_withdraw.php">
               <div class="panel-footer">
                  <span class="pull-left">See in Detail</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-green">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-inr fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                   
                     <div>Total Recharge</div>
                       <div class="huge">
                     <?php
	$sql = "SELECT * from `tbl_walletsummery` where `actiontype`='recharge'";
	if ($tbl_walletsummery = mysqli_query($con, $sql)) {
	$rowcount = mysqli_num_rows( $tbl_walletsummery );
	printf(" %d\n", $rowcount);
}
?>
</div>
                  </div>
               </div>
            </div>
            <a href="recharge_history.php">
               <div class="panel-footer">
                  <span class="pull-left">See in Detail</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-green">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-modx fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                   
                     <div>Website Mode</div>
                       <div class="huge">
           <?php
  
 $chkswitchQuery=mysqli_query($con,"select * from `tbl_gamesettings` where `id`='1'");
 $role=mysqli_fetch_array($chkswitchQuery);
 
?>
<?php if($role['settingtype']=='high'){echo"High Profit";}else{echo"Low Profit";}?>
</div>
                  </div>
               </div>
            </div>
            <a href="manage_gamewinnersetting.php">
               <div class="panel-footer">
                  <span class="pull-left">See in Detail</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-green">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-inr fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                   
                     <div>Total Balance</div>
                       <div class="huge">
                     <?php
	$sql = mysqli_query($con,"select * from tbl_wallet");
	$amount=0;
	while($rowcount = mysqli_fetch_array($sql))
	{
	    $amount=$amount+$rowcount['amount'];
	   
	}
	print_r($amount);

?>
</div>
                  </div>
               </div>
            </div>
            
         </div>
      </div>
      
   
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("include/footer.inc.php");?>
<script src="dist/js/pages/dashboard.js"></script>

</div>
<!-- ./wrapper -->


</body>
</html>
