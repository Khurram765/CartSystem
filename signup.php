  <?php
    session_start();
    if(isset($_SESSION["userDetails"])){
      header("location:welcome.php");
    }
        
    include("./config.php");
    $errorn=$errorE=$errorP=$errorA=$errorN= "";
    $name=$email=$password=$address=$number="";
    if(isset($_POST["signup"])){
        $name = filter_var($_POST["name"],FILTER_SANITIZE_STRING);
        if($name==""){
          $errorn = "Please enter valid name";
        }
        $email = $_POST["email"];
        
        $password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
        if($password==""){
          $errorP = "Please enter valid Password";
        }
        $encrypassword = password_hash($password,PASSWORD_DEFAULT);
        $address = filter_var($_POST["address"],FILTER_SANITIZE_STRING);
        if($address==""){
          $errorA = "Please enter valid address";
        }
        $number = $_POST["number"];
        if($name!="" && $password!="" && $address!=""){
          $selectQuery = "SELECT * FROM userdata WHERE customeremail = '$email'";
          $sqResult = mysqli_query($config,$selectQuery);
          $sqAssoc = mysqli_fetch_assoc($sqResult);
          var_dump($sqAssoc) ;
          if($sqAssoc==null){
            $insertQuery = "INSERT INTO `userdata`(`customername`, `customeremail`, `customerpassword`, `customeraddress`, `customernumber`) VALUES ('$name','$email','$encrypassword','$address',$number)";
            $iqResult = mysqli_query($config,$insertQuery) or die("Query Failed");
            if($iqResult){
              session_start();
              $_SESSION["userDetails"] = ["fname"=>$name,"email"=>$email,"address"=>$address,"number"=>$number];
              header("location:welcome.php");
            }
          }else{
            echo "this email already exist";
          }
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
      <h1 style="text-align: center;">SIGNUP</h1>
      <form action="./signup.php" method="post" name="myForm" onsubmit="return myFunction()">
        <div class="mb-3">
          <label for="customername" class="form-label">Name</label>
          <input type="text" class="form-control signupcontrol" id="customername" aria-describedby="emailHelp" name="name" value="<?php echo $name; ?>">
          <div class="error" id="namee" style="color: red; height: 24px;"><?php 
            echo $errorn;
          ?></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control signupcontrol" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $email; ?>">
          <div class="error" id="emaile" style="color: red; height: 24px;"><?php echo $errorE; ?></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control signupcontrol" id="exampleInputPassword1" name="password" value="<?php echo $password; ?>">
          <div class="error" id="passworde" style="color: red; height: 24px;"><?php 
            echo $errorP;
          ?>
        </div>
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input type="text" class="form-control signupcontrol" id="address" aria-describedby="emailHelp" name="address" value="<?php echo $address; ?>">
          <div class="error" id="addresse" style="color: red; height: 24px;">
          <?php 
            echo $errorA;
          ?></div>
        </div>
        <div class="mb-3">
          <label for="phonenumber" class="form-label">Phone Number</label>
          <input type="number" class="form-control signupcontrol" id="phonenumber" aria-describedby="emailHelp" name="number" value="<?php echo $number; ?>">
          <div class="error" id="numbere" style="color: red; height: 24px;"><?php echo $errorN; ?></div>
        </div>
        <button type="submit" class="btn btn-primary" name="signup">SIGNUP</button>
      </form>
      <p class="mt-3">If you dont have any account then <a style="color:blue;" href="./index.php">Login here</a></p>
    </div>


    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>