  <?php
     session_start();
 $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
 
        $con = mysqli_connect('localhost','root','root','food');

if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die("Database connection failed");
   }
     
   

?>
 <?php
//   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>
  
  <?php
			 if(isset($_POST['submit']))
			{
				 $username=$_POST['username'];
  
				 $password=$_POST['password'];
                  $dbname = $_POST["myDB"];
                  
				$query = "SELECT * FROM customer WHERE username='$username' and password='$password'";
				 
                     
				 
                 $pwFromDb="select password from customer";
                 $query_run = mysqli_query($con,$password,$dbname);
				if($pwFromDb=$password)
				{
				  while($row=mysqli_fetch_assoc($query_run)){
                     $pwFromDb=$row['password'];
                 }
				 
                   
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $pwFromDb;
					
					header( "Location:Menu.php");
                }
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Database Error")</script>';
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
		<form action="signup.php" method="post">
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