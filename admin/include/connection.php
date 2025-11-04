<?php
$con = @mysqli_connect('localhost', 'threecol_root', 'qObsxA3)&*Bf', 'threecol_color');
if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}
?>
<?php
function websetting($con){
    $sql = mysqli_query($con,"SELECT * FROM tbl_website LIMIT 1");
    return mysqli_fetch_assoc($sql);
}
 function newname() {

    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double) microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 5) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;
}
 function generateSKU() {
  $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
            for ($i = 0; $i < 4; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        return $pin=$randomString;
}

function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

//chk permission page==================================
function chpermission($a,$actionurl){
$session_roles=$_SESSION['role_id'];
$urll =$actionurl ;
$chkurls=mysqli_query($a,"select `c_id` from `secondchild_menu` where `url`='".$urll."' and `status`='1'");
$chkurls_result=mysqli_fetch_array($chkurls);
$chk= $chkurls_result['c_id'];
$valurls=mysqli_query($a,"SELECT * FROM `task` where `role_id`='".$session_roles."' And task  like '%$chk%' and `status`='1'");
$vals_row=mysqli_num_rows($valurls);
if($vals_row=='0'){
header("location:404.php");
} 
}//chk permission page end==================================

function subcategory($b,$id) {
$sql_page=mysqli_query($b,"select `subcategory` from `tbl_subcategory` where `id`='$id'");
$page_result=mysqli_fetch_array($sql_page);	
return  $page_result['subcategory'];
}
function gameid($a)
{
$selectruser=mysqli_query($a,"select `gameid` from `tbl_gameid` order by id desc limit 1");
$userresult=mysqli_fetch_array($selectruser);
return $userresult["gameid"];
	}


function wallet($a,$field,$id)
{
	$selectwallet=mysqli_query($a,"select `$field` from `tbl_wallet` where `userid`='".$id."'");
$walletResult=mysqli_fetch_array($selectwallet);
return $walletResult["$field"];
	}
function winner($con,$periodid,$tab,$column)
{
$query=mysqli_query($con,"SELECT 
    SUM(CASE
        WHEN type = 'button' THEN amount
    END) button,
    SUM(CASE
        WHEN value = 'Green' THEN amount
    END) as green,
    
    (SUM(CASE
        WHEN value = 'Green' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Green' THEN amount
    END)/100*2))*2 as greenwinamount,
	
	(SUM(CASE
        WHEN value = 'Green' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Green' THEN amount
    END)/100*2))*1.5 as greenwinamountwithviolet,
    
    SUM(CASE
        WHEN value = 'Violet' THEN amount
    END) violet,
    
    (SUM(CASE
        WHEN value = 'Violet' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Violet' THEN amount
    END)/100*2))*4.5 as violetwinamount,
    
    SUM(CASE
        WHEN value = 'Red' THEN amount
    END) red,
    
    (SUM(CASE
        WHEN value = 'Red' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Red' THEN amount
    END)/100*2))*2 as redwinamount,
	(SUM(CASE
        WHEN value = 'Red' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Red' THEN amount
    END)/100*2))*1.5 as redwinamountwithviolet,
    
    SUM(CASE
        WHEN type = 'number' THEN amount
    END) number,
    SUM(CASE
        WHEN value = '0' THEN amount
    END) `zero`,
    (SUM(CASE
        WHEN value = '0' THEN amount
    END)-(SUM(CASE
        WHEN value = '0' THEN amount
    END)/100*2))*9 as zerowinamount,
    
    SUM(CASE
        WHEN value = '1' THEN amount
    END) `one`,
    (SUM(CASE
        WHEN value = '1' THEN amount
    END)-(SUM(CASE
        WHEN value = '1' THEN amount
    END)/100*2))*9 as onewinamount,
    
    SUM(CASE
        WHEN value = '2' THEN amount
    END) `two`,
    (SUM(CASE
        WHEN value = '2' THEN amount
    END)-(SUM(CASE
        WHEN value = '2' THEN amount
    END)/100*2))*9 as twowinamount,
    
    SUM(CASE
        WHEN value = '3' THEN amount
    END) `three`,
    (SUM(CASE
        WHEN value = '3' THEN amount
    END)-(SUM(CASE
        WHEN value = '3' THEN amount
    END)/100*2))*9 as threewinamount,
    
    SUM(CASE
        WHEN value = '4' THEN amount
    END) `four`,
    (SUM(CASE
        WHEN value = '4' THEN amount
    END)-(SUM(CASE
        WHEN value = '4' THEN amount
    END)/100*2))*9 as fourwinamount,
    
    SUM(CASE
        WHEN value = '5' THEN amount
    END) `five`,
    (SUM(CASE
        WHEN value = '5' THEN amount
    END)-(SUM(CASE
        WHEN value = '5' THEN amount
    END)/100*2))*9 as fivewinamount,
    
    SUM(CASE
        WHEN value = '6' THEN amount
    END) `six`,
    (SUM(CASE
        WHEN value = '6' THEN amount
    END)-(SUM(CASE
        WHEN value = '6' THEN amount
    END)/100*2))*9 as sixwinamount,
    
    SUM(CASE
        WHEN value = '7' THEN amount
    END) `seven`,
    (SUM(CASE
        WHEN value = '7' THEN amount
    END)-(SUM(CASE
        WHEN value = '7' THEN amount
    END)/100*2))*9 as sevenwinamount,
    
    SUM(CASE
        WHEN value = '8' THEN amount
    END) `eight`,
    (SUM(CASE
        WHEN value = '8' THEN amount
    END)-(SUM(CASE
        WHEN value = '8' THEN amount
    END)/100*2))*9 as eightwinamount,
    
    SUM(CASE
        WHEN value = '9' THEN amount
    END) `nine`,
    (SUM(CASE
        WHEN value = '9' THEN amount
    END)-(SUM(CASE
        WHEN value = '9' THEN amount
    END)/100*2))*9 as ninewinamount
	    
FROM
    `tbl_betting` where `periodid`='$periodid' and `tab`='$tab'");
$result=mysqli_fetch_array($query);	
return $result["$column"];
	
	}
$numbermappings = array("zero", "one","two","three", "four","five","six","seven","eight","nine");


function getusercount($a,$periodid,$tab,$value)
{
$selectquery=mysqli_query($a,"select * from `tbl_betting` where `periodid`='$periodid' and `tab`='$tab' and `value`in($value) group by `userid`
");
$row=mysqli_num_rows($selectquery);
return $row;
	}

function get_times($a) {

$default = '00:00';
$interval = '+30 minutes';

    $output = '';
    $current = strtotime( '00:00' );
    $end = strtotime( '23:59' );

    while( $current <= $end ) {
        $time = date( 'H:i', $current );
      if ($a==$time) {$sel="selected='selected'";} else{$sel="";} 
		
        $output .= "<option value=\"{$time}\"{$sel}\">" . date( 'H:i', $current ) .'</option>';
        $current = strtotime( $interval, $current );
    }

    return $output;
}
$days = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    7 => 'Sunday'
);
date_default_timezone_set('Asia/Kolkata'); 
function isfirstTransaction($con,$id){
    $sql = mysqli_query($con,"SELECT * FROM `tbl_walletsummery` WHERE userid='$id' && type='credit' && actiontype='recharge' && status=1 ORDER BY `id` DESC");
    $count = mysqli_num_rows($sql);
    if($count>0){
        return false;
    }
    return true;
}

function find_parent_user($con,$second_user){
    $sql = "select * from `tbl_user` where `id`='$second_user'";
    $chkrcode=mysqli_query($con,$sql);
    $chkrcodes = mysqli_fetch_assoc($chkrcode);
    $referalid = $chkrcodes['code'];
    $chkrcode2=mysqli_query($con,"select * from `tbl_user` where `owncode`='".$referalid."'")->fetch_assoc();
    return $chkrcode2['id'];
}

     function addrechargebonus($con,$id,$amountrecharger){
	 $r_amount12 = 0;
	 if($amountrecharger == 500){
	 $r_amount12 = 150;
	 }elseif($amountrecharger == 1000){
	 $r_amount12 = 200;
	 }elseif($amountrecharger == 3000){
	 $r_amount12 = 400;
	 }elseif($amountrecharger == 4000){
	 $r_amount12 = 500;
	 }elseif($amountrecharger == 5000){
	 $r_amount12 = 600;
	 }elseif($amountrecharger == 10000){
	 $r_amount12 = 1100;
	 }elseif($amountrecharger == 50000){
	 $r_amount12 = 2300;
	 }elseif($amountrecharger == 100000){
	 $r_amount12 = 5500;
	 }
	 
	 $r_id = find_parent_user($con,$id);
	 $walletAvailablebalance12=wallet($con,'amount',$r_id);
     $finalbalanceCredit12=$walletAvailablebalance12+$r_amount12;
     $sqlwallet= mysqli_query($con,"UPDATE `tbl_wallet` SET `amount` = '$finalbalanceCredit12' WHERE `userid`= '$r_id'");
     $insor = "INSERT INTO tbl_order  (`userid`, `transactionid`, `amount`, `status`) VALUES ('$r_id','bonus','$r_amount12',1)";
     $insert_order = mysqli_query($con,$insor);
     $insert_walletsummary = mysqli_query($con,"INSERT INTO `tbl_walletsummery` (`userid`, `orderid`, `utr_no`, `amount`, `type`, `actiontype`, `amount_1`, `value`, `status`, `phone`) VALUES ('$r_id', NULL, NULL, '$r_amount12', 'credit', 'first', NULL, '$id', '1', NULL)");
     if($sqlwallet && $insert_order && $insert_walletsummary){
         return 1;
     }
     return 0;
}
function userdetail($con,$id){
    $res = false;
    $query = "SELECT * FROM `tbl_user` WHERE `id`='$id'";
    $qq = mysqli_query($con,$query);
    if(mysqli_num_rows($qq) > 0){
    $res = mysqli_fetch_assoc($qq);
    }
    return $res;
}
?>