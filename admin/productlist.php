<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include '../classes/brand.php'?>
<?php include '../classes/category.php'?>
<?php include '../classes/product.php'?>
<?php include_once '../helpers/format.php'?>
<?php
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['productid'])){
        $id = $_GET['productid']; 
        $delpro = $pd->del_product($id);
    }
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
							<th>Tên sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>Hình ảnh</th>
							<th>Danh mục</th>
							<th>Thương hiệu</th>
							<th>Mô tả</th>
							<th>Loại</th>
							<th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
	                    <?php
				
						$pdlist = $pd->show_product();
						if($pdlist){
							$i = 0;
							while($result = $pdlist->fetch_assoc()){
								$i++;
						?>
                        <tr class="odd gradeX">
							<td><?php echo $result['productId'] ?></td>
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['productQuantity'] ?></td>
							<td><?php echo $result['price'] ?></td>
							<td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
							<td><?php echo $result['catName'] ?></td>
							<td><?php echo $result['brandName'] ?></td>
							<td><?php 

							echo $fm->textShorten($result['product_desc'], 20);

							?></td>
							<td><?php 
								if($result['type']==0){
									echo 'Feathered';
								}else{
									echo 'Non-Feathered';
								}

								?>									
							</td>
							
							<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> || <a onclick="return confirm('Bạn có muốn xóa?')" href="?productid=<?php echo $result['productId'] ?>">Xóa</a></td>
						</tr>
                        <?php
                    }
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'?>
