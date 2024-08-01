<!-- Header -->
<?php include('./includes/header.php')?>
<!-- Navigation -->
<?php include('./includes/navigation.php')?>
<!-- DB Connection -->
<?php include('./includes/db.php') ?>


<?php
    $aadharNumberExist = false;
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $mobileNo = $_POST['mobileNo'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $bloodGroup = $_POST['bloodGroup'];
        $aadharNo = $_POST['aadharNo'];

        $query = "INSERT INTO `users`(`password`, `user_name`, `user_aadhar_no`, `mobile_no`, `user_email`, `user_dob`, `user_gender`, `user_blood_group`) VALUES ('{$password}','{$name}','{$aadharNo}','{$mobileNo}','{$email}','{$dob}','{$gender}','{$bloodGroup}')";

        $register = mysqli_query($connection,$query);
        if(!$register){
            die("QUERY FAILED " . mysqli_error($connection));
        }else{
            echo '<script>
            alert("Registration Successfull");
            window.location.href="login.php?user_role=user";
            </script>';
        }


        // $filename = $_FILES["aadharDocumentImage"]["name"];
        // $tempname = $_FILES["aadharDocumentImage"]["tmp_name"];

        // $folder = "Documents/" . $aadharNo . "/";
        // if(!file_exists($folder)){
        //     mkdir("Documents/" . $aadharNo);
        //     $folder .= $filename;
        //     move_uploaded_file($tempname, $folder);
        // }else{
        //     echo "Aadhar Number is Already Exists";
        // }

        // $query = "INSERT INTO users (password, user_name, user_aadhar_no, mobile_no, user_email, user_dob, user_gender, user_blood_group, aadhar_document_name) ";
        // $query .= "VALUES('{$password}','{$name}','{$aadharNo}','{$mobileNo}','{$email}','{$dob}','{$gender}','{$bloodGroup}','{$filename}')";

        // $register = mysqli_query($connection,$query);
        // confirm($register);
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

    function checkMobileNo(mobileNo){
        const req = new XMLHttpRequest();
        req.onload = function(){
            document.getElementById("mobileExist").innerHTML = this.responseText;
        }
        req.open("GET","check.php?type=mobileNo&mobileNo="+mobileNo);
        req.send();
    }

    function checkAadharNo(aadharNo){
        const req = new XMLHttpRequest();
        req.onload = function(){
            document.getElementById("aadharExist").innerHTML = this.responseText;
        }
        req.open("GET","check.php?type=aadharNo&aadharNo="+aadharNo);
        req.send();
    }
</script>

<!-- Page Content -->
<section class="h-100 bg-light">
<div class="container-fluid py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow" style="border-radius: 1rem;">
          <div class="card-body p-5">
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <h1>Registration Form</h1>

                    <label class="form-label fs-5" for="name">Name</label>
                    <input class="form-control fs-4 mb-3" type="text" name="name" id="name" required>

                    <label class="form-label fs-5" for="mobileNo">Mobile No</label><span id="mobileExist" style="color:red" class="fs-6 alert alert-light p-0 m-0" role="alert"></span>
                    <input class="form-control fs-4 mb-3" type="tel" name="mobileNo" id="mobileNo" onkeyup="checkMobileNo(this.value)" pattern="[1-9]{1}[0-9]{9}" required>
                    
                    <label class="form-label fs-5" for="email">Email</label>
                    <input class="form-control fs-4 mb-3" type="email" name="email" id="email" required>

                    <label class="form-label fs-5" for="password">Password</label>
                    <input class="form-control fs-4 mb-3" type="password" name="password" id="password" onkeyup='check();' required>

                    <label class="form-label fs-5" for="confirmPassword">Confirm Password <span class='message' id="pwdMsg"></span></label>
                    <input class="form-control fs-4 mb-3" type="password" name="confirmPassword" id="confirmPassword" onkeyup='check();' required>

                    <label class="form-label fs-5" for="dob">Date of Birth</label>
                    <input class="form-control fs-4 mb-3" type="date" name="dob" id="dob" max="2003-12-31" required>

                    <label class="form-label fs-5" for="gender">Gender : </label>
                    <input class="radio" type="radio" name="gender" id="male" value="Male" required>
                    <label class="form-label fs-5" for="male" class="light">Male</label>
                    <input class="radio" type="radio" name="gender" id="female" value="Female">
                    <label class="form-label fs-5" for="female" class="light">Female</label>
                    <br>
                    <label class="form-label fs-5" for="bloodGroup">Blood Group : </label>
                    <select class="form-group fs-5" name="bloodGroup" id="bloodGroup" required>
                        <option value=""></option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option>
                        <option value="O+">O+</option>
                        <option value="AB+">AB+</option>
                        <option value="A-">A-</option>
                        <option value="B-">B-</option>
                        <option value="O-">O-</option>
                        <option value="AB-">AB-</option>
                    </select>
                    <br>
                    <label for="aadharNo" class="form-label fs-5">Aadhar Card No</label><span id="aadharExist" style="color:red" class="fs-6 alert alert-light p-0 m-0" role="alert"></span>
                    <input type="text" class="form-control fs-4 mb-3" name="aadharNo" id="aadharNo" pattern="[0-9]{12}" onkeyup="checkAadharNo(this.value)" required>

                    <!-- <label for="aadharDocName" class="form-label fs-5">Aadhar Card Photo</label>
                    <input type="file" class="form-control fs-4 mb-3" name="aadharDocumentImage" id="aadharDocumentImage" accept="image/png, image/jpeg" required> -->

                    <button type="submit" class="btn btn-primary w-100 mt-3 mb-0" name="submit" id="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
</section>

<!-- Footer -->
<?php include('./includes/footer.php')?>