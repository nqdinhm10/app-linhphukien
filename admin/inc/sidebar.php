<?php
    include '../lib/session.php';
    Session::checkSession();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang quản lý</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <!-- Custom styles for catlist page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Hãy chọn "Xác nhận" để đăng xuất.</div>
                <div class="modal-footer">                 
                    <?php
                        if(isset($_GET['action']) && $_GET['action']=='logout'){
                            Session::destroy();
                        }
                    ?>
                    <a class="btn btn-red" href="?action=logout">Xác nhận</a>
                    <button class="btn btn-grey" type="button" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3">NQD-SHOP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang chủ</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Bảng điều khiển
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Danh mục sản phẩm</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                       
                        <a class="collapse-item" href="catadd.php">Thêm danh mục</a>
                        <a class="collapse-item" href="catlist.php">Danh sách danh mục</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Thương hiệu sản phẩm</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                      
                        <a class="collapse-item" href="brandadd.php">Thêm thương hiệu</a>
                        <a class="collapse-item" href="brandlist.php">Danh sách thương hiệu</a>                      
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSp"
                    aria-expanded="true" aria-controls="collapseSp">
                    <i class="fas fa-fw fa-microchip"></i>
                    <span>Sản phẩm</span>
                </a>
                <div id="collapseSp" class="collapse" aria-labelledby="headingSp"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                      
                        <a class="collapse-item" href="productadd.php">Thêm sản phẩm</a>
                        <a class="collapse-item" href="productlist.php">Danh sách sản phẩm</a>                      
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDh"
                    aria-expanded="true" aria-controls="collapseDh">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>Đơn hàng</span>
                </a>
                <div id="collapseDh" class="collapse" aria-labelledby="headingDh"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                      
                        <a class="collapse-item" href="bill.php">Danh sách đơn hàng</a>
                        <a class="collapse-item" href="inbox.php">Danh sách ordered</a>                 
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSl"
                    aria-expanded="true" aria-controls="collapseSl">
                    <i class="fas fa-fw fa-sliders-h"></i>
                    <span>Slider</span>
                </a>
                <div id="collapseSl" class="collapse" aria-labelledby="headingSl"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                      
                        <a class="collapse-item" href="sliderlist.php">Danh sách slider</a>
                        <a class="collapse-item" href="slideradd.php">Thêm slider</a>                 
                    </div>
                </div>
            </li>

            <?php
                if(Session::get('level')==0 || Session::get('level')==1){
            ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Quản trị
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Người dùng</span>
                    </a>

                    
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">                      
                            <a class="collapse-item" href="adminadd.php">Thêm người dùng</a>
                            <a class="collapse-item" href="adminlist.php">Danh sách người dùng</a>
                            
                            
                        </div>
                    </div>
                    
                </li>
            <?php
                }
            ?>
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->