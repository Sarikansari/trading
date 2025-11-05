<?php
ob_start();
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
if($_SESSION['userid']=="")
{
    header("location:index.php?msg1=notauthorized");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Adminsuit | Manage Transactions</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
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
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <link href="css/custom.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/app.css" id="maincss">

</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
    <?php include ("include/connection.php");?>
    <?php include ("include/header.inc.php");?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include ("include/navigation.inc.php");?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Transactions</h1>
            <ol class="breadcrumb">
                <li><a href="desktop.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Transactions</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">


                    <div class="box">
                       
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="formID" name="formID" method="post" action="#" enctype="multipart/form-data">
                                <!--<div class="table-responsive"> -->
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>

                                        <th width="10%" >ID</th>
                                        <th width="10%" >User</th>
                                        <th width="15%" >Order ID</th>
                                        <th width="15%" >UTR ID</th>
                                        <th width="10%" >Amount</th>
                                        <th width="15%" >Date</th>
                                        <th width="15%" >Status</th>
                                        <th width="10%" >Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $Query=mysqli_query($con,"select * from `tbl_walletsummery` where `actiontype`='recharge' ORDER BY id DESC ");
                                    $i=0;
                                    while($row=mysqli_fetch_array($Query)){$i++;?>


                                        <tr>

                                            <td><?php echo @$row["id"]; ?></td>
                                                <?php 
                                                    // echo userdetail($con,$row["userid"]);
                                                if(userdetail($con,$row["userid"])){ ?>
                                                <td data-toggle="modal" data-target="#userdetail<?php echo @$row["userid"]; ?>" class="btn btn-info">
                                                   <?php echo userdetail($con,$row["userid"])['mobile']; ?>
                                                </td>
                                              <?php  }else{ ?>
                                                <td data-toggle="modal" data-target="#userdetail<?php echo @$row["userid"]; ?>" class="btn btn-danger">
                                                   <?php echo 'No User found!!'; ?>
                                                </td>
                                               <?php }
                                                ?>
                                            <td><?php echo @$row["orderid"]; ?></td>
                                            <td><?php echo @$row["utr_no"]; ?></td>

                                            <td><?php echo number_format($row["amount"], 2) ?></td>
                                            <td><?php echo @$row["createdate"]; ?></td>
                                            <td style="text-align:center;">
														<?php if($row['status']==0){?>
                                                            <span class="btn btn-warning disabled">PENDING</span>
                                                        <?php }else if($row['status']==1){ ?>
                                                            <span class="btn btn-success disabled">SUCCESS</span>
                                                        <?php }else{ ?>
                                                            <span class="btn btn-danger disabled">FAIL</span>
                                                        <?php }?>
                                                        </td>
                                            <td align="center">
                                            <a href="recharge_details.php?ID=<?php echo @$row["id"]; ?>" class="btn btn-info"><i class="fa fa-info" ></i></a>
                                                            
                                            </td>
                                        </tr>
                                        <!-- Modal -->
<div class="modal fade" id="userdetail<?php echo @$row["userid"]; ?>" tabindex="-1" role="dialog" aria-labelledby="userdetailLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <?php if(userdetail($con,$row["userid"])){ ?>
        <p>User Id: <?php echo userdetail($con,$row["userid"])['id']; ?></p>
        <p>User Mobile: +91 <?php echo userdetail($con,$row["userid"])['mobile']; ?></p>
        <p>User Email: <?php echo userdetail($con,$row["userid"])['email']; ?></p>
        <p>User Referral code: <?php echo userdetail($con,$row["userid"])['owncode']; ?></p>
        <?php }else{ ?>
        <p class="text-danger">No data found for this user, Something wents wrong!!</p>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-------Model end-------->
                                    <?php }?>


                                    </tbody>

                                </table>
                                <!--</div>-->
                                <div class="box-header box-header2" style="margin-bottom: 10px;">&nbsp; </div>
                                <div class="row">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2">
                                        &nbsp;
                                    </div>
                                </div>
                            </form>
                        </div>
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
    
    <?php include("include/footer.inc.php");?></div>
<!-- ./wrapper -->


<script>

    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true
        });
    });
</script>

</body>
</html>
