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
      
        <div class="page-wrapper ">
            
            <div class="row page-titles  " >
                <div class="col-md-5 align-self-center">
                    <h3  >Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" ><a href="javascript:void(0)" >Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                
        
                      <div class="row  p-20" style="background:#FFFFFF" >
                    <div class="col-md-3">
                        <div class="  ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle " >
                                    <span><i class="fa fa-user f-s-40 bg-primary" style="border-radius:50%;padding:15px 20px;" ></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <?php $sql="SELECT COUNT(*) FROM `tbl_teacher`";
                                $res = $conn->query($sql);
                                $row=mysqli_fetch_array($res);?> 
                                    <h2 ><?php echo $row[0];?></h2>
                                    <p class="m-b-0" style="color:black">Total Teachers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class=" ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-users f-s-40 bg-success" style="border-radius:50%;padding:15px 15px;"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                <?php $sql="SELECT COUNT(*) FROM `tbl_student`";
                                $res = $conn->query($sql);
                                $row=mysqli_fetch_array($res);?>
                                    <h2 ><?php echo $row[0];?></h2>
                                    <p class="m-b-0">Total Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="  ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-home f-s-40 bg-danger " style="border-radius:50%;padding:15px 15px;"></i></span>
                                </div>
                                <div class="media-body media-text-right" style="color:#333">
                                    <?php $sql="SELECT COUNT(*) FROM `tbl_class`";
                                $res = $conn->query($sql);
                                $row=mysqli_fetch_array($res);?>
                                    <h2 ><?php echo $row[0];?></h2>
                                    <p class="m-b-0" style="color:#333">Total Class</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="  ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-clipboard f-s-40 bg-info" style="border-radius:50%;padding:15px 15px;" ></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                     <?php $sql="SELECT COUNT(*) FROM `tbl_subject`";
                                $res = $conn->query($sql);
                                $row=mysqli_fetch_array($res);?> 
                                    <h2 ><?php echo $row[0];?></h2>
                                    <p class="m-b-0">Total Subject</p>
                                </div>
                            </div>
                        </div>
                    </div>

                
            </div>
            


            
            <div class="card mt-5">
                          <div class="card-body">
                           <h1>Recent Students</h1>
                              <div class="table-responsive m-t-40">
                                  <table id="myTable" class="table table-bordered table-striped">
                                      <thead>
                                          <tr>
                                              <th>First Name</th>
                                              <th>Last Name</th>
                                              <th>Class</th>
                                              <th>Email</th>
                                              <th>Gender</th>
                                              <th>Birth Date</th>
                                              <th>Contact No.</th>
                                             <th>Address</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                  <?php 
                                  include 'connect.php';
                                  $sql = "SELECT * FROM `tbl_student`";
                                   $result = $conn->query($sql);
$i=0;
                                 while($row = $result->fetch_assoc()) { 
                                  $sql2 = "SELECT * FROM `tbl_class` WHERE id='".$row['classname']."'";
                                   $result2=$conn->query($sql2);
                                   $row2=$result2->fetch_assoc();
                                    ?>
                                          <tr>
                                              <td><?php echo $row['sfname']; ?></td>
                                              <td><?php echo $row['slname']; ?></td>
                                              <td><?php echo $row2['classname']; ?></td>
                                              <td><?php echo $row['semail']; ?></td>
                                              <td><?php echo $row['sgender']; ?></td>
                                              <td><?php echo $row['sdob']; ?></td>
                                              <td><?php echo $row['scontact']; ?></td>
                                              <td><?php echo $row['saddress']; ?></td>
                                              
                                              <td>
          <?php if(isset($useroles)){  if(in_array("edit_student",$useroles)){ ?> 
                                              <a href="edit_student.php?id=<?=$row['id'];?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-plus-square"></i></button></a>
                                            <?php } } ?>

          <?php if(isset($useroles)){  if(in_array("delete_student",$useroles)){ ?> 
                                              <a href="view_student.php?id=<?=$row['id'];?>"><button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>
                                            <?php } } ?>
                                             
                                              </td>
                                          </tr>
                                        <?php  $i++;} 
                                        ?>

                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
 
            <div class="card">
                            <div class="card-body">
                            <h1>Exams</h1>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                  $sql1 = "SELECT * FROM  `exam`";
                                   $result1 = $conn->query($sql1);
                                   while($row = $result1->fetch_assoc()) { 
                                      ?>
                                            <tr>
                                                <td><?php echo $row['name']; ?></td>
                                                <td>
                                                <a href="view_exam.php?id=<?=$row['id'];?>"><button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>
                                                </td>
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 

                       
               
               
              
                    
        </div> 
            
            <?php include('footer.php');?>