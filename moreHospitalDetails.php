
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
                        
                        <h3>Doctor Details</h3>
                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label fs-5" for="name">Doctor Name</label>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-5" for="name">Description</label>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                                <button class="btn fs-5 m-0 p-0 add_field_button">+ Add More</button>
                            </div>
                        </div>

                        <div class="row input_fields_wrap">
                            <div class="col-md-4">
                                <input type="text"  name="doctorName[]" class="form-control" placeholder="Doctor Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="doctorDescription[]" class="form-control" placeholder="Description" required>
                            </div>
                        </div>
                        
                        <br>
                        <h3>Ward Details</h3>
                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label fs-5" for="name">Ward Name</label>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-5" for="name">Total Beds</label>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                                <button class="btn fs-5 m-0 p-0 add_bed_button">+ Add More</button>
                            </div>
                        </div>

                        <div class="row bed_fields_wrap">
                            <div class="col-md-4">
                                <input type="text"  name="WardName[]" class="form-control" placeholder="Ward Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="TotalBeds[]" class="form-control" placeholder="Total Beds" required>
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
        var wrapper   		= $(".bed_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_bed_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row input_fields_wrap mt-2"><div class="col-md-4"><input type="text" name="WardName[]" class="form-control" placeholder="Ward Name" required/></div><div class="col-md-6"><input type="text" name="TotalBeds[]" class="form-control" placeholder="Total Beds" required/></div><a href="#" class="col remove_bed_field">Remove</a></div>');
            }
        });
        
        $(wrapper).on("click",".remove_bed_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });

    $(document).ready(function() {
    
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row input_fields_wrap mt-2"><div class="col-md-4"><input type="text" name="doctorName[]" class="form-control" placeholder="Doctor Name" required/></div><div class="col-md-6"><input type="text" name="doctorDescription[]" class="form-control" placeholder="Description" required/></div><a href="#" class="col remove_field">Remove</a></div>');
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>


<?php
if(isset($_POST["next"])){
    $hospitalName =  $_POST["name"];
    $hospitalUserName =  $_POST["username"];
    $hospitalPassword =  $_POST["password"];
    $hospitalContact =  $_POST["mobileNo"];
    $hospitalAddress =  $_POST["address"];
    $hospitalPincode =  $_POST["pincode"];

    $query = "INSERT INTO hospitals (hospital_username, hospital_password, hospital_name, hospital_address, hospital_pincode, contact_no, hospital_status, hospital_accepting_status) ";
    $query .= "VALUES('{$hospitalUserName}','{$hospitalPassword}','{$hospitalName}','{$hospitalAddress}','{$hospitalPincode}','{$hospitalContact}','open', 'pending')";
    $addHospital = mysqli_query($connection,$query);
    if(!$addHospital){
        $connection;
        die("QUERY FAILED " . mysqli_error($connection));
    }
    $query = "SELECT hospital_id FROM hospitals WHERE hospital_username = '$hospitalUserName'";
    $get_hospital_id = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($get_hospital_id)){
        $Hospital_id = $row['hospital_id'];
    }
    $_SESSION["RegisteringHospitalId"] = $Hospital_id;
}

if(isset($_POST["register"])){
    // echo $_SESSION["RegisteringHospitalId"];
    if(isset($_SESSION["RegisteringHospitalId"])) {
        $Hospital_id = $_SESSION["RegisteringHospitalId"];
        echo $Hospital_id;
        $doctorNames = $_POST["doctorName"];
        $doctorDescription = $_POST["doctorDescription"];
        for($i=0;$i<count($doctorNames);$i++){
            $query = "INSERT INTO doctor_details (doctor_name, doctor_description, hospital_id)";
            $query .= "VALUES('{$doctorNames[$i]}','{$doctorDescription[$i]}','{$Hospital_id}')";
            $addDocter = mysqli_query($connection,$query);
            confirm($addDocter);
        }

        $ward_names = $_POST["WardName"];
        $total_beds = $_POST["TotalBeds"];
        for($i=0;$i<count($ward_names);$i++){
            $query = "INSERT INTO ward_details (ward_name, Total_beds, Available_beds, Hospital_id)";
            $query .= "VALUES('{$ward_names[$i]}','{$total_beds[$i]}', '{$total_beds[$i]}','{$Hospital_id}')";
            $addWards = mysqli_query($connection,$query);
            confirm($addWards);
        }

        $_SESSION["RegisteringHospitalId"] = "";
        echo "<script> alert('Hospital request successfully sended'); </script>";
        echo "<script> location.href='index.php';</script>";
    } else {
        echo "<script>alert('You have not filled previous form');</script>";
        echo "<scrpit>location.href='index.php';</scrpit>";
    }
}
?>