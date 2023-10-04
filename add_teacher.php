<?php
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

date_default_timezone_set('Asia/Karachi');
$current_date = date('Y-m-d');

$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission here
    // Example code to save teacher data
    $tfname = $_POST['tfname'];
    $tlname = $_POST['tlname'];
    $classname = $_POST['classname'];
    $subjectname = $_POST['subjectname'];
    $temail = $_POST['temail'];
    $password = $_POST['password'];
    $tgender = $_POST['tgender'];
    $tdob = $_POST['tdob'];
    $tcontact = $_POST['tcontact'];
    $taddress = $_POST['taddress'];

    // Perform database operations here (insert into database, etc.)
    // ...

    // Redirect to a success page or show a success message
    $successMessage = "Teacher information saved successfully!";
}
?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Teacher Management</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add Teacher Management</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-title"></div>
                    <div class="card-body">
                        <div class="input-states">
                            <form class="form-horizontal" method="POST" action="pages/save_teacher.php"
                                  name="teacherform" enctype="multipart/form-data">

                                <input type="hidden" name="current_date" class="form-control"
                                       value="<?php echo $current_date; ?>">

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tfname" class="form-control"
                                                   placeholder="Enter First Name" id="tfname"
                                                   onkeydown="return alphaOnly(event);" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tlname" class="form-control"
                                                   placeholder="Enter Last Name" id="tlname"
                                                   onkeydown="return alphaOnly(event);" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Class</label>
                                        <div class="col-sm-9">
                                            <select type="text" name="classname" id="classname"
                                                    class="form-control" placeholder="Select Class" required="">
                                                <option value="">--Select Class--</option>
                                                <?php
                                                $c1 = "SELECT * FROM `tbl_class`";
                                                $result = $conn->query($c1);

                                                if ($result->num_rows > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row["id"]; ?>">
                                                            <?php echo $row['classname']; ?>
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
                                        <label class="col-sm-3 control-label">Subject</label>
                                        <div class="col-sm-9">
                                            <select type="text" name="subjectname" id="subjectname"
                                                    class="form-control" placeholder="Select Subject" required="">
                                                <option value="">--Select Subject--</option>
                                                <?php
                                                $c1 = "SELECT * FROM `tbl_subject`";
                                                $result = $conn->query($c1);

                                                if ($result->num_rows > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row["id"]; ?>"
                                                                data-id="<?php echo $row["class_id"]; ?>">
                                                            <?php echo $row['subjectname']; ?>
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
                                        <label class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="temail" class="form-control"
                                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                                   placeholder="Enter Email" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" id="password"
                                                   placeholder="Enter Password" onkeyup='check();'
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="cpassword" id="confirm_password"
                                                   placeholder="Confirm Password" onkeyup='check();'
                                                   class="form-control" required>
                                            <span id="message"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select name="tgender" id="tgender" class="form-control" required="">
                                                <option value="">--Select Gender--</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Date Of Birth</label>
                                        <div class="col-sm-9">
                                            <input type="date" name="tdob" class="form-control"
                                                   placeholder="Birth Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Contact</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tcontact" class="form-control"
                                                   placeholder="Contact Number" id="tcontact" minlength="10"
                                                   maxlength="10" onkeypress="javascript:return isNumber(event)"
                                                   required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="4" name="taddress"
                                                      placeholder="Enter Address" style="height: 120px;"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="btn_save"
                                        class="btn btn-primary btn-flat m-b-30 m-t-30">Submit
                                </button>
                            </form>
                            <?php
                            if (!empty($successMessage)) {
                                echo '<div class="alert alert-success">' . $successMessage . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>

<script>
    var check = function () {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'NOT Matching';
        }
    }

    $('#classname').change(function () {
        $("#subjectname").val('');
        $("#subjectname").children('option').hide();
        var class_id = $(this).val();
        $("#subjectname").children("option[data-id=" + class_id + "]").show();
    });
</script>
