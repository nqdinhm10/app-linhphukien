<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include '../classes/category.php' ?>
<?php
    $cat = new category();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delcat = $cat->del_category($id);
    }
?>       
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Hành động</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $show_cate = $cat->show_category();
                        if($show_cate){
                            $i = 0;
                            while($result = $show_cate->fetch_assoc()){
                                $i++;
                            
                    ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['catName'] ?></td>
                            <td><a href="catedit.php?catid=<?php echo $result['catId'] ?>">Sửa</a> || <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['catId'] ?>">Xóa</a></td>
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
            