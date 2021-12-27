<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include '../classes/admin.php' ?>
<?php
    $ad = new admin();
    if(!isset($_GET['adminid']) || $_GET['adminid']==NULL){
       echo "<script>window.location ='adminlist.php'</script>";
    }else{
         $id = $_GET['adminid']; 
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        if(Session::get('level')==2){
            $updateAdmin = $ad->update_nhanvien($_POST,$_FILES, $id);
        }else{
            $updateAdmin = $ad->update_admin($_POST,$_FILES, $id);
        }   
    }
?>
<div class="container-fluid">
    <div class="box round first grid">
        <h2>Sửa thông tin</h2>
        <div >    
         <?php

                if(isset($updateAdmin)){
                    echo $updateAdmin;
                }

            ?>        
        <?php
         $get_admin_by_id = $ad->getadminbyId($id);
            if($get_admin_by_id){
                while($result_admin = $get_admin_by_id->fetch_assoc()){
        ?>     
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">   
                <tr>
                    <td>
                        <label>Họ tên</label>
                    </td>
                    <td>
                        <input type="text"  name="adminName" value="<?php echo  $result_admin['adminName']?>" class="mini"/>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" value="<?php echo $result_admin['adminEmail'] ?>" name="adminEmail" class="mini"/>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Số điện thoại</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result_admin['adminPhone'] ?>" name="adminPhone" class="mini"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Tài khoản</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result_admin['adminUser'] ?>" name="adminUser" class="mini" disabled/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Quyền</label>
                    </td>
                    <?php 
                        if(Session::get('level')==0){
                    ?>
                    <td>
                        <select id="select" name="level">
                            <option>---Chọn---</option>
                            <?php
                            if($result_admin['level']==0){
                            ?>
                            <option selected value="0">Admin</option>
                            <option value="1">Quản lý</option>
                            <option value="2">Nhân viên</option>
                            <?php
                        }elseif($result_admin['level']==1){
                            ?>
                                <option selected value="1">Quản lý</option>
                                <option value="2">Nhân viên</option>
                            <?php
                            }else{
                            ?>
                                <option value="1">Quản lý</option>
                                <option selected value="2">Nhân viên</option>

                            <?php
                                }
                            ?>
                        </select>
                    </td>
                    <?php 
                        }
                    ?>

                    <?php 
                        if(Session::get('level')==1){
                    ?>
                    <td>
                        <select id="select" name="level">
                            <option>---Chọn---</option>
                            <?php
                            if($result_admin['level']==1){
                            ?>
                                <option selected value="1">Quản lý</option>
                                <option value="2">Nhân viên</option>
                            <?php
                            }else{
                            ?>
                                <option value="1">Quản lý</option>
                                <option selected value="2">Nhân viên</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <?php 
                        }
                    ?>

                    <?php 
                        if(Session::get('level')==2){
                    ?>
                    <td>
                        <input type="text" value="Nhân viên" name="level" class="medium" disabled/>
                    </td>
                    <?php 
                        }
                    ?>
                          
                </tr>

                <tr>
                    <td>
                        <label>Ảnh đại diện</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_admin['image'] ?>" width="150"><br><br>
                        <input type="file" name="image" />
                    </td>
                </tr>

                <?php
                if(Session::get('level')!=2){
                ?>
                <tr>
                    <td>
                        <label>Trạng thái</label>
                    </td>
                    <td>
                        <select id="select" name="status">
                            <option>---Chọn---</option>
                            <?php
                            if($result_admin['status']==0){
                            ?>
                                <option selected value="0">Kích hoạt</option>
                                <option value="1">Khóa</option>
                            <?php
                            }else{
                            ?>
                                <option value="0">Kích hoạt</option>
                                <option selected value="1">Khóa</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php
                }
                ?>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
        }

        }
            ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'?>