<!-- Header -->
<?php include('./includes/header.php')?>
<!-- Navigation -->
<?php include('./includes/navigation.php')?>
<!-- DB Connection -->
<?php include('./includes/db.php') ?>

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
                <form action="./moreHospitalDetails.php" method="post">
                    <div class="col">
                        
                        <h2>Hospital Details :</h2>
                        <hr>
                        <label class="form-label fs-5" for="name">Hospital Name</label>
                        <input class="form-control fs-5 mb-3" type="text" name="name" id="name" required>

                        <label class="form-label fs-5" for="mobileNo">Username</label>
                        <input class="form-control fs-5 mb-3" type="text" name="username" id="mobileNo" required>
                        
                        <label class="form-label fs-5" for="password">Password</label>
                        <input class="form-control fs-5 mb-3" type="password" name="password" id="password" onkeyup='check();' required>
                        
                        <label class="form-label fs-5" for="confirmPassword">Confirm Password <span class='message' id="pwdMsg"></span></label>
                        <input class="form-control fs-5 mb-3" type="password" name="confirmPassword" id="confirmPassword" onkeyup='check();' required>
                        
                        <label class="form-label fs-5" for="mobileNo">Contact No</label>
                        <input class="form-control fs-5 mb-3" type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}" required>

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
                        <button type="submit" class="btn btn-primary w-100 mt-3 mb-0 fs-5" name="next" id="submit">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>