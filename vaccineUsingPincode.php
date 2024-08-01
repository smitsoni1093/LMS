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
            <a href="./searchForVaccine.php">
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
                <input type="date" class="form-control w-25 mx-1 rounded-pill px-4 fs-5" id="selectDate" name="selectedDate" required>
                <input type="text" class="form-control w-25 px-4 fs-5 rounded-pill" name="pincode" id="pincode" placeholder="Enter Pincode" required>
                <button type="submit" name="searchTesting" class="btn btn-secondary btn-lg px-5 rounded-pill mx-2">Search</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
<?php
    if(isset($_POST["searchTesting"])){
        $pincode = $_POST["pincode"];
        $date = $_POST['selectedDate'];
        $query = "SELECT * FROM vaccination_centres INNER JOIN pincode ON vaccination_centres.vc_pincode = pincode.pincode INNER JOIN district ON pincode.district_id = district.district_id INNER JOIN vaccine_stock ON vaccine_stock.vc_id = vaccination_centres.vc_id INNER JOIN vaccine_type ON vaccine_type.vaccine_id = vaccine_stock.vaccine_type WHERE vaccination_centres.vc_status = 'open' AND pincode.pincode = '{$pincode}' AND vaccine_stock.stock_date = '{$date}'";

        $getAllDetails = mysqli_query($connection,$query);
        if(mysqli_num_rows($getAllDetails)==0){
            ?>
            <div class="card shadow d-flex align-items-center justify-content-md-center" style="min-height:200px;">
                <h4>No Vaccination Centre Found</h4>
            </div>
            <?php
        }else{
            while($row = mysqli_fetch_assoc($getAllDetails)){
                $vc_name = $row['vc_name'];
                $vc_address = $row['vc_address'];
                $vc_cost_type = $row['vc_cost_type'];
                $vc_pincode = $row['vc_pincode'];
                $area_name = $row['area_name'];
                $district_name = $row['district_name'];
                $vc_id = $row['vc_id'];
                $vaccine_name = $row['vaccine_name'];
                $available_vaccine_stock = $row['available_vaccine_stock'];
                $vaccine_price = $row['vaccine_price'];
                ?>

                <div class="card mt-2 px-3 py-1 shadow">
                    <div class="card-body row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <?php echo "<h4 class='link-success fs-3 aTagHead'>$vc_name</h4>"; ?>
                                </div>
                                <div class="col">
                                    <?php if($vc_cost_type=='free'){ ?>
                                        <span class="badge rounded-pill fs-6 bg-primary">Free</span>
                                    <?php }else{ ?>
                                        <span class="badge rounded-pill fs-6 bg-warning text-dark">Paid</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <h5 class="card-text"><?php echo $vc_address; ?></h5>
                            
                            <h6 class="card-text">Pincode:
                                <b><?php echo $vc_pincode; ?></b>
                                <?php echo "- ".$area_name.", ".$district_name;?>
                            </h6>

                            <span class="card-text fs-6">Age Groups : </span>
                            <?php
                                $query = "SELECT * FROM vc_age_group INNER JOIN age_group ON vc_age_group.age_group_id = age_group.age_group_id WHERE vc_id = '$vc_id'";
                                $getAgeGroups = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($getAgeGroups)){
                                    $age_from = $row['age_from'];
                                    $age_to = $row['age_to'];
                                    echo "<span class='badge fs-6 bg-secondary mx-1'> " .$age_from . "-" . $age_to . "</span>";
                                }
                            ?>
                        </div>
                        <div class="col">
                            <h5><?php echo $vaccine_name ?></h5>
                            <h5>Available Vaccines : <?php echo $available_vaccine_stock ?></h5>
                            <?php if($vc_cost_type=='free'){ ?>
                                <h5>Price : None </h5>
                            <?php }else{ ?>
                                <h5>Price : <?php echo $vaccine_price ?></h5>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php
            }
        }
    }
?>
</div>