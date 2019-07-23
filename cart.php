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
</body>
</html>
