<?php 
session_start();
include 'database.php';
$conn = $conn;




class Query
{
    
    public $create;
    
	function Create($fname,$lname,$email,$phone,$conn)
	{
        
		$sql = "INSERT INTO `student`(`fname`, `lname`, `email`, `phone`) VALUES ('$fname','$lname','$email','$phone')";
        $query = mysqli_query($conn,$sql);
		echo $query;
		return "Sucess";

	}
	function update($fname,$lname,$email,$phone,$eid,$conn){
		$sql = "UPDATE `student` SET `fname`='$fname',`lname`='$lname',`email`='$email',`phone`='$phone' WHERE id = '$eid'";
		$query = mysqli_query($conn,$sql);
		
		return "success";
	}
	function Read($conn){
		$sql = "SELECT * FROM `student`";
		$query = mysqli_query($conn,$sql);
		
		return $query;
	}
	function delete($id,$conn){
		$sql = "DELETE FROM `student` WHERE id = $id";
	    $query = mysqli_query($conn,$sql);
		
		return $query; 	
	}
	function edit($edit_id,$conn){
		$sql = "SELECT * FROM `student` WHERE id = 113";
        $query = mysqli_query($conn,$sql);
        
        return $query;
	}
	function Login($email,$password,$conn){
		$sql = "SELECT * FROM `user` WHERE email = '$email' AND password = '$password'";
		$query = mysqli_query($conn,$sql);
		$num_row = mysqli_num_rows($query);
		if($num_row == 1){
		   $row = mysqli_fetch_array($query);
           $_SESSION['username'] = $row['username'];
           $_SESSION['email'] = $row['email'];
        
           $msg = '{"msg":"successfully"}';
           
		}else{
		   $msg = '{"msg":"Invalid Login Details"}';
           return $msg;
		} 

  
	}

}


?>
