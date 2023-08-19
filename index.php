<?php
  session_start();
  if(isset($_SESSION["userDetails"])){
    header("location:signup.php");
  }
  include("./config.php");
  $emailError=$passwordError="";
  $email = "";
  if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $selectQuery = "SELECT * FROM userdata WHERE customeremail = '$email'" ;
    $result = mysqli_query($config,$selectQuery);
    if(mysqli_num_rows($result)>0){
      $emailAssoc = mysqli_fetch_assoc($result);
      $decryPassword = password_verify($password,$emailAssoc["customerpassword"]);
      if($decryPassword){
        session_start();
        $_SESSION["userDetails"] = ["fname"=>$emailAssoc["customername"],"email"=>$emailAssoc["customeremail"],"address"=>$emailAssoc["customeraddress"],"number"=>$emailAssoc["customernumber"]];
        header("location:./welcome.php");
      }else{
        $passwordError = "Please enter correct password";
      }
    }else{
      $emailError="Please enter correct email";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <div class="container mt-5">
      <h1 style="text-align: center;">LOGIN</h1>
      <form action="./index.php" method="post" name="loginform" onsubmit="return loginfunction()">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control logincontrol" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $email; ?>">
          <div class="loginerror"><?php echo $emailError ?></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control logincontrol" id="exampleInputPassword1" name="password">
          <div class="loginerror"><?php echo $passwordError ?></div>
        </div>
        <button type="submit" class="btn btn-primary" name="login">LOGIN</button>
      </form>
    </div>

    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>