<nav class="navbar navbar-default">
  <div class="container-fluid">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>


    <div class="collapse navbar-collapse" id="myNavbar">
    
        <ul class="nav navbar-nav" style="display: inline-block;">
          <li>
         	<a href="index.php" style="padding: 0px;">
          		<img src="hf_images/iconss/HomeLogo.png" id="icon" class="" >
          		<!--label id="homeText">Home Furnitures</label-->
          	</a>
        </ul>

        <?php if(isset($_SESSION["userID"])){ ?>

          <?php 
          //COUNT CART ITEMS
          include("CRUD/cart_view.php");
          $cartItems = 0;

          while($row = mysqli_fetch_array($query))
          {
            $cartItems = $cartItems + $row["qty"];
          }

          if($cartItems == 0)
          {
            $cartItems = "";
          }
          else
          {
            $cartItems = "(".$cartItems.")";
          }
          ?>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> MY CART 
            <span id="countCartItems"><?php echo $cartItems?></span></a></li>
              <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user"></span> <?php echo strtoupper($_SESSION["fullname"]) ?></a>
              <span class="caret"></span></button>
              
              <ul class="dropdown-menu">
                <li><a href="buyer_orders_index.php">My Orders</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modalUpdateUserInfo" id="updateUserInfo">Update Info</a></li>
                <li><a href="logout.php">Sign Out</a></li>
              </ul>
            </li>
          </ul>


      <?php } else { ?>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" data-toggle="modal" data-target="#modalVendor"><span class="glyphicon glyphicon-thumbs-up"></span> Sell with Us</a></li>
            <li><a href="#" data-toggle="modal" data-target="#modalSignUp"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#" data-toggle="modal" data-target="#modalSignIn"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
          </ul>

      <?php } ?>
    </div> <!--COLLAPSE DIV CLOSE-->
  </div> <!--CONTAINER FLUID CLOSE-->
</nav>

<script>
  
  $(document).ready(function(){

    $('#updateUserInfo').on("click" , function (){

      var userID = "<?php echo $_SESSION['userID'] ?>";

      $.ajax({

        url: "AJAX/get_user_info.php",
        type: "post",
        data: { userID:userID },
        dataType: "json",
        success: function(res){

          $('#updateInfoFirstname').val(res["user_firstname"]);
          $('#updateInfoLastname').val(res["user_lastname"]);
          $('#updateInfoEmail').val(res["user_email"]);
          $('#updateInfoMobile').val(res["user_mobile"]);
          $('#updateInfoAddress').val(res["user_address"]);
          $('#updateInfoUsername').val(res["username"]);
          $('#updateInfoPassword1').val(res["password"]);
        }
      });

    });// EOF AJAX

  });// EOF DOC READY

</script>