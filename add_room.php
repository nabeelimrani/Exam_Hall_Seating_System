<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

?>

        <div class="page-wrapper ">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1">Room Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Room Management</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="margin-left: 10%;">
                        <div class="card ">
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" action="pages/room.php" name="userform" enctype="multipart/form-data">

                                   <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $current_date;?>">
                                   <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Room Type</label>
                                                <div class="col-sm-9">
                                                    <select type="text" name="type_id" class="form-control"   placeholder="Room Type" required="">
                                                        <option value="">--Select Room Type--</option>
                                                            <?php  
                                                            $c1 = "SELECT * FROM `room_type`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php echo $row['roomname'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label"> Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="name" class="form-control" placeholder=" Name" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">No of Rows</label>
                                                <div class="col-sm-9">
                                                  <input type="number" id="numRows" min="0" name="row" class="form-control" placeholder="Enter Total Rows" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Strength per Row</label>
                                        <div class="col-sm-9">
                                      <input type="number" min="0" id="strengthPerRow" name="class_strength" class="form-control" placeholder="Strength per Row" required="">
                                                 </div>
                                             </div>

                                                            </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Total Room Strenght</label>
                                                <div class="col-sm-9">
                                                  <input type="number" id="totalStrength" min="0" name="strenght" readonly class="form-control" placeholder="Total Strenght" required="">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
$(document).ready(function() {
    // Select the input fields by their IDs
    var numRowsInput = $('#numRows');
    var strengthPerRowInput = $('#strengthPerRow');
    var totalStrengthInput = $('#totalStrength');

    // Add an event listener to the numRowsInput and strengthPerRowInput
    numRowsInput.on('input', updateTotalStrength);
    strengthPerRowInput.on('input', updateTotalStrength);

    // Function to calculate and update the total strength
    function updateTotalStrength() {
        var numRows = parseInt(numRowsInput.val()) || 0;
        var strengthPerRow = parseInt(strengthPerRowInput.val()) || 0;

        // Calculate the total strength
        var totalStrength = numRows * strengthPerRow;

        // Update the totalStrengthInput field
        totalStrengthInput.val(totalStrength);
    }
});
</script>

<?php include('footer.php');?>
