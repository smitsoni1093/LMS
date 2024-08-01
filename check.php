<?php include "./includes/db.php"; ?>
<?php
    $type = $_GET["type"];
    if($type == "mobileNo"){
        $mobile_no = $_GET['mobileNo'];
        $query = "SELECT * FROM users WHERE mobile_no = '{$mobile_no}'";
        
        $checkMobileNo = mysqli_query($connection,$query);
        if(mysqli_num_rows($checkMobileNo)>0){
            echo " - Mobile Number is Already Exist";
        }else{
            echo "";
        }
    }else if($type=="aadharNo"){
        $aadharNo = $_GET['aadharNo'];
        $query = "SELECT * FROM users WHERE user_aadhar_no = '{$aadharNo}'";
        
        $checkAadharNo = mysqli_query($connection,$query);
        if(mysqli_num_rows($checkAadharNo)>0){
            echo " - Aadhar Number is Already Exist";
        }else{
            echo "";
        }
    }

?>