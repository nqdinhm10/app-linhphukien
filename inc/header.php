<?php
    include 'lib/session.php';
    Session::init();
?>
<?php
	
	include 'lib/database.php';
	include 'helpers/format.php';

	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});
		

	$db = new Database();
	$fm = new Format();
	$ct = new cart();
	$ad = new admin();
	$br = new brand();
	$cat = new category();
	$cs = new customer();
	$product = new product();
		
	      	 	
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Shop linh - phụ kiện NQD</title>
<meta http-equiv="charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">   
<script src="bootstrap/js/bootstrap.min.js"> </script>
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png"/></a>
			</div>
			  <div class="header_top_right">                        
			    <div class="shopping_cart">
					
						<a href="cart.php" title="Đi đến giỏ hàng">
							<i class="fas fa-shopping-cart fa-fw"></i>
							<span class="no_product">
								<sup>
									
									<?php
									$check_cart = $ct->check_cart();
										if($check_cart){
											
											$qty = Session::get("qty");
											echo $fm->format_currency($qty);
											}else{
											echo '0';
										}

									?>
								</sup>
							</span>
							<span class="cart_title">&nbsp; Giỏ hàng</span>
								
						</a>
						
			      </div>
			<?php 
				if(isset($_GET['customer_id'])){
					$customer_id = $_GET['customer_id'];
					$delCart = $ct->del_all_data_cart();
					$delCompare = $ct->del_compare($customer_id);
					Session::destroy();
				}
			?>
		   	
		   	
			<?php
			$login_check = Session::get('customer_login'); 
			if($login_check==false){
				echo '<a href="login.php"><i class="fas fa-user fa-fw"></i> Đăng nhập</a></div>';
			}else{
				echo '<a href="?customer_id='.Session::get('customer_id').'"><i class="fas fa-user fa-fw"></i> Đăng xuất</a></div>';
			}
			?>

		   
		 <div class="clear"></div>
	 
	 <div class="clear"></div>
 </div>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-secondary">
  <div class="container-fluid">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Trang chủ |</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Danh mục sản phẩm
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
	        	$cate = $cat->show_category();
	        	if($cate){
	      			while($result_new = $cate->fetch_assoc()){

	      		?>
	        	
	          <li>

	          	<a class="dropdown-item" href="productbycat.php?catid=<?php echo $result_new['catId'] ?>"><?php echo $result_new['catName'] ?></a>
	          </li>
	          <?php
	          	}
	          } 
	          ?>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Thương hiệu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
	        	$brand = $br->show_brand_home();
	        	if($brand){
	      			while($result_new = $brand->fetch_assoc()){

	      		?>
	        	
	          <li>

	          	<a class="dropdown-item" href="topbrands.php?brandid=<?php echo $result_new['brandId'] ?>"><?php echo $result_new['brandName'] ?></a>
	          </li>
	          <?php
	          	}
	          } 
	          ?>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="cart.php">Giỏ hàng |</a>
        </li>

        <?php
			$login_check = Session::get('customer_login'); 
			if($login_check==false){
				echo '';
			}else{
				echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="profile.php">Tài khoản |</a> </li>';
			}
			 ?>
			<?php
		
				$login_check = Session::get('customer_login'); 
				if($login_check){
					echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="compare.php">So sánh |</a> </li>';
				}
					
			?>
			<?php
		
				$login_check = Session::get('customer_login'); 
				if($login_check){
					echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="wishlist.php">Yêu thích</a> </li>';
				}
					
			?>

        <!-- <li class="nav-item">
          <a class="nav-link" aria-current="page" href="contact.php">Liên hệ</a>
        </li> -->
      </ul>
      <form class="d-flex" action="search.php" method="post">
        <input class="form-control me-2" type="text" placeholder="Tìm kiếm..." aria-label="Search" name="tukhoa">
        <button class="btn btn-outline-info" type="submit" name="search_product">Tìm kiếm</button>
      </form>
    </div>
  </div>
</nav>