<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>  Registration Form </title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="style2.css">
    

     <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
   </head>
<body>

<?php

include 'dbcon.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string( $con, $_POST['name']);
    $username = mysqli_real_escape_string( $con,$_POST['username']);
    $email = mysqli_real_escape_string( $con,$_POST['email']);
    $mobile = mysqli_real_escape_string( $con,$_POST['mobile']);
    $password = mysqli_real_escape_string( $con,$_POST['password']);
    $cpassword = mysqli_real_escape_string( $con,$_POST['cpassword']);


$pass = password_hash($password, PASSWORD_BCRYPT);
$cpass = password_hash($cpassword, PASSWORD_BCRYPT);

// $escapedUsername = $conn->real_escape_string($username);

    // Prepare the SQL statement
    $sql = "SELECT * FROM users WHERE username = '$username'";

    // Execute the query
    // $result = $con->query($sql);
    $result = mysqli_query($con, $sql);

    // Check if any rows were returned
    if ($result && $result->num_rows > 0) {
        // Username exists in the database
        echo "username already exists";
    } else {
        // Username is not taken
        

$emailquery = " select * from registration where email = '$email' ";
$query = mysqli_query($con, $emailquery);

$emailcount = mysqli_num_rows($query);

      if($emailcount>0){
         echo "email already exists";
      }else{


          if($password===$cpassword){
               $insertquery = "insert into registration( name, username, email, mobile, password, cpassword) values
               ('$name', '$username', '$email', '$mobile', '$pass', '$cpass')";    

               $iquery = mysqli_query($con, $insertquery);
               if($iquery){
                ?>
                   <script>
                     alert("Registered successfully");
                   </script> 
                <?php
             }else{
                 ?>
                   <script>
                      alert("Registration failed ");
                   </script>
                 <?php
               }
              
      }else{
        ?>
        <script>
           alert("Passwords are not matching ");
        </script>
      <?php
            } 
      
         
                }
            }
        }
?>
  <div class="container">
    <div class="title">Sign Up</div>
    <div class="content">
      <form action="#" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details"></span>
            <input name="name" type="text" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input name="username" type="text" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input name="email" type="email" placeholder="Enter your email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$">
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input name="mobile" type="tel" placeholder="Enter your number" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required>
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input name="password"  type="password" placeholder="Enter your password" pattern="[0-9]{7}" required title="Please enter a 7-digit password" required >
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input name="cpassword" type="password" placeholder="Confirm your password" required>
          </div>
        </div>
        <!-- <div class="gender-details">
          <input name="Gender" type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">
          <input type="radio" name="gender" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div> -->
        <div class="button">
          <input type="submit" value="Register" name="submit">
        </div>
        <!-- <h5 style="text-align:center" >Already have an account? <a href="login.php">Log In</a> </h5> -->
       
      </form>
      <div id="create-account-wrap">
    <p>Not a member? <a href="login.php">Log In</a><p>
  </div>
    </div>
  </div>

</body>
</html>