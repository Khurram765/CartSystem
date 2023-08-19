<?php
    if(isset($_POST["signup"])){
        $name = filter_var($_POST["name"],FILTER_SANITIZE_STRING);
        if($name==""){
            echo "<script>alert('Invalid Name');window.location.href='./signup.php'</script>";
            die();
        }
        $email = $_POST["email"];
        $match = (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email));
        if($match==true){
            echo "<script>alert('Invalid Email');window.location.href='./signup.php'</script>";
            die();
        }
        $password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
        if($password==""){
            echo "<script>alert('Invalid Password');window.location.href='./signup.php'</script>";
            die();
        }
        $encrypassword = password_hash($password,PASSWORD_DEFAULT);
        $address = filter_var($_POST["address"],FILTER_SANITIZE_STRING);
        if($address==""){
            echo "<script>alert('Invalid Address');window.location.href='./signup.php'</script>";
            die();
        }
        $number = $_POST["number"];
        echo $name.$email.$encrypassword.$address.$number;
    }

?>