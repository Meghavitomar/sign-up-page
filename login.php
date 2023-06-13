<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>HTML5 Login Form </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="style1.css">

</head>
<body >

<?php


include 'dbcon.php';

if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

   $email_search = "select * from registration where email = '$email' ";
   $query = mysqli_query($con, $email_search);

   $email_count = mysqli_num_rows($query);

   if($email_count){
    $email_pass = mysqli_fetch_assoc($query);
    $db_pass = $email_pass['password'];
    $pass_decode = password_verify($password, $db_pass);

    if($pass_decode){
        ?>
                   <script>
                      alert("Login successful ");
                   </script>
                 <?php
    }
    else{
        ?>
                   <script>
                      alert("password incorrect ");
                   </script>
                 <?php
    }
   }else{
    ?>
                   <script>
                      alert("Invalid Email ");
                   </script>
                 <?php
   }
}


?>

  <div class="container">
    <div class="title">Log In</div>
     <div class="content">
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?> " method="POST">
      <div class="user-details">
          <div class="input-box">
            <span class="details"></span>
            <input name="email" type="email" placeholder="Enter your email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$">
          </div>
    </div>     
    <div class="user-details">
          <div class="input-box">
            <span class="details"></span>
            <input name="password"  type="password" placeholder="Enter your password"  required >
          </div>
    </div>     
    <div class="button"  style="justify-content=center";>
          <input type="submit" value="LogIn Now " name="submit">
    </div>


   
  </form>
  <div id="create-account-wrap">
    <p>Not a member? <a href="signup.php">Sign up here</a><p>
  </div> 
</div>
</div>
  
</body>
</html>
