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
     	
     	$shifted = $ct->shifted($id,$time);
    }

    if(isset($_GET['delid'])){
     	$id = $_GET['delid'];
     	$time = $_GET['time'];
     	
     	$del_shifted = $ct->del_shifted($id,$time);
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
							<th>Mã bill</th>
							<th>Thời gian đặt</th>
							<th>Mã khách hàng</th>
							<th>Chi tiết</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$ct = new cart();
						$fm = new Format();
						$getbill = $ct->getbill();
						if($getbill){
							$i = 0;
							while($result = $getbill->fetch_assoc()){
								$i++;
						 ?>
						
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['id'] ?></td>
							<td><?php echo $fm->formatDate($result['date_order']) ?></td>
							<td><?php echo $result['customer_id'] ?></td>
							
							<td><a href="billdetail.php?billid=<?php echo $result['id'] ?>">Chi tiết</a></td>
							<td>
							<?php 
							if($result['status']==0){
							?>

								<a onclick="return confirm('Xác nhận đang giao hàng?')" href="?shiftid=<?php echo $result['id'] ?>&time=<?php echo $result['date_order'] ?>">Đang chờ</a>

								<?php
							
							}
							elseif($result['status']==1){
								?>
								<?php
								echo 'Shifting...';
								?>
							<?php
							}elseif($result['status']==2){
							?>

							<a onclick="return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['id'] ?>&time=<?php echo $result['date_order'] ?>">Xóa đơn</a>

							<?php
								}
							
							?>
							</td>
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
