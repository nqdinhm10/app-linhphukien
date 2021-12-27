<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php
    if(Session::get('level')==0 || Session::get('level')==1){
?>
<?php include '../classes/admin.php'?>
<?php
    $admin = new admin();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $deladmin = $admin->del_admin($id);
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Tài khoản</th>
                            <th>Quyền</th>
                            <th>Ảnh đại diện</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						$show_admin = $admin->show_admin();
						if($show_admin){
							$i = 0;
							while($result = $show_admin->fetch_assoc()){
								$i++;
							
					?>
                        <tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['adminName'] ?></td>
                            <td><?php echo $result['adminEmail'] ?></td>
                            <td><?php echo $result['adminPhone'] ?></td>
                            <td><?php echo $result['adminUser'] ?></td>
                            <td><?php 
                                if($result['level']==0){
                                    echo 'Admin';
                                }elseif($result['level']==1){
                                    echo 'Quản lý';
                                }else{
                                    echo 'Nhân viên';
                                }

                                ?>                                  
                            </td>
                            <td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
                            <td><?php 
                                if($result['status']==0){
                                    echo 'Khả dụng';  
                                }else{
                                    echo 'Đang khóa';
                                }

                                ?>                                  
                            </td>
                            <?php
                                if(Session::get('level')==1 && ($result['level']==0 || $result['level']==1)){
                            ?>
				                        <td></td>
                            <?php
                                }elseif(Session::get('level')==1 && $result['level']==2){
                            ?>
                                        <td><a href="adminedit.php?adminid=<?php echo $result['adminId'] ?>">Sửa</a> || <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['adminId'] ?>">Xóa</a> || <a href="passrestore.php?adminid=<?php echo $result['adminId'] ?>">Cấp lại mật khẩu</a></td>
                            <?php
                                    }elseif(Session::get('level')==0 && $result['level']==0){                                     
                            ?>
                                        <td><a href="adminedit.php?adminid=<?php echo $result['adminId'] ?>">Sửa</a></td>
                            <?php
                                        }elseif(Session::get('level')==0 && $result['level']==1 || $result['level']==2){
     
                            ?>
                                            <td><a href="adminedit.php?adminid=<?php echo $result['adminId'] ?>">Sửa</a> || <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['adminId'] ?>">Xóa</a> || <a href="passrestore.php?adminid=<?php echo $result['adminId'] ?>">Cấp lại mật khẩu</a></td>
                            <?php
                                        }
     
                            ?>
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

<?php 
    }else{ 
?>
    <h4>Bạn không đủ quyền hạn!</h4>
<?php
    }
?>
<?php include 'inc/footer.php'?>