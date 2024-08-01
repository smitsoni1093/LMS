<?php include('./includes/header.php'); ?>
<?php include('./includes/db.php');?>
<?php include('./includes/navigation.php'); ?>


<?php
    $lab_id = $_GET['labid'];
    $query = "SELECT * FROM laboratories INNER JOIN pincode ON laboratories.lab_pincode = pincode.pincode INNER JOIN district ON pincode.district_id = district.district_id WHERE laboratories.lab_id = '{$lab_id}'";
    $getDetails = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($getDetails);
    $lab_name = $row['lab_name'];
    $lab_username = $row['lab_username'];
    $lab_address = $row['lab_address'];
    $contact_no = $row['contact_no'];
    $lab_pincode = $row['lab_pincode'];
    $area_name = $row['area_name'];
    $district_name = $row['district_name'];
    $lab_accepting_status = $row['lab_accepting_status'];
    ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>Laboratory Details</h3>
        </div>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h3 class='card-title text-success'><?php echo $lab_name; ?><small class='text-muted h5'>- <?php echo $lab_username; ?></small></h3>
                        </div>
                        <div class="col">
                            <h5 class="card-text">+91 <?php echo $contact_no; ?></h5>
                        </div>
                    </div>
                    <h5 class="card-text"><?php echo $lab_address; ?></h5>
                    
                    <h6 class="card-text">Pincode:
                        <b><?php echo $lab_pincode; ?></b>
                        <?php echo "- ".$area_name.", ".$district_name;?>
                    </h6>

                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h3>Testing Details</h3>
        <div class="card mt-2 px-3 py-1 shadow">
            <div class="card-body row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Testing Name</th>
                            <th scope="col">Testing Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM labs_testings WHERE lab_id = '{$lab_id}'";
                        $allTestings = mysqli_query($connection,$query);
                        $index = 1;
                        while($row = mysqli_fetch_assoc($allTestings)){
                            $testing_name = $row['testing_name'];
                            $testing_price = $row['testing_price'];
                            ?>
                            
                            <tr>
                                <th scope="row"><?php echo $index;?></th>
                                <td><?php echo $testing_name;?></td>
                                <td><?php echo $testing_price;?></td>
                            </tr>
                        <?php
                        $index++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>