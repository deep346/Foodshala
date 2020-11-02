 <?php
	session_start();
	 
?>
<!DOCTYPE html>
<html>
<head>
<title>admin</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>FoodShala</h2> 
		<form action="admin.php" method="post">
			<div class="imgcontainer">
				<img src="image/food.png" alt="food" class="image">
				 
			</div>
			</center>
			<div class="inner_container">
				<label><b>Username:</b></label><br>
				<input type="text" placeholder="Enter Username" name="username" required><br>
				<label><b>Email:</b></label><br>
				<input type="text" placeholder="Enter Email" name="email" required><br>
				<label><b>Password:</b></label><br>
				<input type="password" placeholder="Enter Password" name="password" required><br>
				<label><b>Confirm Password</b></label><br>
				<input type="password" placeholder="Enter Password" name="cpassword" required><br>
				 
				<button name="register" class="sign_up_btn" type="submit">Sign Up</button><br>
		 
				 
			</div>
		 </form>
		
		<?php
			  if(isset($_POST['register'])){
        $con = mysqli_connect('localhost','root','root','food');
      if(!$con)  {
        die("Database connection failed");
           
    }
       $username=$_POST['username'];
       $email=$_POST['email'];
       $password=$_POST['password'];
       $cpassword=$_POST['cpassword'];
       
         
     $hashFromat="$2y$10$";
      $salt="Iusesomecrazystrings22";
      $hashF_and_salt=$hashFromat.$salt;
      $password=crypt($password,$hashF_and_salt);
       $cpassword=crypt($cpassword,$hashF_and_salt);
                  
      if($password==$cpassword)
				{
					$query = "select * from admin where username='$username'";
					
				$query_run = mysqli_query($con,$query);
				 
				if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This Username Already exists.. Please try another username!")</script>';
						}
						else
						{
                             
							  $query="INSERT INTO admin(username,email,password,confirm_password) ";
                              $query.="VALUES('$username','$email','$password','$cpassword')";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
                                
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("DB error")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
				}
				 
			}
			else
			{
			}
		?>
		 
	</div>
</body>
</html>