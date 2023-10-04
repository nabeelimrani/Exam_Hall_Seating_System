<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>   
<?php
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

 $sql_currency = "select * from manage_website"; 
             $result_currency = $conn->query($sql_currency);
             $row_currency = mysqli_fetch_array($result_currency);
?>    
      
        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Exam List</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Exam List</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">                    
               <div class="card">
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Student Seat No</th>
                                                <th class="text-center">Subjects Name</th>
                                                <th class="text-center">Students Name</th>
                                                <th class="text-center">Date - Time</th> 
                                                <th class="text-center">Room Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
include 'connect.php';

$sql1 = "SELECT * FROM  `allot_student` WHERE allot_id='".$_GET['id']."' ";
$result1 = $conn->query($sql1);

while($row = $result1->fetch_assoc()) {
    $s1 = "SELECT * FROM `exam` WHERE id='".$row['exam_id']."'";
    $sr = $conn->query($s1);
    $sres = mysqli_fetch_array($sr); 

    $sqlStudent = "SELECT classname FROM `tbl_student` WHERE stud_id='".$row['stud_id']."'";
    $resultStudent = $conn->query($sqlStudent);
    $classrow = $resultStudent->fetch_assoc();

    $sqlStudentname = "SELECT * FROM `tbl_student` WHERE stud_id='".$row['stud_id']."'";
    $resultStudentname = $conn->query($sqlStudentname);
    $classrowname = $resultStudentname->fetch_assoc();

    $sqlStudent = "SELECT subjectname FROM `tbl_subject` WHERE class_id='".$classrow['classname']."'";
    $resultclass = $conn->query($sqlStudent);

    // Initialize an empty array to store subject names
    $subjectNames = array();

    while ($studentData = $resultclass->fetch_assoc()) {
        $subjectNames[] = $studentData['subjectname'];
    }

    $s2 = "SELECT * FROM `room` WHERE id='".$row['room_id']."'";
    $sr1 = $conn->query($s2);
    $sres1 = mysqli_fetch_array($sr1); 

    // Output each subject name
    foreach ($subjectNames as $subjectName) {
        ?>
        <tr>
            <td class="text-center"><?php echo $row['stud_id']; ?></td>
            <td class="text-center"><?php echo $subjectName ?></td>
            <td class="text-center"><?php echo $classrowname['sfname'] . "&nbsp;".$classrowname['slname']; ?></td>
            <td class="text-center"><?php echo $row['exam_date'].'  --  '.$row['start_time'].'-'.$row['end_time']; ?></td>
            <td class="text-center"><?php echo $sres1['name']; ?></td>
        </tr>
        <?php
    }
}
?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
        </div>
            
            <?php include('footer.php');?>