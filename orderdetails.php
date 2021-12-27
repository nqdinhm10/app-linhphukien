<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
 <?php
 	$login_check = Session::get('customer_login'); 
	if($login_check==false){
		header('Location:login.php');
	}
	
	
?> 
<?php
	if(isset($_GET['confirmid'])){
     	$id = $_GET['confirmid'];
     	$time = $_GET['time'];
     	$shifted_confirm = $ct->shifted_confirm($id,$time);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Details Ordered</h2>			    	
			    	
						<table class="tblone">
							<tr>
								<th width="10%">ID</th>
								<th width="10%">Mã đơn</th>
								<th width="20%">Ngày đặt</th>
								<th width="10%">Trạng thái</th>
								<th width="15%">Xác nhận</th>
								<th width="15%">Chi tiết</th>
								
							</tr>
							<?php
							$customer_id = Session::get('customer_id');
							$get_cart_ordered = $ct->get_cart_ordered($customer_id);
							if($get_cart_ordered){
								$i = 0;
								$qty = 0;
								$total = 0;
								while($result = $get_cart_ordered->fetch_assoc()){
									$i++;
									
							?>
							<tr>
								
								<td><?php echo $i; ?></td>
								<td><?php echo $result['id'] ?></td>
								<td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td>
									<?php
									if($result['status']=='0'){
										echo 'Đang chờ';
									}elseif($result['status']==1){ 
									?>
									<span>Đang giao</span>
									
									<?php
									}elseif($result['status']==2){
										echo 'Đã nhận';
									}

									 ?>


								</td>
								<?php
								if($result['status']=='0'){
								?>
								<td><?php echo 'N/A';?></td>
								<?php
								
								}elseif($result['status']=='1'){
								
								?>
								<td><a onclick="return confirm('Xác nhận đã nhận được hàng')" href="?confirmid=<?php echo $customer_id ?>&time=<?php echo $result['date_order'] ?>">Xác nhận</a></td>
								<?php
							}else{
								?>
								<td><?php echo 'Đã nhận'; ?></td>
								<?php
								}	
								?>
								<td><a href="orderdetailsdetail.php?billid=<?php echo $result['id'] ?>">Chi tiết</a></td>
							</tr>
						<?php
							
							}
						}
						?>
							
						</table>
						
						
					 
					
					
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php 
	include 'inc/footer.php';
	
 ?>