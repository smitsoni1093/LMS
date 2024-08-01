<?php include('./includes/header.php'); ?>
<?php include('./includes/navigation.php'); ?>
<?php include('./includes/db.php');?>
<script>
$(document).ready(function() {
	$('#selectedStateId').on('change', function() {
		var state_id = this.value;
		$.ajax({
			url: "./includes/getDistricts.php",
			type: "POST",
			data: {
				state_id: state_id
			},
			cache: false,
			success: function(result){
				$("#districts").html(result);
			}
		});
	});
});
</script>

<div class="container pt-5 pb-3">
    <div class="row d-flex justify-content-md-center">
        <div class="btn-group w-25" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="searchBy" id="byDistrict" autocomplete="off" checked disabled>
            <label class="btn btn-outline-secondary rounded-pill fs-5 mx-1" for="byDistrict">By District</label>
            <a href="./HospitalUsingPincode.php">
                <label class="btn btn-outline-secondary rounded-pill fs-5 px-4 mx-1" for="byPincode">By Pincode</label>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <form class="justify-content-md-center d-flex" action="" id="form" method="post">
                <select class="form-select w-25 mx-1 rounded-pill px-4 fs-5" name="stateId" id="selectedStateId">
                    <option value="">Select State</option>
                    <?php
                        $query = "SELECT * FROM state";
                        $viewAllState = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($viewAllState)){
                            $state_id = $row['state_id'];
                            $state_name = $row['state_name'];
                            echo "<option value='$state_id'>$state_name</option>";
                        }
                    ?>
                </select>

                <select class="form-select w-25 mx-1 rounded-pill px-4 fs-5" name="districtId" id="districts">
                    <option value="">Select District</option>
                </select>
                <button type="submit" name="searchHospital" class="btn btn-secondary btn-lg px-5 rounded-pill mx-2">Search</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
<?php
    if(isset($_POST["searchHospital"])){
        $districtId = isset($_POST["districtId"])?$_POST["districtId"]:"";
        $query = "SELECT * FROM hospitals INNER JOIN pincode ON hospitals.hospital_pincode = pincode.pincode INNER JOIN district ON pincode.district_id = district.district_id WHERE hospitals.hospital_status = 'open' AND district.district_id = '{$districtId}'";
        $getAllDetails = mysqli_query($connection,$query);
        if(mysqli_num_rows($getAllDetails)==0){
            ?>
            <div class="card shadow d-flex align-items-center justify-content-md-center" style="min-height:200px;">
                <h4>No Hospital Found</h4>
            </div>
            <?php
        }else{
            while($row = mysqli_fetch_assoc($getAllDetails)){
                $hospital_name = $row['hospital_name'];
                $hospital_address = $row['hospital_address'];
                $contact_no = $row['contact_no'];
                $hospital_pincode = $row['hospital_pincode'];
                $area_name = $row['area_name'];
                $district_name = $row['district_name'];
                $hospital_id = $row['hospital_id'];
                ?>

                <div class="card mt-2 px-3 py-1 shadow">
                    <div class="card-body row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <?php echo "<a target='_blank' href='viewHospital.php?hospitalid=$hospital_id' class='link-success fs-3 aTagHead'>$hospital_name</a>"; ?>
                                </div>
                                <div class="col">
                                    <h6 class="card-text">+91 <?php echo $contact_no; ?></h6>
                                </div>
                            </div>
                            <h5 class="card-text"><?php echo $hospital_address; ?></h5>
                            
                            <h6 class="card-text">Pincode:
                                <b><?php echo $hospital_pincode; ?></b>
                                <?php echo "- ".$area_name.", ".$district_name;?>
                            </h6>

                        </div>
                    </div>
                </div>

                <?php
            }
        }
    }
?>
</div>