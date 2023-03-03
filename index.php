<?php 
   include 'function.php';
   
   $obj = new Query();
   
   // read operation
   $data = $obj->Read($conn);
  
   
   if(isset($_POST['addform'])){
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
   
     $obj->Create($fname,$lname,$email,$phone,$conn);

   
   }
   
   if(isset($_POST['editform'])){
     $eid = $_POST['eid'];
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
   
     $obj->update($fname,$lname,$email,$phone,$eid,$conn);
   
   
   }
   
   if(isset($_GET['id'])){
    $id = $_GET['id'];
    $obj->delete($id,$conn);
   }
   
   if(isset($_POST['lform'])){
     $email = $_POST['email'];
     $password = $_POST['password'];
     
     $obj->Login($email,$password,$conn);
   }
   
   if(isset($_GET['logout'])){
     $logout = $_GET['logout'];
     if($logout){
         session_destroy();
     }
   }
   
   ?>
<!doctype html>
<html lang="en" id="a">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script type="text/javascript" src="ajax.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" type="text/css" href="style.css">
      <title>Jquery Crud operation </title>
   </head>
   <body>
     
    

      <div class="container mt-4">
         <div class="card" id="msgwel">
            <div class="card-body">
               <h5 class="font-weight-light float-left">
               

                   <h1 id="session message"></h5>
                  <?php   
                  if(isset($_SESSION['username'])){
                    echo "<span class='h4 font-weight-light text-dark'>Hellow ," . $_SESSION['username'] . "</span>"; 
                  }else{
                    echo "Please do Login..";

                  } 
                  ?></h2>
                  
                 <?php 
                  if(isset($_SESSION['email'])){
                     echo '<button type="button" class="btn btn-danger float-right" id="logout"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Logout</button>
                  ';  
                  }else{
                     echo '<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#loginmodal"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;login</button>
                  ';
                  }
                  ?>

            </div> 
         </div>
        
         <br>


         <div class="row">
            <div class="col-xl-4 shadow p-3 mb-5 bg-white rounded">
               <div class="card">
                  <form id="StudEdit" class="d-none">
                     <div class="card-header">Edit Records </div>
                     <div class="card-body">
                        <div class="alert d-none" role="alert" id="msg">
                        </div>
                        <div class="form-group">
                           <label>Student ID</label>
                           <input type="text" name="eid" id="eid" class="form-control" readonly="readonly">
                           <small id="Ferror" class=""></small>
                        </div>
                        <div class="form-group">
                           <label>First Name</label>
                           <input type="text" name="fname" id="efname" class="form-control">
                           <small id="Ferror" class=""></small>
                        </div>
                        <div class="form-group">
                           <label>Last Name</label>
                           <input type="text" name="lname" id="elname" class="form-control">
                           <small id="lerror" class=""></small>
                        </div>
                        <div class="form-group">
                           <label>Email</label>
                           <input type="text" name="email" id="eemail" class="form-control">
                        </div>
                        <div class="form-group">
                           <label>Phone</label>
                           <input type="number" name="phone" id="ephone" class="form-control">
                        </div>
                        <button class="btn btn-primary" id="eUpdateStudBtn">Update</button>
                     </div>
                  </form>
                  <form id="StudAdd" enctype="multipart/form-data" class="">
                     <div class="card-header">Add Records </div>
                     <div class="card-body">
                        <div class="alert d-none" role="alert" id="msg">
                        </div>
                        <div class="form-group">
                           <label>First Name</label>
                           <input type="text" name="fname" id="fname" class="form-control">
                           <small id="ferr" class=""></small>
                        </div>
                        <div class="form-group">
                           <label>Last Name</label>
                           <input type="text" name="lname" id="lname" class="form-control">
                           <small id="lerr" class=""></small>
                        </div>
                        <div class="form-group">
                           <label for="field">Email</label>
                           <div class="valid-message"></div>

                           <input type="text" name="email" id="email" class="form-control">
                           <small id="emailerr" class=""></small>
                        </div>
                        <div class="form-group">
                           <label>Phone</label>
                           <input type="number" name="phone" id="phone" class="form-control">
                           <small id="phoneerr" class=""></small>
                        </div>
                        <button class="btn btn-primary addstud" id="AddStudBtn">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-xl-8 shadow p-3 mb-5 bg-white rounded">
               <div class="card w-100">
                  <div class="card-header">Student Details.
                  </div>
                  <div class="card-body">
                     <form class="form-inline">
                        <input id="myInput" class="form-control mr-sm-2" type="search" placeholder="Search Records.." aria-label="Search">
                     </form>
                     <br>
                     <div class="alert alert-success d-none" role="alert" id="tblmsg">
                     </div>
                     <table class="table table-hover" id="table">
                        <thead>
                           <tr>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                               
                              <th></th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="myTable" class="">
                           <?php 
                              if(mysqli_num_rows($data) == 0){
                                 echo '<tr class="no-records" id="noRec"><td colspan="2"><h1 class="display-4">No Recoard Found</h1></td></tr>';  
                              }else{


                              while ($row = mysqli_fetch_array($data)) {
                                ?>
                           <tr>
                              <td><?php echo $row['fname']; ?></td>
                              <td><?php echo $row['lname']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['phone']; ?></td>
                              
                              <td>
                                  <button class="btn btn-success edit" 
                                    data-id="<?php echo $row['id']?>"
                                    data-fname="<?php echo $row['fname']?>"
                                    data-email="<?php echo $row['email']?>"
                                    data-phone="<?php echo $row['phone']?>"
                                    data-lname="<?php echo $row['lname']?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    &nbsp;&nbsp;Edit
                                 </button>
                              </td>
                              <td>
                                 
                                  
                                       <button class="btn btn-danger delete shadow rounded mr-4" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</button>
                                   
                              </td>
                              <td rowspan="1" class="d-none" id="msgnotfound">Data Are Not Found</td>
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
         </table>
      </div>

       



      <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form  id="LoginForm">
                  <div class="modal-body">
                     <div class="form-group">
                        <label>Email</label>
                        <input type="Email" id="l_email" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="Password" id="l_password" class="form-control">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Login</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
</html>