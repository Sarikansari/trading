<?php
$con = @mysqli_connect('localhost', 'threecol_root', 'qObsxA3)&*Bf', 'threecol_color');
if (mysqli_connect_errno()) {
    echo "Error: " . mysqli_connect_error();
	exit();
}
date_default_timezone_set("Asia/Calcutta");
$GLOBAL['conn'] = $con;
function websetting($con){
    $sql = mysqli_query($con,"SELECT * FROM tbl_website LIMIT 1");
    return mysqli_fetch_assoc($sql);
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
function refcode() {
  $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        return $pin=$randomString;
}
function generateOTP() {
  $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
            for ($i = 0; $i < 4; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        return $pin=$randomString;
}

function user($a,$field,$id)
{
$selectruser=mysqli_query($a,"select `$field` from `tbl_user` where `id`='".$id."'");
$userresult=mysqli_fetch_array($selectruser);
return $userresult["$field"];
	}
function wallet($a,$field,$id)
{
	$selectwallet=mysqli_query($a,"select `$field` from `tbl_wallet` where `userid`='".$id."'");
$walletResult=mysqli_fetch_array($selectwallet);
return $walletResult["$field"];
	}
function bonus($a,$field,$id)
{
	$selectwallet=mysqli_query($a,"select `$field` from `tbl_bonus` where `userid`='".$id."'");
$walletResult=mysqli_fetch_array($selectwallet);
return $walletResult["$field"];
}
function commission($a,$id)
{
	$selectwallet=mysqli_query($a,"select SUM(`amount`) as intrest from `tbl_walletsummery` where `userid`='".$id."' and `actiontype`='water' and `type`='credit'");
$walletResult=mysqli_fetch_array($selectwallet);
return $walletResult["intrest"];
}
function bonuswallet($a,$id)
{
	$selectwallet=mysqli_query($a,"select SUM(`amount`) as intrest from `tbl_walletsummery` where `userid`='".$id."' and `actiontype`='bonus' and `type`='credit'");
$walletResult=mysqli_fetch_array($selectwallet);
return $walletResult["intrest"];
}
function totalcontribution($a,$id)
{
	$selectwallet=mysqli_query($a,"select SUM(`amount`) as intrest from `tbl_walletsummery` where `userid`='".$id."' and (`actiontype`='commission' or `actiontype`='water' or `actiontype`='bonus' or `actiontype`='first') and `type`='credit'");
$walletResult=mysqli_fetch_array($selectwallet);
return $walletResult["intrest"];
}
function water($a,$id,$cid)
{
	$selectwallet=mysqli_query($a,"select SUM(`amount`) as water from `tbl_walletsummery` where `userid`='".$id."' and `actiontype`='water' and `type`='credit' and `value`=".$cid);
$walletResult=mysqli_fetch_array($selectwallet);
if($walletResult["water"] != ''){
return number_format($walletResult["water"],2);
}else{
    return 0;
}
}
function firstbonus($a,$id,$cid)
{
$selectwallet=mysqli_query($a,"select SUM(`amount`) as first from `tbl_walletsummery` where `userid`='".$id."' and `actiontype`='first' and `type`='credit' and `value`=".$cid);
$walletResult=mysqli_fetch_array($selectwallet);
if($walletResult["first"] != ''){
return number_format($walletResult["first"],2);
}else{
    return 0;
}
}
function intrest($a,$id)
{
	$selectwallet=mysqli_query($a,"select SUM(`amount`) as intrest from `tbl_walletsummery` where `userid`='".$id."' and `actiontype`='intrest' and `type`='credit'");
$walletResult=mysqli_fetch_array($selectwallet);
return $walletResult["intrest"];
}
function gameid($a)
{
$selectruser=mysqli_query($a,"select `gameid` from `tbl_gameid` order by id desc limit 1");
$userresult=mysqli_fetch_array($selectruser);
return $userresult["gameid"];
	}

function content($a,$page) {
	$sql_page="select `$page` from `content` where `id`='1'";
	$query_page=mysqli_query($a,$sql_page);
	$page_result=mysqli_fetch_array($query_page);	
       return  $page_result["$page"];
} 
function minamountsetting($a,$page) {
	$sql_page="select `$page` from `tbl_paymentsetting` where `id`='1'";
	$query_page=mysqli_query($a,$sql_page);
	$page_result=mysqli_fetch_array($query_page);	
       return  $page_result["$page"];
} 
function truncate($mytext) {  
//Number of characters to show  
$chars = 610;  
$mytext = substr($mytext,0,$chars);  
$mytext = substr($mytext,0,strrpos($mytext,' '));  
return $mytext;  
}
function truncate2($mytext) {  
//Number of characters to show  
$chars = 220;  
$mytext = substr($mytext,0,$chars);  
$mytext = substr($mytext,0,strrpos($mytext,' '));  
return $mytext;  
}
function setting($a,$page) {
	$sql_page="select `$page` from `site_setting` where `id`='1'";
	$query_page=mysqli_query($a,$sql_page);
	$page_result=mysqli_fetch_array($query_page);	
       return  $page_result["$page"];
}


function winner($con,$periodid,$tab,$column)
{
$query=mysqli_query($con,"SELECT 
( SUM(amount)-SUM(amount)/100*2)as tradeamountwithtax,
 SUM(amount)as tradeamount,
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

function userpromocode($a,$userid,$code,$tradeamount,$periodid)
{
$today = date("Y-m-d H:i:s");
$commissionQuery=mysqli_query($a,"select * from `tbl_paymentsetting` where `id`='1'");
$commissionResult=mysqli_fetch_array($commissionQuery);
$level1commission=$commissionResult['level1'];
$level2commission=$commissionResult['level2'];
$level3commission=$commissionResult['level3'];
$level1=($tradeamount*$level1commission/100);
$level2=($tradeamount*$level2commission/100);
$level3=($tradeamount*$level3commission/100);

$userlevel1Query=mysqli_query($a,"select `code`,(select `id` from `tbl_user` where `owncode`='$code')level1id,(select `code` from `tbl_user` where `owncode`='$code')level1code from `tbl_user` where `id`='".$userid."'");
$userlevel1Result=mysqli_fetch_array($userlevel1Query);	
 $level1id=$userlevel1Result['level1id'];
 $level1code=$userlevel1Result['level1code'];
//===============================================================================================
$userlevel2Query=mysqli_query($a,"select `id` from `tbl_user` where `owncode`='".$level1code."'");
$userlevel2Result=mysqli_fetch_array($userlevel2Query);	
$level2id=$userlevel2Result['id'];
//=================================================================================================
$sql= mysqli_query($a,"INSERT INTO `tbl_bonussummery`(`userid`,`periodid`,`level1id`,`level2id`,`level1amount`,`level2amount`,`tradeamount`,`createdate`) VALUES ('".$userid."','".$periodid."','".$level1id."','".$level2id."','".$level1."','".$level2."','".$tradeamount."','".$today."')");
$level1balance=bonus($a,'level1',$level1id);
$finallevel1balance=$level1balance+$level1;
$bonusbalance1=bonus($a,'amount',$level1id);
$finalbonusbalance1=$bonusbalance1+$level1;


$level2balance=bonus($a,'level2',$level2id);
$finallevel2balance=$level2balance+$level2;

$bonusbalance2=bonus($a,'amount',$level2id);
$finalbonusbalance2=$bonusbalance2+$level2;


$sqlbonuslevel1= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance1."',`level1` = '".$finallevel1balance."' WHERE `userid`= '".$level1id."'");

$sqlbonuslevel2= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance2."',`level2` = '".$finallevel2balance."' WHERE `userid`= '".$level2id."'");	
	
	}
function invitebonus($a,$userid,$refcode)
{
 $chksummery=mysqli_query($a,"select * from `tbl_walletsummery` where `userid`='$userid' and `actiontype`='recharge'");   
 $chksummeryRow=mysqli_num_rows($chksummery);   
  if($chksummeryRow=='1')
  {
   $userQuery=mysqli_query($a,"select `id` from `tbl_user` where `owncode`='$refcode'"); 
   $userResult=mysqli_fetch_array($userQuery);
    $refuserid=$userResult['id'];
    $selectwallet=mysqli_query($a,"select `amount` from `tbl_bonus` where `userid`='".$refuserid."'");
$walletResult=mysqli_fetch_array($selectwallet);
$availableBalance=$walletResult['amount'];

$sqlbonus=mysqli_query($con,"select `bonusamount` from `tbl_paymentsetting` where `id`='1'");
$bonusResult=mysqli_fetch_array($sqlbonus);
$bonusAmount=$bonusResult['bonusamount'];
$finalbonusbalance=$availableBalance+$bonusAmount;
$today = date("Y-m-d H:i:s");

$sqlbonuslevel1= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance."',`level1` = '".$finalbonusbalance."' WHERE `userid`= '".$refuserid."'");
$sql= mysqli_query($a,"INSERT INTO `tbl_bonussummery`(`userid`,`periodid`,`level1id`,`level2id`,`level1amount`,`level2amount`,`tradeamount`,`createdate`) VALUES ('".$userid."','0','".$refuserid."','0','110','0','0','".$today."')");
  }
}
function addWallet($con,$userid,$amount,$operator){
    $walletbalance=wallet($con,'amount',$userid);
    if($operator == '+'){
    $finalbalanceDebit= $walletbalance+$amount;
    }elseif($operator == '-'){
    $finalbalanceDebit= $walletbalance-$amount;
    }
    
    $sqlwallet= mysqli_query($con,"UPDATE `tbl_wallet` SET `amount` = '".$finalbalanceDebit."' WHERE `userid`= '".$userid."'");	
}
function bonusLevel($con,$second_user,$amount,$level){
    $id = "";
    $idd = '';
    $amount = number_format((($amount*2)/100),2);
    $row_val12=mysqli_query($con,"SELECT * FROM tbl_paymentsetting WHERE id=1")->fetch_assoc();
	$level1=$row_val12[$level];
	$exactamount = ($amount/100)*$level1;
	$exactamount = number_format($exactamount,2);
    $referalid = user($con,'code',$second_user);
    if($referalid != ""){
    $qqq = "select * from `tbl_user` where `owncode`='$referalid'";
    $chkrcode2=mysqli_query($con,$qqq)->fetch_assoc();
    if($chkrcode2['id'] !="" ){
    $idd = $chkrcode2['id'];
    }
    }
    return array("id"=>$idd,"amount"=>$exactamount);
}
function getBaseUrl() 
{
	// output: /myproject/index.php
	$currentPath = $_SERVER['PHP_SELF']; 
	
	// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
	$pathInfo = pathinfo($currentPath); 
	
	// output: localhost
	$hostName = $_SERVER['HTTP_HOST']; 
	
	// output: http://
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	
	// return: http://localhost/myproject/
	return $protocol.$hostName.$pathInfo['dirname'].'/';
}
function fetchdata($con,$db,$where){
    $data = array();
    $sql = "SELECT * FROM $db $where";
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res) > 0){
     while($row = mysqli_fetch_array($res)){
         array_push($data,$row);
     }
    }
        return $data;
}
function level1($con,$id){
    $level1 = user($con,'owncode',$id);
    return fetchdata($con,'tbl_user','WHERE code='.$level1);
}
function level2($con,$id){
    $data = array();
    $level1 = level1($con,$id);
    if(count($level1) > 0){
     foreach($level1 as $row){
        $level2 = user($con,'owncode',$row['id']);
        foreach(fetchdata($con,'tbl_user','WHERE code='.$level2) as $rows){
            array_push($data,$rows);
        }
     }
    }
    return $data;
}
function level3($con,$id){
    $data = array();
    $level2 = level2($con,$id);
    if(count($level2) > 0){
     foreach($level2 as $row){
        $level3 = user($con,'owncode',$row['id']);
        foreach(fetchdata($con,'tbl_user','WHERE code='.$level3) as $rows){
            array_push($data,$rows);
        }
     }
    }
    return $data;
}
function AddIntrest($con)
{
    $userquery = mysqli_query($con,"SELECT * FROM `tbl_user` WHERE `status`='1'");
    if(mysqli_num_rows($userquery) > 0){
        while($row = mysqli_fetch_assoc($userquery)){
            $userId = $row['id'];
            $walletAmount = number_format(wallet($con, 'amount', $userId), 2);
            if($walletAmount > 0){
                $intrestPercentage = minamountsetting($con,'intrest');
                $exactPercentageAmount = ($walletAmount/100)*$intrestPercentage;
                $today = date('Y-m-d');
                $todayIntrestAdd = "SELECT * FROM `tbl_walletsummery` WHERE `userid`='$userId' and `type`='credit' and `actiontype`='intrest' and date(createdate)=date('$today')";
                $todayIntrestAdd = mysqli_query($con,$todayIntrestAdd);
                if(mysqli_num_rows($todayIntrestAdd) > 0){
                }else{
                    $addIntrestQuery = addWallet($con,$userId,$exactPercentageAmount,'+');
                    $sqllevel2= mysqli_query($con,"INSERT INTO `tbl_walletsummery`(`userid`,`orderid`,`amount`,`value`,`type`,`actiontype`) VALUES ('".$userId."','','".$exactPercentageAmount."','','credit','intrest')");
                }
            }
        }
    }
}
function level123($con,$userid){
    $data = array();
    $thiscode = user($con,'code',$userid);
    $level1 = mysqli_query($con,"SELECT * FROM `tbl_user` WHERE `owncode`=".$thiscode)->fetch_assoc();
    $i = user($con,'code',$level1["id"]);
    $level2 = mysqli_query($con,"SELECT * FROM `tbl_user` WHERE `owncode`='$i'")->fetch_assoc();
    $j = user($con,'code',$level2["id"]);
    $level3 = mysqli_query($con,"SELECT * FROM `tbl_user` WHERE `owncode`='$j'")->fetch_assoc();
    $data = array(
        "level1" => $level1['id'],
        "level2" => $level2['id'],
        "level3" => $level3['id']
        );
         return $data;
}
function findtrn($con,$id){
    $query = "SELECT * FROM `tbl_walletsummery` WHERE `id`='$id'";
    $res = mysqli_query($con,$query);
    if(mysqli_num_rows($res) > 0){
        return mysqli_fetch_assoc($res)['transactionid'];
    }
    return false;
}
function waterReward($con,$userid,$amount){
    $row_val12=mysqli_query($con,"SELECT * FROM tbl_paymentsetting WHERE id=1")->fetch_assoc();
	$level1=$row_val12["level1"];
	$level2=$row_val12["level2"];
	$level3=$row_val12["level3"];
	
	$level = level123($con,$userid);
	$amount1 = ($amount*$level1)/100;
	$amount2 = ($amount*$level2)/100;
	$amount3 = ($amount*$level3)/100;
	
	if($level['level1'] != '' && $level['level1'] != null){
	$addIntrestQuery = addWallet($con,$level['level1'],$amount,'+');
    $sqllevel2= mysqli_query($con,"INSERT INTO `tbl_walletsummery`(`userid`,`orderid`,`amount`,`value`,`type`,`actiontype`) VALUES ('".$level['level1']."','','".$amount1."','".$userid."','credit','water')");
	}
	if($level['level2'] != '' && $level['level2'] != null){
	$addIntrestQuery22 = addWallet($con,$level['level2'],$amount,'+');
    $sqllevel222= mysqli_query($con,"INSERT INTO `tbl_walletsummery`(`userid`,`orderid`,`amount`,`value`,`type`,`actiontype`) VALUES ('".$level['level2']."','','".$amount2."','".$userid."','credit','water')");
	}
	if($level['level3'] != '' && $level['level3'] != null){
	$addIntrestQuery23 = addWallet($con,$level['level3'],$amount,'+');
    $sqllevel223= mysqli_query($con,"INSERT INTO `tbl_walletsummery`(`userid`,`orderid`,`amount`,`value`,`type`,`actiontype`) VALUES ('".$level['level3']."','','".$amount3."','".$userid."','credit','water')");
	}
}
?>
