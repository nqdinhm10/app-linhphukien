<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include '../classes/cart.php' ?>
<?php
    $ct = new cart();


?>
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thống kê doanh thu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày</th>
                            <th>Doanh thu</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $fm = new Format();
						$show_turnover = $ct->show_turnover();
						if($show_turnover){
							$i = 0;
							while($result = $show_turnover->fetch_assoc()){
								$i++;
							
					?>
                        <tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['date_order'] ?></td>
                            <td><?php echo $result['turnover'] ?></td>
							
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

