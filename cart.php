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

    if(isset($_POST["deleteitem"])){
      $productid = intval($_POST["pid"]);
      $index = -1;
      if(isset($_SESSION["productDetails"])){
        foreach($_SESSION["productDetails"] as $data){
          $index = ++$index;
          if($productid === $data["productid"]){
            array_splice($_SESSION["productDetails"], $index, 1);
            break;
          }
        }
        if($_SESSION["productDetails"]==null){
          unset($_SESSION["productDetails"]);
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

  <div class="container mt-3">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
        if(isset($_SESSION["productDetails"])) {
        foreach($_SESSION["productDetails"] as $data){
        
    ?>
    <tr>
      <td><img style="height:100px;width:200px;" class="cartimage" src="<?php echo $data["productimage"] ?>" alt="" srcset=""></td>
      <td><?php echo $data["productname"] ?></td>
      <td><input type="number" value=1 class="quantity"></td>
      <td><?php echo $data["productprice"] ?></td>
      <td>
        <form action="./cart.php" method="post">
            <input type="number" name="pid" id="" value="<?php echo $data["productid"] ?>" hidden>
            <button class="btn btn-primary" type="submit" name="deleteitem">Delete</button>
        </form>
      </td>
    </tr>
    <?php }}?>
  </tbody>
</table>
  </div>

  <script src="./js/index.js"></script>
  <script>
    let quantity = document.querySelectorAll(".quantity");
Array.from(quantity).forEach(q=>{
    q.addEventListener("change",()=>{
        if(q.value<1){
            q.value = 1
        }
    })
})

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>