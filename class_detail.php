<?php require('head.php'); ?>
<?php require('header.php'); ?>
<?php require('sidebar.php'); ?>
<style>
    b {
        font-weight: bold;
    }
</style>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Room Details</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="view_room.php">View Room</a></li>
                <li class="breadcrumb-item active">Room Details</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="text-right">
            <button onclick="printPage()" class="btn btn-primary">Print</button>
        </div>
        <div class="card">
            <?php
            if (isset($_GET['id'])) {
                include 'connect.php';
                $id = $_GET['id'];

                $sql1 = "SELECT * FROM `exam` WHERE `class_id` = $id";
                $result1 = $conn->query($sql1);
                $row = $result1->fetch_assoc();
                $exam_id = $row['id'];
                $classid = $row['class_id'];

                $sql2 = "SELECT * FROM `room` WHERE `id` = $id";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();

                $sql3 = "SELECT * FROM `tbl_subject` WHERE `class_id` = $id";
                $result3 = $conn->query($sql3);

                $sql5 = "SELECT * FROM `tbl_class` WHERE `id` = $classid";
                $result5 = $conn->query($sql5);
                
                $sql4 = "SELECT * FROM `allot_student` WHERE `exam_id` = $exam_id";
                $result4 = $conn->query($sql4);
                $studid = array(); // Initialize the array to store student IDs
                
                while ($row4 = mysqli_fetch_assoc($result4)) {
                    $studid[] = $row4['stud_id'];
                }

                // Sort the studid array in ascending order
                sort($studid);
            ?>
            <div class="card-body">
                <h2 class="text-center">Abbottabad University of Science and Technology</h2>
                <h3 class="text-center">Department of Computer Science</h3>
                <h3 class="text-center">Time:&nbsp;&nbsp;<?php echo $row['start_time']; ?> AM - <?php echo $row['end_time']; ?> PM</h3>
                <h3 class="text-center">Dated:&nbsp;&nbsp;<?php echo $row['exam_date']; ?></h3>
                <h3 class="text-center">Room:&nbsp;&nbsp;<?php echo $row2['name']; ?></h3><br>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <?php
                        $totalRows = intval($row2['row']);
                        $perRowStrength = intval($row2['per_row']);
                        $subjectNames = array();

                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            $subjectNames[] = $row3['subjectname'];
                        }

                        while ($row5 = mysqli_fetch_assoc($result5)) {
                            $classname = $row5['classname'];
                        }

                        // Create columns based on total rows
                        for ($i = 1; $i <= $totalRows; $i++) {
                            echo '<th class="text-center"> ' .'Row: ' . $i .'<br>Paper: '. $subjectNames[($i - 1) % count($subjectNames)] . '<br>Class: ' . $classname .  '</th>';
                        }

                        // Create rows within each column based on per row strength
                        for ($j = 1; $j <= $perRowStrength; $j++) {
                            echo '<tr>';
                            for ($i = 0; $i < $totalRows; $i++) {
                                $arrayIndex = ($i * $perRowStrength) + $j - 1;
                                if (isset($studid[$arrayIndex])) {
                                    echo '<td class="text-center">' . $studid[$arrayIndex] . '</td>';
                                } else {
                                    echo '<td class="text-center">---</td>'; // Display "---" for empty cells
                                }
                            }
                            echo '</tr>';
                        }
                        ?>
                        </tr>
                    </thead>
                </table>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
        function printPage() {
            var printContents = document.querySelector('.card').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</div>
