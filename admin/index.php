<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include '../classes/product.php'?>
<?php include '../classes/cart.php'?>
<?php include '../classes/admin.php'?>
<?php
	$pd = new product();
	$ct = new cart();
	$ad = new admin();
?>

<!-- Begin Page Content -->

<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">Trang chủ</h1>
	</div>
	<div class="row">
	<?php			
	$pdcount = $pd->show_countproduct();
	if($pdcount){
		$i = 0;
		while($result = $pdcount->fetch_assoc()){
			$i++;
	?>
    <div class="col-xl-3 col-md-6 mb-4">
	    <div class="card border-left-primary shadow h-100 py-2">
	        <div class="card-body">
	            <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                    <div class="m-0 font-weight-bold text-primary">
	                        SẢN PHẨM</div>
	                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['countproduct'] ?></div>
	                    <hr>
	                    <a class="m-0 font-weight-bold text-primary" href="productlist.php">Danh sách sản phẩm</a>
	                </div>
	                <div class="col-auto">
	                    <i class="fas fa-microchip fa-2x text-gray-300"></i>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<?php
	    }
	}
	?>
	<?php			
	$ctcount = $ct->show_countorder();
	if($ctcount){
		$i = 0;
		while($result = $ctcount->fetch_assoc()){
			$i++;
	?>
	<div class="col-xl-3 col-md-6 mb-4">
	    <div class="card border-left-success shadow h-100 py-2">
	        <div class="card-body">
	            <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                    <div class="m-0 font-weight-bold text-success">
	                        ĐƠN HÀNG</div>
	                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['countorder'] ?></div>
	                    <hr>
	                    <a class="m-0 font-weight-bold text-success" href="bill.php">Danh sách đơn hàng</a>
	                </div>
	                <div class="col-auto">
	                    <i class="fas fa-receipt fa-2x text-gray-300"></i>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<?php
	    }
	}
	?>

	<?php			
	$ctsum = $ct->show_turnovertotal();
	if($ctsum){
		$i = 0;
		while($result = $ctsum->fetch_assoc()){
			$i++;
	?>
	<div class="col-xl-3 col-md-6 mb-4">
	    <div class="card border-left-danger shadow h-100 py-2">
	        <div class="card-body">
	            <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                    <div class="m-0 font-weight-bold text-danger">
	                        TỔNG DOANH THU</div>
	                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['turnovertotal'] ?></div>
	                    <hr>
	                    <a class="m-0 font-weight-bold text-danger" href="turnover.php">Doanh thu theo ngày</a>
	                </div>
	                <div class="col-auto">
	                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<?php
	    }
	}
	?>

	<?php			
	$adcount = $ad->show_countadmin();
	if($adcount){
		$i = 0;
		while($result = $adcount->fetch_assoc()){
			$i++;
	?>
	<div class="col-xl-3 col-md-6 mb-4">
	    <div class="card border-left-warning shadow h-100 py-2">
	        <div class="card-body">
	            <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                    <div class="m-0 font-weight-bold text-warning">
	                        NGƯỜI DÙNG</div>
	                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['countadmin'] ?></div>
	                    <hr>
	                    <a class="m-0 font-weight-bold text-warning" href="adminlist.php">Danh sách người dùng</a>
	                </div>
	                <div class="col-auto">
	                    <i class="fas fa-users fa-2x text-gray-300"></i>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<?php
	    }
	}
	?>
</div>
</div>

<!-- End of Main Content -->
<?php include 'inc/footer.php'?>            