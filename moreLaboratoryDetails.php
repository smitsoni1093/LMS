
<!-- Header -->
<?php include('./includes/header.php')?>
<!-- Navigation -->
<?php include('./includes/navigation.php')?>
<!-- DB Connection -->
<?php include('./includes/db.php') ?>

<section class="h-100 bg-light">
<div class="container-fluid py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-6">
        <div class="card shadow" style="border-radius: 1rem;">
            <div class="card-body p-4">
                <form action="" method="post">
                    <div class="col">
                        
                        <h3>Testing Details</h3>
                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label fs-5" for="name">Testing Name</label>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-5" for="name">Price</label>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                                <button class="btn fs-5 m-0 p-0 add_field_button">+ Add More</button>
                            </div>
                        </div>

                        <div class="row input_fields_wrap">
                            <div class="col-md-4">
                                <input type="text"  name="testingName[]" class="form-control" placeholder="Testing Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="testingPrice[]" class="form-control" placeholder="Price" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3 mb-0 fs-5" name="register" id="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>

<script>
    $(document).ready(function() {
    
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row input_fields_wrap mt-2"><div class="col-md-4"><input type="text" name="testingName[]" class="form-control" placeholder="Testing Name" required/></div><div class="col-md-6"><input type="text" name="testingPrice[]" class="form-control" placeholder="Price" required/></div><a href="#" class="col remove_field">Remove</a></div>');
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>


<?php
if(isset($_POST["next"])){
    $labName =  $_POST["name"];
    $labUserName =  $_POST["username"];
    $labPassword =  $_POST["password"];
    $labContact =  $_POST["mobileNo"];
    $labAddress =  $_POST["address"];
    $labPincode =  $_POST["pincode"];

    $query = "INSERT INTO laboratories (lab_username, lab_password, lab_name, lab_address, lab_pincode, contact_no, lab_status, lab_accepting_status) ";
    $query .= "VALUES('{$labUserName}','{$labPassword}','{$labName}','{$labAddress}','{$labPincode}','{$labContact}','open', 'pending')";
    $addLaboratory = mysqli_query($connection,$query);
    if(!$addLaboratory){
        $connection;
        die("QUERY FAILED " . mysqli_error($connection));
    }
    $query = "SELECT lab_id FROM laboratories WHERE lab_username = '$labUserName'";
    $get_lab_id = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($get_lab_id)){
        $lab_id = $row['lab_id'];
    }
    $_SESSION["RegisteringLaboratoryId"] = $lab_id;
}

if(isset($_POST["register"])){
    if(isset($_SESSION["RegisteringLaboratoryId"])) {
        $lab_id = $_SESSION["RegisteringLaboratoryId"];
        echo $lab_id;
        $testingName = $_POST["testingName"];
        $testingPrice = $_POST["testingPrice"];
        for($i=0;$i<count($testingName);$i++){
            $query = "INSERT INTO labs_testings (testing_name, testing_price, lab_id)";
            $query .= "VALUES('{$testingName[$i]}','{$testingPrice[$i]}','{$lab_id}')";
            $addTesting = mysqli_query($connection,$query);
            confirm($addTesting);
        }

        echo "<script> alert('Laboratory request successfully sended'); </script>";
        echo "<script> location.href='index.php';</script>";
    } else {
        echo "<script>alert('You have not filled Laboratory form :(');</script>";
        echo "<scrpit>location.href='index.php';</scrpit>";
    }
}
?>