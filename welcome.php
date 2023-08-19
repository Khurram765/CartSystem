<?php
    session_start();
    if(isset($_SESSION["userDetails"])){
        $fname = $_SESSION["userDetails"]["fname"];
    }else{
      header("location:signup.php");
    }

    if(isset($_POST["logout"])){
      session_unset();
      session_destroy();
      header("location:signup.php");
    }
    include("./config.php");
    $error = "";
    if(isset($_POST["productid"])){
      $productid = $_POST["pid"];
      $selectQuery = "SELECT * FROM products WHERE productid = $productid";
      $selectQueryResult = mysqli_query($config,$selectQuery);
      $selectAssoc = mysqli_fetch_assoc($selectQueryResult);
      $merge = ["productid"=>intval($selectAssoc["productid"]),"productname"=>$selectAssoc["productname"],"productdescr"=>$selectAssoc["productdescr"],"productprice"=>intval($selectAssoc["productPrice"]),"productimage"=>$selectAssoc["productimage"]];
      if(isset($_SESSION["productDetails"])){
        $bool = false;
        foreach($_SESSION["productDetails"] as $data){
          if($data["productid"]==$merge["productid"]){
            $error = "This item is already in your cart";
            $bool = true;
            break;
          }
           
        }
        if(!$bool){
          array_push($_SESSION["productDetails"],$merge);
        }

      }else{
       $_SESSION["productDetails"] = [$merge];
      }
 
     }


    if(isset($_POST["deletecart"])){
      unset($_SESSION["productDetails"]);
    }
    
    
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  

  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./welcome.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./cart.php">Cart <span class="badge bg-secondary"><?php if(isset($_SESSION["productDetails"])){
              echo count($_SESSION["productDetails"]);
            }else{
              echo 0;
            }  ?></span></a>
          </li>
        </ul>
        <div class="userInfo d-flex justify-content-around">
          <h4>User :
            <?php echo $fname; ?>
          </h4>
          <form action="./welcome.php" method="post">
            <button class="btn btn-primary" type="submit" name="logout">LOGOUT</button>
          </form>
          <form class="mx-2" action="./welcome.php" method="post">
            <button class="btn btn-primary" name="deletecart" type="submit">Empty Cart</button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div class="alert alert-danger mt-3"><?php echo $error; ?></div>

  <!-- PRODUCTS -->
  <div class="container mt-5">
    <div class="row">
    <?php 
      include("./config.php");
      $selectQuery = "SELECT * FROM products";
      $selectQueryResult = mysqli_query($config,$selectQuery);
      if(mysqli_num_rows($selectQueryResult)>0){
        while($products = mysqli_fetch_assoc($selectQueryResult)){
          
        
    ?>
      <div class="col-md-4 col-sm-6">
        <div class="card">
          <img style="height:200px; width:100%;" src="<?php echo $products['productimage']; ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $products['productname']; ?></h5>
            <p class="card-text"><?php echo $products['productPrice']; ?></p>
            <p class="card-text-two"><?php echo $products['productdescr'] ?></p>
            <form action="./welcome.php" method="post">
              <input type="number" name="pid" id="" value=<?php echo $products["productid"]; ?> hidden>
              <button class="btn btn-primary" type="submit" name="productid">Add to Cart</button>
            </form>
          </div>
        </div>
      </div>
      
      <?php };
        
      }?>  

      </div>
    </div>
  </div>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>