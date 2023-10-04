<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch room details from the database based on the id
    $sql = "SELECT * FROM `room` WHERE `id` = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // Handle room not found error
        echo "Room not found!";
        exit;
    }
} else {
    // Handle missing room ID error
    echo "Room ID is missing!";
    exit;
}

// Handle form submission for updating room details
if (isset($_POST['btn_update'])) {
    $id = $_POST['id'];
    $type_id = $_POST['type_id'];
    $name = $_POST['name'];
    $row = $_POST['row'];
    $per_row = $_POST['per_row'];
    $strenght = $_POST['strength'];

    // Update room details in the database
    $update_sql = "UPDATE `room` SET `type_id`='$type_id', `name`='$name', `row`='$row', `per_row`='$class_strength', `strenght`='$strength' WHERE `id`='$id'";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "Room updated successfully!";
    } else {
        echo "Error updating room: " . $conn->error;
    }
}
?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary1">Edit Room</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Edit Room</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="input-states">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="classform">

<input type="hidden" name="currnt_date" class="form-control" value="<?php echo $current_date;?>">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Room Type</label>
                                        <div class="col-sm-9">
                                            <select type="text" name="type_id" class="form-control" required="">
                                                <!-- You should populate this select with room types -->
                                                <option value="">--Select Room Type--</option>
                                                <?php
                                                $c1 = "SELECT * FROM `room_type`";
                                                $result = $conn->query($c1);

                                                if ($result->num_rows > 0) {
                                                    while ($type_row = mysqli_fetch_array($result)) {
                                                        $selected = ($type_row['id'] == $row['type_id']) ? 'selected' : '';
                                                        ?>
                                                        <option value="<?php echo $type_row["id"]; ?>" <?php echo $selected; ?>>
                                                            <?php echo $type_row['roomname']; ?>
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
                                        <label class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $row['name']; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Number of Rows</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="row" class="form-control" placeholder="Enter Total Rows" value="<?php echo $row['row']; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Strength per Row</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="class_strength" class="form-control" placeholder="Strength per Row" value="<?php echo $row['per_row']; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Total Room Strength</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="strength" readonly class="form-control" placeholder="Total Strength" value="<?php echo $row['strenght']; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="btn_update" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var numRowsInput = $('input[name="row"]');
    var classStrengthInput = $('input[name="class_strength"]');
    var totalStrengthInput = $('input[name="strength"]');

    function updateTotalStrength() {
        var numRows = parseInt(numRowsInput.val()) || 0;
        var classStrength = parseInt(classStrengthInput.val()) || 0;
        var totalStrength = numRows * classStrength;
        totalStrengthInput.val(totalStrength);
    }

    numRowsInput.on('input', updateTotalStrength);
    classStrengthInput.on('input', updateTotalStrength);

    // Initialize total strength when the page loads
    updateTotalStrength();
});
</script>

<?php include('footer.php');?>
