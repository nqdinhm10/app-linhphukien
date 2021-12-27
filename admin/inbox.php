<?php include 'inc/sidebar.php';?>
<?php include 'inc/header.php';?>

<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/cart.php');
include_once ($filepath.'/../helpers/format.php');

?>
<?php
	$ct = new cart();
	if(isset($_GET['shiftid'])){
     	$id = $_GET['shiftid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$shifted = $ct->shifted($id,$time,$price);
    }

    if(isset($_GET['delid'])){
     	$id = $_GET['delid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$del_shifted = $ct->del_shifted($id,$time,$price);
    }
?>

        <div class="container-fluid">
            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
        </div>
                <div class="card-body">
            <div class="table-responsive">
                <?php 
                if(isset($shifted)){
                	echo $shifted;
                }

                ?>  
                <?php 
                if(isset($del_shifted)){
                	echo $del_shifted;
                }
                
                ?>        
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>STT</th>
							<th>Thời gian đặt</th>
							<th>Sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>Mã khách hàng</th>
							<th>Địa chỉ</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$ct = new cart();
						$fm = new Format();
						$get_inbox_cart = $ct->get_inbox_cart();
						if($get_inbox_cart){
							$i = 0;
							while($result = $get_inbox_cart->fetch_assoc()){
								$i++;
						 ?>
						
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_order']) ?></td>
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price'].' '.'VNĐ' ?></td>
							<td><?php echo $result['customer_id'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Chi tiết</a></td>
							
						</tr>
						<?php
					}}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>
