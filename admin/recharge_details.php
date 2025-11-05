<?php 
ob_start();
session_start();

if($_SESSION['userid']=="")
{
	header("location:index.php?msg1=notauthorized");
	exit();
}
	
include ("include/connection.php");

if(isset($_POST['submit'])=='Submit'){
    
	$utr_no=($_POST['utr_no']);
	$amount=($_POST['amount']);
	$status=($_POST['status']);
	$orderid=($_POST['orderid']);
	$id=($_POST['id']);
	if($status==1){
	//////////////
	 $sql1="SELECT userid FROM tbl_walletsummery WHERE id='$id'";
	 $select=mysqli_query($con,$sql1)or die(mysqli_error($con));
	 $row = $select->fetch_assoc();
	 $userid=$row['userid'];
 	 if(isfirstTransaction($con,$userid)){
	    addrechargebonus($con,$userid,$amount);
 	 }
$walletAvailablebalance=wallet($con,'amount',$userid);	
$finalbalanceCredit=$walletAvailablebalance+$amount;
$sqlwallet= mysqli_query($con,"UPDATE `tbl_wallet` SET `amount` = '$finalbalanceCredit' WHERE `userid`= '$userid'");
// 	//
}
///////////
$utr = str_replace(' ', '', websetting($con)['title']).date("Ymdhis");
$sql = "UPDATE tbl_walletsummery SET utr_no='$utr_no',amount='$amount',value='$utr',status='$status',orderid='$orderid' WHERE id='$id'";
// echo $sql;
//print_r($sql);exit;	
$query=mysqli_query($con,$sql);
if($query){
	
	 echo "<script>
alert('Upadte sucessfully');
window.location.href='recharge_history.php';
</script>";
	
	}

	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Adminsuit | Amount Setup</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="plugins/iCheck/all.css">
<link rel="stylesheet" type="text/css" href="css/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
<?php include ("include/header.inc.php");?>
 <?php include ("include/navigation.inc.php");
 $id=$_GET['ID'];
 $sql="select* FROM `tbl_walletsummery` WHERE id='$id'";
$query=mysqli_query($con,$sql);
$role=mysqli_fetch_array($query);
//print_r($role);exit;
 ?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Amount Setup</h1>
      <ol class="breadcrumb">
        <li><a href="desktop.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Amount Setup</li>
      </ol>
    </section>

                        
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-xs-12 text-center">
          
          <?php if(isset($_GET['msg'])=="updt"){ ?>
              <span class="text-center red_txt">Update Successfully......</span><?php  } ?></div>
        <div class="col-xs-12">
          <div class="box">
          
      <form id="formID" name="formID" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $role['id'];?>">
            <div class="box-body">
<div class="clearfix"></div>

<div class="col-sm-6">
              <div class="form-group">
              <label>Transaction Id</label>
              <input type="text" class="form-control"  name="utr_no" id="mra" required value="<?php echo $role['utr_no'];?>" readonly>
              </div>
              </div>
  <div class="col-sm-6">
              <div class="form-group">
              <label>AMOUNT</label>
              <input type="text" class="form-control" name="amount" id="mwa" required value="<?php echo $role['amount_1'];?>">
              </div>
              </div>          
 <div class="col-sm-6">
              <div class="form-group">
              <label>STATUS</label>
              <select class="form-control"  name="status">
                  <option value="0"<?php if($role['status'] == 0) { ?> selected="selected"<?php } ?>>Pending</option>
                  <option value="1"<?php if($role['status'] == 1) { ?> selected="selected"<?php } ?>>Success</option>
                  <option value="2"<?php if($role['status'] == 2) { ?> selected="selected"<?php } ?>>Fail</option>
              </select>
             <!-- <input type="text" class="form-control"  name="status" id="ib" required value="<?php echo $role['status'];?>">-->
              </div>
              </div>
<div class="col-sm-6">
              <div class="form-group">
              <label>ORDER ID</label>
              <input type="text" class="form-control"  name="orderid" id="ib" required value="<?php echo $role['orderid'];?>"  readonly>
              </div>
              </div>
             <div class="clearfix"></div>   
              <div class="form-group">
              <div class="text-center">
  
 <input type="submit" class="btn btn-primary" value="Submit"  name="submit"<?php if($role['status'] == 1) { ?> disabled <?php } ?>></div>
                </div> 
               </div>
                <div class="clearfix"></div>
             
 

          </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include("include/footer.inc.php"); ?>
</div>

</body>
</html>
