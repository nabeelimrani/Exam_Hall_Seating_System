<?php include('head.php');?>
<?php include('header1.php');?>

<?php include('stud_sidebar.php');?>   
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
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">     
                <h2 class="text-center">Abbottabad University Of Science and Technology</h2>   
                <div class="row">
                

<?php 
include 'connect.php';
$sql = "SELECT * FROM `tbl_student` WHERE id = '".$_SESSION["id"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $studentRollNumber = $row['stud_id'];
    echo '<div class="col-lg-6">';
    echo '<li><b class="badge badge-info" style="font-size: 15px;">Seat Number: &nbsp;' . $studentRollNumber . '</b></li>';
    echo '</div>';
}
?>


                    
                    <div class="col-lg-6">
                  
                    </div>
                </div>            
               <div class="card">
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center"> Exam Name</th>
            <th class="text-center">Subject Name</th>
            <th class="text-center">Date - Time</th>
            <th class="text-center">Room Name</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        include 'connect.php';
        $sql = "SELECT * FROM tbl_student WHERE id = '".$_SESSION["id"]."'";
        $result1 = $conn->query($sql);
        $stdrow = $result1->fetch_assoc(); // Fetch student data
        
        $sql1 = "SELECT * FROM  `allot_student` WHERE student_id='".$_SESSION['id']."'";
        $result2 = $conn->query($sql1);
        
        $s3 = "SELECT * FROM `tbl_subject` WHERE class_id='".$stdrow['classname']."'";
        $sr3 = $conn->query($s3);
        
        while ($row = $result2->fetch_assoc()) {
            $s1 = "SELECT * FROM `exam` WHERE id='".$row['exam_id']."'";
            $sr = $conn->query($s1);
            $sres = $sr->fetch_assoc();
        
            $s2 = "SELECT * FROM `room` WHERE id='".$row['room_id']."'";
            $sr1 = $conn->query($s2);
            $sres1 = $sr1->fetch_assoc();
        
            // Fetch subject data from the subject query
            $sres3 = $sr3->fetch_assoc();
        
            // Check if there are still subject records to fetch
            if (!$sres3) {
                // You can decide what to do when there are no more subjects
                // For example, you could break out of the loop or continue processing
                break;
            }
            
            ?>
            <tr>
                <td class="text-center"><?php echo $sres['name']; ?></td>
                <td class="text-center"><?php echo $sres3['subjectname']; ?></td>
                <td class="text-center"><?php echo $row['exam_date'].'  ---  '.$row['start_time'].'-'.$row['end_time']; ?></td>
                <td class="text-center"><?php echo $sres1['name']; ?></td>
            </tr>
            <?php
        }
?>        
    </tbody>
</table>

                                    
                                </div>
                            </div>
                        </div> 
        </div>
            
            <?php include('footer.php');?>
