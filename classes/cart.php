<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

	class cart
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function add_to_cart($quantity, $id){

			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$sId = session_id();
			$check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId ='$sId'";
			$result_check_cart = $this->db->select($check_cart);
			if($result_check_cart){
				$msg = "<span class='error'>Sản phẩm đã được thêm vào</span>";
				return $msg;
			}else{

				$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
				$result = $this->db->select($query)->fetch_assoc();
				
				$image = $result["image"];
				$price = $result["price"];
				$productName = $result["productName"];

				$query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId','$image','$price','$productName')";
				$insert_cart = $this->db->insert($query_insert);
				if($insert_cart){
					$msg = "<span class='error'>Thêm sản phẩm thành công</span>";
					return $msg;
					
				}
			}
			
		}
		


		public function get_product_cart(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_quantity_cart($quantity, $cartId){
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$cartId = mysqli_real_escape_string($this->db->link, $cartId);
			$query = "UPDATE tbl_cart SET

					quantity = '$quantity'

					WHERE cartId = '$cartId'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='error'>Cập nhật thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Product Quantity Updated Not Successfully</span>";
				return $msg;
			}
		
		}
		public function del_product_cart($cartid){
			$cartid = mysqli_real_escape_string($this->db->link, $cartid);
			$query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
			$result = $this->db->delete($query);
			if($result){
				$msg = "<span class='error'>Xóa sản phẩm thành công</span>";
				return $msg;
			
			}
		}

		public function check_cart(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function check_order($customer_id){
			$sId = session_id();
			$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_countorder(){
			$query = "SELECT COUNT(*) AS countorder FROM tbl_bill";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_turnovertotal(){
			$query = "SELECT SUM(price) AS turnovertotal FROM tbl_order";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_turnover(){
			$query = "SELECT date(date_order) as date_order, SUM(price) AS turnover FROM tbl_order GROUP BY date(date_order)";
			$result = $this->db->select($query);
			return $result;
		}

		public function del_all_data_cart(){
			$sId = session_id();
			$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->delete($query);
			

		}
		public function del_compare($customer_id){
			$sId = session_id();
			$query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
			$result = $this->db->delete($query);
			return $result;
		}
		public function insertOrder($customer_id){
			$id = time();
			$customer_id = $customer_id;
			$query_bill = "INSERT INTO tbl_bill(id,customer_id) VALUES('$id','$customer_id')";
			$insert_bill = $this->db->insert($query_bill);
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$get_product = $this->db->select($query);
			if($get_product){
				while($result = $get_product->fetch_assoc()){
					$productid = $result['productId'];
					$productName = $result['productName'];
					$quantity = $result['quantity'];
					$price = $result['price'] * $quantity;
					$image = $result['image'];
					$customer_id = $customer_id;
					$billid = $id;
					$query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,customer_id,billid) VALUES('$productid','$productName','$quantity','$price','$image','$customer_id','$billid')";
					$insert_order = $this->db->insert($query_order);
				}
			}


		}
		public function getAmountPrice($customer_id){
		
			$query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
			$get_price = $this->db->select($query);
			return $get_price;
		}
		public function get_cart_ordered($customer_id){
			$query = "SELECT * FROM tbl_bill WHERE customer_id = '$customer_id'";
			$get_cart_ordered = $this->db->select($query);
			return $get_cart_ordered;
		}
		public function get_inbox_cart(){
			$query = "SELECT * FROM tbl_order ORDER BY date_order";
			$get_inbox_cart = $this->db->select($query);
			return $get_inbox_cart;
		}
		public function getbill(){
			$query = "SELECT * FROM tbl_bill ORDER BY date_order";
			$getbill = $this->db->select($query);
			return $getbill;
		}
		public function getbillbyId($id){
			$query = "SELECT * FROM tbl_order where billid = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function shifted($id,$time){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			
			$query = "UPDATE tbl_bill SET

					status = '1'

					WHERE id = '$id' AND date_order='$time'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Cập nhật đơn hàng thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Cập nhật đơn hàng không thành công</span>";
				return $msg;
			}
		}
		public function del_shifted($id,$time){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			
			$query = "DELETE FROM tbl_bill 
					WHERE id = '$id' AND date_order='$time'";

			$query2 = "DELETE FROM tbl_order WHERE billid = '$id'";

			$qty = "SELECT * FROM tbl_order WHERE date_order='$time'";
			$getqty = $this->db->select($qty);
			while ($row = $getqty->fetch_assoc()) {
				$soluong=$row['quantity'];
				$idsanpham=$row['productId'];
			    $query3 = "UPDATE tbl_product SET
					productQuantity = productQuantity - $soluong
					WHERE productId = $idsanpham";
				$result3 = $this->db->update($query3);
			}
					
			$result = $this->db->delete($query);
			$result2 = $this->db->delete($query2);
			
			if($result&&$result2&&$result3){
				$msg = "<span class='success'>Xóa đơn hàng thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Xóa đơn hàng không thành công</span>";
				return $msg;
			}
		}
		public function shifted_confirm($id,$time){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$query = "UPDATE tbl_bill SET

					status = '2'

					WHERE customer_id = '$id' AND date_order='$time'";
			$result = $this->db->update($query);
			return $result;
		}
		


	}
?>