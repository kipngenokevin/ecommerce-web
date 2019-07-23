<?php
session_start();
require_once 'connect.php';
 $sql = "SELECT*FROM products WHERE Featured=1";
 $result = $db->query($sql);
 if(isset($_POST["add_to_cart"]))
 {
  if(isset($_SESSION["shopping_cart"]))
  {
      $_item_array_id = array_column($_SESSION["shopping_cart"],"item_id");
      if(!in_array($_GET["id"], $_item_array_id))
      {
        $count =count($_SESSION["shopping_cart"]);
        $item_array = array(
          'item_id' => $_GET["id"],
          'item_name' => $_POST["hidden_name"],
          'item_price' => $_POST["hidden_price"],
          'item_quantity' => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][$count] = $item_array;
      }
      else
      {
        echo '<script>alert("Item Already Added") </script>';
        echo '<script>window.location="index.php"</script>';
      }
  }
  else {
    $item_array= array(
       'item_id' => $_GET["id"],
       'item_name' => $_POST["hidden_name"],
       'item_price' => $_POST["hidden_price"],
       'item_quantity' => $_POST["quantity"]
    );
    $_SESSION["shopping_cart"][0]= $item_array;
  }
 }
 if(isset($_GET["action"]))
 {
   if($_GET["action"] == "delete")
   {
     foreach($_SESSION["shopping_cart"] as $keys => $values)
     {
       if($values["item_id"] == $_GET["id"])
       {
         unset($_SESSION["shopping_cart"]["$keys"]);
         echo '<script>alert("Item Removed")</script>';
         echo '<script>window.location="index.php"</script>';
       }
     }
   }
 }

  ?>

<!DOCTYPE html>
<html>
<head>
  <title>Victoria's Carpet</title>

  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/main.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>

<body>
  <div class="top">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Victora Carpets</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">Contact Us</a>
        </li>
      </ul>

    </div>
    <!-- Searchbar -->
    <div class="searchbar">
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  </nav>
</div>


  <!--Items for Sale-->
  <div class="home">
    <div class="padding">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
          </div>

              <div class="col-md-6">

            <h4 style="color:white;"> New Arrival</h4>

            <button type="button" class="btn btn-warning">Add To Cart </button>

          </div>
        </div>
      </div>
      </div>
     </div><!--Home Content-->
<div class=" col-sm-3 text-center"><h4>Featured Products</h4></div>
<!-- Add Badge This will givw users the different ratings of the products -->
<!-- Make a checkout php page which contains the items added to cart -->
<!--When its done we shall rejoice in the Lord -->
<!-- It shall be a very well done website better than any other web ever made in Jesus name -->
<!--Amen -->
<!-- php items-->
<?php

  ?>
<!-- Featured Items-->
<div class="padding">
<div class="container">
<div class="row">
<?php
while ($row = mysqli_fetch_array($result)) {
  ?>

<div class="col-sm-3 card ">
<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
  <h4><?php echo $row['title']; ?></h4>
  <div class="card-body">
  <img src="<?php echo $row['image']; ?>" alt="cake" height="300" width="100%">
</div>
  <div class="card-footer">
  <h6>Item Price: $ <?php echo $row['price']; ?></h6>
  <h6>List Price : $ <?php echo $row['list_price']; ?></h6>
  <div class="container">
    <div class="row">

  <div class="col-sm-12">

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $row['id']; ?>">
View Item
 </button>
 <input type="hidden" name="hidden_name" value="<?php echo $row["title"];?>"/>
 <input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>"/>
 <input type="hidden" class="form-control" id="quantity" name="quantity" value="1"/>
<button type="submit" name="add_to_cart" class="btn btn-warning" >Add <img class="img-responsive"src="svg/cart.svg" alt="cart" height="20" width="20"/></button>
</div>
</div>
</div>
</div>
</div>
</form>
<!--Modal-->
<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
<div class="modal fade"  id="<?php echo $row["id"]; ?>" tableindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!--modal header section -->
    <div class="modal-header">
      <!--Title of Item-->
      <h4 class="modal-title text-center"><?php echo $row['title']; ?></h4>
      <!--top close button -->
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <!--End of modal header section -->

      <!-- start of modal body section -->
    <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <div class="center-block">
              <!--Image of the item-->
              <img class="details img-responsive" src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" height="300" width="100%"/>
               </div>
                 </div>
                  <div class="col-sm-6">
                   <h4> Details </h4>
                   <!--Description of the item -->
                   <p> <?php echo $row['description']; ?></p>
                   <!-- Price of the item  -->
                    <p> Pric : <?php echo $row['price']; ?> </p>
                    <!-- Quantity and Size forms-->
                    <form>
                    <div class="form-group">
                    <div class="col-xs-3">
                      <!--Quantity input-->
                    <label for="quantity" id="quantity-label">Quantity:</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="1"/>
                    <input type="hidden" name="hidden_name" value="<?php echo $row["title"];?>"/>
                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>"/>
                    </div>
                    <div class="form-group">
                      <!-- Size which has a dropdown-->
                    <label for="size">Size </label>
                    <select name="size" id="size" class="form-control">
                    <option value=""></option>
                    <option value="28">28</option>
                    <option value="30">30</option>
                    <option value="32">32</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Footer Section -->
      <div class="modal-footer">
        <!--Close button at the footer section-->
       <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
       <!--Add to cart button at the footer section-->
       <button  type="submit" name="add_to_cart"  class="btn btn-warning" value="Add To Cart"><img class="img-responsive"src="svg/cart.svg" alt="cart" height="40" width="40"/>Add To Cart</button>
      </div>
      <!-- End of Modal footer-->
  </div>
 </div>
</div>
<!--End of Modal-->
  <?php
}

 ?>
</form>
</div>
</div>
</div>


<!--Add Item to checkout-->
<h3>Cart Checkout</h3>
<div class="table_responsive">
<table class="table table-bordered">
  <tr>
    <th width="40%">Item Name</th>
    <th width="10%">Quantity</th>
    <th width="20%">Price</th>
    <th width="10%">Total</th>
    <th width="5%">Action</th>
  </tr>
  <?php
  if(!empty($_SESSION["shopping_cart"]))
  {
    $total=0;
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      ?>
      <tr>
        <td><?php echo $values["item_name"];?></td>
        <td><?php echo $values["item_quantity"];?></td>
        <td><?php echo $values["item_price"];?></td>
        <td><?php echo number_format($values["item_quantity"]*$values["item_price"],2);?></td>
        <td><a href="index.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="text_danger">Remove</span></a></td>
      </tr>
      <?php
      $total = $total + ($values["item_quantity"]*$values["item_price"]);
    }

     ?>
     <tr>
       <td colspan="3" align="right">Total</td>
       <td align="right">$ <?php echo number_format($total,2); ?>
         <td></td>
     </tr>
     <?php
  }

  ?>
</table>
</div>

<!-- Footer -->
<footer class="container-fluid text-center">
  <div class="row">
    <div class="col-sm-3">
      <h3> Contact Us</h3>
     <br>
     <h4> Our contact and address info here </h4>
    </div>
    <div class="col-sm-3">
      <a href="https://www.facebook.com/kipngeno.nivek"target="_blank" class="fa fa-facebook"></a>
      <a href="#" target="_blank" class="fa fa-twitter"></a>
      <a href="#" target="_blank" class="fa fa-instagram"></a>
      <a href="#" target="_blank" class="fa fa-linkedin"></a>
      <a href="cart.php">Checkout</a>
    </div>
    <div class="col-sm-3">
    </div>
  </div>
</footer>



<!-- Details Module -->
<?php
       include 'details-modal.php';
       
        ?>

</body>
</html>
