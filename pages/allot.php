<?php
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('../connect.php');
extract($_POST);

// Insert into the `allot` table
$sqlAllot = "INSERT INTO `allot` (`class_id`, `room_type_id`, `subject_id`, `exam_id`, `added_date`) 
             VALUES ('$class_id', '$room_type_id', '$subject_id', '$exam_id', '" . date('Y-m-d') . "')";

if ($conn->query($sqlAllot) === TRUE) {
    $last_id = $conn->insert_id;

    // Retrieve exam information
    $sqlExam = "SELECT * FROM `exam` WHERE id = '$exam_id'";
    $resultExam = $conn->query($sqlExam);
    $examData = mysqli_fetch_array($resultExam);

    // Retrieve room information
    $sqlRooms = "SELECT * FROM `room` WHERE type_id = '$room_type_id'";
    $resultRooms = $conn->query($sqlRooms);

    while ($roomData = mysqli_fetch_array($resultRooms)) {
        // Retrieve students in the same class
        $sqlStudents = "SELECT * FROM `tbl_student` WHERE classname = '$class_id'";
        $resultStudents = $conn->query($sqlStudents);
        $i = 1;
echo "bb";
        while ($studentData = mysqli_fetch_array($resultStudents)) {
            if ($i <= $roomData['strenght']) {
                // Check if allotment already exists
                $sqlAllotmentExists = "SELECT * FROM `allot_student` WHERE exam_id = '$exam_id' AND student_id = '$studentData[id]'";
                $resultAllotmentExists = $conn->query($sqlAllotmentExists);

                if ($resultAllotmentExists->num_rows == 0) {
                    // Insert into `allot_student` table
                    $sqlInsertAllotment = "INSERT INTO `allot_student` (`allot_id`, `exam_id`, `exam_date`, `start_time`, `end_time`, `room_id`, `student_id`, `stud_id`)
                                           VALUES ('$last_id', '$exam_id', '$examData[exam_date]', '$examData[start_time]', '$examData[end_time]', '$roomData[id]', '$studentData[id]', '$studentData[stud_id]')";
                    $conn->query($sqlInsertAllotment);
                }
            }
            $i++;
        }
    }


      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_allotment.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_allotment.php";
</script>
<?php } ?>
