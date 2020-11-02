  <?php
 
 
 
        $con = mysqli_connect('localhost','root','root','food');
      if(!$con)  {
        die("Database connection failed");
           
    }
   

?>

 
  
  <?php
			 if(isset($_POST['submit']))
			{
				 $username=$_POST['username'];
  
				 $password=$_POST['password'];
              
                  
				$query = "SELECT * FROM admin WHERE username='$username' and password='$password'";
				 
				$query_run = mysqli_query($con,$query);
                 while($row=mysqli_fetch_assoc(	$query_run)){
                     $password=$row['password'];
                 }
				 
				if($password=$password)
				{
				 
                   
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					
					header( "Location:admincart.php");
                }
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
				 
			  
		?>
<!DOCTYPE html>
<html>
<head>
<title>Foodshala</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>FoodShala</h2> 
		<form action="signupadmin.php" method="post">
			<div class="imgcontainer">
				<img src="image/food.png" alt="food" class="image">
				 
			</div>
			</center>
			<div class="inner_container">
                <center><h2>Log In</h2></center> 
             <label><b>Username:</b></label><br>
				<input type="text" placeholder="Enter Username" name="username" required><br>
				 <label><b>Password:</b></label><br>
				<input type="password" placeholder="Enter  password" name="password" required><br>
				<input type="submit" value="Submit" name="submit" class="submit_btn"><br>
				 <ul>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Register</a>
			<div class="dropdown-content">
				<a href="admin.php">Admin</a> <a
					href="customer.php">Customer</a> <a
				</li>	 
			</div>  
	</ul>
		 
				 
			</div>
		 </form>
		
		 
		 
	</div>
</body>
</html>