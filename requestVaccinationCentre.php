<!-- Header -->
<?php include('./includes/header.php')?>
<!-- Navigation -->
<?php include('./includes/navigation.php')?>
<!-- DB Connection -->
<?php include('./includes/db.php') ?>

<?php
    if(isset($_POST["next"])){
        $vcName = $_POST["name"];
        $vcUserName = $_POST["username"];
        $vcPassword = $_POST["password"];
        $vcAddress = $_POST["address"];
        $vcPincode = $_POST["pincode"];
        $vcCostType = $_POST["costType"];

        $query = "INSERT INTO vaccination_centres (vc_username, vc_password, vc_name, vc_address, vc_cost_type, vc_pincode, vc_status, 	vc_accepting_status) ";
        $query .= "VALUES('{$vcUserName}','{$vcPassword}','{$vcName}','{$vcAddress}','{$vcCostType}','{$vcPincode}','open','pending')";
        $addVc = mysqli_query($connection,$query);

        if(!$addVc){
            $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            if(isset($_POST["ageGroup"]))
            {
                $query = "Select * from vaccination_centres WHERE vc_username = '{$vcUserName}'";
                $getVcId = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($getVcId)){
                    $vc_id = $row['vc_id'];
                }

                foreach ($_POST['ageGroup'] as $ageGroup){
                    $query = "INSERT INTO vc_age_group (vc_id, age_group_id) ";
                    $query .= "VALUES('{$vc_id}','{$ageGroup}')";
                    $addAgeGroup = mysqli_query($connection,$query);
                }
            }

            if(!$addAgeGroup){
                $connection;
                die("QUERY FAILED " . mysqli_error($connection));
            }else{
                echo "<script>alert('Vaccination Centre Added Successfully.')</script>";
                echo "<script>location.href='index.php'</script>";
            }
        }

    }
?>

<script>

    var check = function() {
        if((document.getElementById('password').value === document.getElementById('confirmPassword').value) && document.getElementById('password').value == ""){
            document.getElementById('pwdMsg').innerHTML = ' ';
        }
        else if (document.getElementById('password').value === document.getElementById('confirmPassword').value) {
            document.getElementById('pwdMsg').style.color = 'green';
            document.getElementById('pwdMsg').innerHTML = 'matching';
            document.getElementById('submit').disabled = false;
        } else {
            document.getElementById('pwdMsg').style.color = 'red';
            document.getElementById('pwdMsg').innerHTML = 'not matching';
            document.getElementById('submit').disabled = true;
        }
    }
</script>

<section class="h-100 bg-light">
<div class="container-fluid py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-6">
        <div class="card shadow" style="border-radius: 1rem;">
            <div class="card-body p-4">
                <form method="post">
                    <div class="col">
                        
                        <h2>Vaccination Centre Details :</h2>
                        <hr>
                        <label class="form-label fs-5" for="name">Vaccination Centre Name</label>
                        <input class="form-control fs-5 mb-3" type="text" name="name" id="name" required>

                        <label class="form-label fs-5" for="mobileNo">Username</label>
                        <input class="form-control fs-5 mb-3" type="text" name="username" id="mobileNo" required>
                        
                        <label class="form-label fs-5" for="password">Password</label>
                        <input class="form-control fs-5 mb-3" type="password" name="password" id="password" onkeyup='check();' required>
                        
                        <label class="form-label fs-5" for="confirmPassword">Confirm Password <span class='message' id="pwdMsg"></span></label>
                        <input class="form-control fs-5 mb-3" type="password" name="confirmPassword" id="confirmPassword" onkeyup='check();' required>

                        <label class="form-label fs-5" for="address">Address</label>
                        <textarea class="form-control fs-5 mb-3" min="10" max="200" name="address" required> </textarea>

                        <label class="form-label fs-5" for="pincode">Pincode</label>
                        <select name="pincode" class="form-control fs-5 mb-3" placeholder="Select Pincode">
                            <option value="0"> Select Pincode </option>
                            <?php
                                $query = "SELECT pincode.pincode, pincode.area_name, district.district_name FROM pincode INNER JOIN district ON pincode.district_id = district.district_id";
                                $getValues = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($getValues)){
                                    $pincode = $row['pincode'];
                                    $area_name = $row['area_name'];
                                    $district_name = $row['district_name'];
                                    echo "<option value='$pincode'> $pincode  | $area_name,$district_name </option>";
                                }
                            ?>
                        </select>

                        <label class="form-label fs-5" for="costType">Cost Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="costType" value="free">
                            <label class="form-check-label" for="costType">
                                Free
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="costType" value="paid">
                            <label class="form-check-label" for="costType">
                                Paid
                            </label>
                        </div>
                        
                        <label class="form-label fs-5" for="ageGroup">Age Group</label>
                        <?php
                            $query = "SELECT * FROM age_group";
                            $getAgeGroup = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($getAgeGroup)){
                                $age_group_id = $row['age_group_id'];
                                $age_from = $row['age_from'];
                                $age_to = $row['age_to'];
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ageGroup[]" value="<?php echo $age_group_id;?>">
                                    <label class="form-check-label" for="ageGroup">
                                        <?php echo $age_from . '-' . $age_to ;?>
                                    </label>
                                </div>
                        <?php } ?>
                        

                        <button type="submit" class="btn btn-primary w-100 mt-3 mb-0 fs-5" name="next" id="submit">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>