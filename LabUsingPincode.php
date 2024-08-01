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
            <a href="./searchForTesting.php">
                <label class="btn btn-outline-secondary rounded-pill fs-5 px-4 mx-1" for="byPincode">By District</label>
            </a>
            <input type="radio" class="btn-check" name="searchBy" id="byDistrict" autocomplete="off" checked disabled>
            <label class="btn btn-outline-secondary rounded-pill fs-5 mx-1" for="byDistrict">By Pincode</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <form class="justify-content-md-center d-flex" action="" id="form" method="post">
                <input type="text" class="form-control w-25 px-4 fs-5 rounded-pill" name="pincode" id="pincode" placeholder="Enter Pincode">
                <button type="submit" name="searchTesting" class="btn btn-secondary btn-lg px-5 rounded-pill mx-2">Search</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
<?php
    if(isset($_POST["searchTesting"])){
        $pincode = isset($_POST["pincode"])?$_POST["pincode"]:"";
        // $districtId = isset($_POST["districtId"])?$_POST["districtId"]:"";
        $query = "SELECT * FROM laboratories INNER JOIN pincode ON laboratories.lab_pincode = pincode.pincode WHERE laboratories.lab_pincode = '{$pincode}' AND laboratories.lab_status = 'open' AND lab_accepting_status = 'accepted'";
        $getAllDetails = mysqli_query($connection,$query);
        if(mysqli_num_rows($getAllDetails)==0){
            ?>
            <div class="card shadow d-flex align-items-center justify-content-md-center" style="min-height:200px;">
                <h4>No Laboratories Found</h4>
            </div>
            <?php
        }else{
            while($row = mysqli_fetch_assoc($getAllDetails)){
                $lab_name = $row['lab_name'];
                $lab_id = $row['lab_id'];
                $lab_address = $row['lab_address'];
                $contact_no = $row['contact_no'];
                $lab_pincode = $row['lab_pincode'];
                $area_name = $row['area_name'];
                ?>

                <div class="card mt-2 px-3 py-1 shadow">
                    <div class="card-body row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <?php echo "<a target='_blank' href='viewLab.php?labid=$lab_id' class='link-success fs-3 aTagHead'>$lab_name</a>"; ?>
                                </div>
                                <div class="col">
                                    <h6 class="card-text">+91 <?php echo $contact_no; ?></h6>
                                </div>
                            </div>
                            <h5 class="card-text"><?php echo $lab_address; ?></h5>
                            
                            <h6 class="card-text">Pincode:
                                <b><?php echo $lab_pincode; ?></b>
                                <?php echo "- ".$area_name ?>
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