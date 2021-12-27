<?php include 'inc/sidebar.php';?>
<?php include 'inc/header.php';?>
<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/cart.php');
include_once ($filepath.'/../helpers/format.php');

 ?>
<?php
   
    if(!isset($_GET['billid']) || $_GET['billid']==NULL){
       echo "<script>window.location ='inbox.php'</script>";
    }else{
         $id = $_GET['billid']; 
    }
     $ct = new cart();
  

?>
<?php  ?>
        
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
            </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        
                            <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Mã khách</th>
                                    <th>Mã hóa đơn</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $getbillbyId = $ct->getbillbyId($id);
                            if($getbillbyId){
                                $total = 0;
                                while($result = $getbillbyId->fetch_assoc()){
                               
                                ?>
                                
                                <tr class="odd gradeX">
                                    <td><?php echo $result['productName'] ?></td>
                                    <td><?php echo $result['quantity'] ?></td>
                                    <td><?php echo $result['price'].' '.'VNĐ' ?></td>
                                    <td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>"><?php echo $result['customer_id'] ?></a></td>                   
                                    <td><?php echo $result['billid'] ?></td>
                                    <?php
                                        $total += $result['price'];
                                        
                                         ?>

                                    
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                    

                                    ?>
                            </tbody>
                            
                        </table>
                        <p><b>Tổng tiền</b></p>
                        <?php echo ($total).' '.'VNĐ' ; ?>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>