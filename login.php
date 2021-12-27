<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertCustomers = $cs->insert_customers($_POST);
        
    }
?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        
        $login_Customers = $cs->login_customers($_POST);
        
    }
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Khách hàng đã có tài khoản</h3>
        	<p>Hãy nhập email và mật khẩu</p>
        	<?php
			if(isset($login_Customers)){
    			echo $login_Customers;
    		}
        	?>
        	<form action="" method="post">
                	<input  type="text" name="email" class="field" placeholder="Enter Email....">
                    <input  type="password" name="password" class="field"  placeholder="Enter Password...." >
                 
                 <p class="note">Nếu chưa có tài khoản hãy đăng ký tài khoản tại mẫu bên phải quý khách</p>
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Đăng nhập"></div></div>
             </form>
          </div>
         <?php

         ?> 
    	<div class="register_account">
    		<h3>Đăng ký tài khoản</h3>
    		<?php
    		if(isset($insertCustomers)){
    			echo $insertCustomers;
    		}
    		?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập họ tên..." >
							</div>
							
							<div>
							   <input type="text" name="city"  placeholder="Nhập xã/phường..."  >
							</div>
							
							<div>
								<input type="text" name="zipcode"  placeholder="Nhập Zipcode..."  >
							</div>
							<div>
								<input type="text" name="email"  placeholder="Nhập email..."  >
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address"  placeholder="Nhập địa chỉ..."  >
						</div>
		    		<div>
						<select style="width:340px" id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Chọn tỉnh/thành phố</option>   

							<option value="hcm">TPHCM</option>
							<option value="na">Nghệ An</option>
							<option value="hn">Hà Nội</option>
							<option value="dn">Đà Nẳng</option>
							

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone"  placeholder="Nhập số điện thoại..." >
		          </div>
				  
				  <div>
					<input style="width:340px"type="password" name="password"  placeholder="Nhập mật khẩu..." >
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div></div>
		    
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php 
	include 'inc/footer.php';
	
 ?>
