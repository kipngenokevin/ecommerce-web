
<div class="modal fade"  id="detailss" tableindex="-1" role="dialog" aria-labelledby="<?= $product['id']; ?>" aria-hidden="true">
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
    <div class="modal-body" id="item_detail">
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
                    <form action="add_cart.php" method="post">
                    <div class="form-group">
                    <div class="col-xs-3">
                      <!--Quantity input-->
                    <label for="quantity" id="quantity-label">Quantity:</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"/>
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
       <button class="btn btn-warning" type="submit">  <img class="img-responsive"src="svg/cart.svg" alt="cart" height="40" width="40"/>Add To Cart </button>
      </div>
      <!-- End of Modal footer-->
  </div>
 </div>
</div>
