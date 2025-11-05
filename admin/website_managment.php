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
    //print_r($_FILES["qr_code"]["name"]);exit;
	$title=($_POST['title']);
	$website_link=($_POST['website_link']);
	$mail=($_POST['mail']);
	$upi=($_POST['upi']);
	$acc_no=($_POST['acc_no']);
	$ifsc_code=($_POST['ifsc_code']);
	$bank_name=($_POST['bank_name']);
	$name=($_POST['name']);
	$notification=($_POST['notification']);

	$uploads_dir = 'banner/';
    $pname = $uploads_dir.rand(1000,10000)."-".$_FILES["qr_code"]["name"];
     $tname = $_FILES["qr_code"]["tmp_name"];
    move_uploaded_file($tname, $pname);
   if(!empty($_FILES["qr_code"]["name"]) )
   {
       //print_r(123);exit;
   $sql= "UPDATE `tbl_website` SET `title` = '$title',`website_link` = '$website_link',`mail` = '$mail',`upi` = '$upi',`acc_no` = '$acc_no',`ifsc_code` = '$ifsc_code',`bank_name` = '$bank_name',`name` = '$name',`notification`='$notification',`qr_code`='$pname' WHERE `id`= '1'";
    
   }else{
        // print_r(321);exit;
  $sql= "UPDATE `tbl_website` SET `title` = '$title',`website_link` = '$website_link',`mail` = '$mail',`upi` = '$upi',`acc_no` = '$acc_no',`ifsc_code` = '$ifsc_code',`bank_name` = '$bank_name',`name` = '$name',`notification`='$notification' WHERE `id`= '1'";
   }
$query=mysqli_query($con,$sql);
if($query){
	
	header("location:website_managment.php?msg=updt");
	
	}

	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Goldenbigmart | Amount Setup</title>
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
 $sql="select* FROM `tbl_website` WHERE id='1'";
$query=mysqli_query($con,$sql);
$role=mysqli_fetch_array($query);

 ?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Website Managment</h1>
      <ol class="breadcrumb">
        <li><a href="desktop.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Website Managment</li>
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
            <div class="box-body">
<div class="clearfix"></div>

<div class="col-sm-6">
              <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control"  name="title" id="title"  value="<?php echo $role['title'];?>">
              </div>
              </div>
  <div class="col-sm-6">
              <div class="form-group">
              <label>Website Link (https://domainame)</label>
              <input type="text" class="form-control"  name="website_link" id="website_link"  value="<?php echo $role['website_link'];?>">
              </div>
              </div>          
 <div class="col-sm-6">
              <div class="form-group">
              <label>Mail ID</label>
              <input type="email" class="form-control"  name="mail" id="mail"  value="<?php echo $role['mail'];?>">
              </div>
              </div>
<div class="col-sm-6">
              <div class="form-group">
              <label>Upi ID</label>
              <input type="text" class="form-control"  name="upi" id="upi"  value="<?php echo $role['upi'];?>">
              </div>
              </div>
 <div class="col-sm-6">
              <div class="form-group">
              <label>Account No</label>
              <input type="text" class="form-control" name="acc_no" id="acc_no"  value="<?php echo $role['acc_no'];?>">
              </div>
              </div>
<div class="col-sm-6">
              <div class="form-group">
              <label>Ifsc Code</label>
              <input type="text" class="form-control"  name="ifsc_code" id="ifsc_code"  value="<?php echo $role['ifsc_code'];?>">
              </div>
              </div>
              <div class="col-sm-6">
              <div class="form-group">
              <label>Bank Name</label>
              <input type="text" class="form-control"  name="bank_name" id="bank_name"  value="<?php echo $role['bank_name'];?>">
              </div>
              </div>
              <div class="col-sm-6">
              <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control"  name="name" id="name"  value="<?php echo $role['name'];?>">
              </div>
              </div>
              <div class="col-sm-6">
              <div class="form-group">
              <label>Notification</label>
              <input type="text" class="form-control"  name="notification" id="notification"  value="<?php echo $role['notification'];?>">
              </div>
              </div>
               <div class="col-sm-6">
              <div class="form-group">
              <label>QR Code</label>
              <input type="file" class="form-control"  name="qr_code" id="qr_code" >
              <img src="<?php echo $role['qr_code']; ?>" width="150" height="150">
              </div>
              </div>
             <div class="clearfix"></div>   
              <div class="form-group">
              <div class="text-center">
  
 <input type="submit" class="btn btn-primary" value="Submit"  name="submit" ></div>
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
