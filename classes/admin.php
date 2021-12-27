<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class admin
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_admin($data,$files){

			$adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
			$adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);
			$adminPhone = mysqli_real_escape_string($this->db->link, $data['adminPhone']);
			$adminUser = mysqli_real_escape_string($this->db->link, $data['adminUser']);
			$adminPass = mysqli_real_escape_string($this->db->link, md5($data['adminPass']));
			$level = mysqli_real_escape_string($this->db->link, $data['level']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($adminName=="" || $adminEmail=="" || $adminPhone=="" || $adminUser=="" || $adminPass=="" || $level==""){
				$alert = "<span class='error'>Vui lòng nhập đầy đủ thông tin</span>";
				return $alert;
			}else{
				$check_user = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' LIMIT 1";
				$result_check = $this->db->select($check_user);
				if($result_check){
					$alert = "<span class='error'>Tài khoản đã tồn tại!</span>";
					return $alert;
				}else{
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "INSERT INTO tbl_admin(adminName, adminEmail, adminPhone, adminUser, adminPass, level, image) VALUES('$adminName', '$adminEmail', '$adminPhone', '$adminUser', '$adminPass', '$level', '$unique_image')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm người dùng thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm người dùng không thành công</span>";
						return $alert;
					}
				}
			}
		}
		public function show_admin(){
			$query = "SELECT * FROM tbl_admin order by adminId desc";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function show_countadmin(){
			$query = "SELECT COUNT(*) AS countadmin FROM tbl_admin";
			$result = $this->db->select($query);
			return $result;
		}

		public function getadminbyId($id){
			$query = "SELECT * FROM tbl_admin where adminId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_admin($data,$files,$id){
			$adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
			$adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);
			$adminPhone = mysqli_real_escape_string($this->db->link, $data['adminPhone']);
			$level = mysqli_real_escape_string($this->db->link, $data['level']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			$status = mysqli_real_escape_string($this->db->link, $data['status']);
			if($adminName=="" || $adminEmail=="" || $adminPhone=="" || $level==""){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 20480000) {

		    		 $alert = "<span class='success'>Kích thước ảnh nên nhỏ hơn 2MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_admin SET
					adminName = '$adminName',
					adminEmail = '$adminEmail',
					adminPhone = '$adminPhone',
					level = '$level', 
					image = '$unique_image',
					status = '$status'
					WHERE adminId = '$id'";
					
				}else{
					$query = "UPDATE tbl_admin SET
					adminName = '$adminName',
					adminEmail = '$adminEmail',
					adminPhone = '$adminPhone',
					level = '$level',
					status = '$status' 
					WHERE adminId = '$id'";
				}
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật thành công.</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật không thành công.</span>";
						return $alert;
					}
			
			}

		}

		public function update_nhanvien($data,$files,$id){
			$adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
			$adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);
			$adminPhone = mysqli_real_escape_string($this->db->link, $data['adminPhone']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			if($adminName=="" || $adminEmail=="" || $adminPhone==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 2048000) {

		    		 $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_admin SET
					adminName = '$adminName',
					adminEmail = '$adminEmail',
					adminPhone = '$adminPhone',
					image = '$unique_image'
					WHERE adminId = '$id'";
					
				}else{
					$query = "UPDATE tbl_admin SET
					adminName = '$adminName',
					adminEmail = '$adminEmail',
					adminPhone = '$adminPhone'
					WHERE adminId = '$id'";
				}
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật thành công.</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật không thành công.</span>";
						return $alert;
					}
			
			}

		}
		
		public function update_pass($data,$files,$id){
			$adminOldPass = mysqli_real_escape_string($this->db->link, md5($data['adminOldPass']));		
			$adminPass = mysqli_real_escape_string($this->db->link, md5($data['adminPass']));
			$queryP = "SELECT * FROM tbl_admin where adminId = '$id' AND adminPass = '$adminOldPass'";
			$resultP = $this->db->select($queryP);
			if($resultP){
				$query = "UPDATE tbl_admin SET
				adminPass = '$adminPass'
				WHERE adminId = '$id'";
			}else{
				$alert = "<span class='error'>Mật khẩu cũ không đúng</span>";
				return $alert;
			}
			$result = $this->db->update($query);
			if($result){
				$alert = "<span class='success'>Đổi mật khẩu thành công.</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Đổi mật khẩu không thành công.</span>";
				return $alert;
			}		
		}

		public function restore_pass($data,$files,$id){
			$adminPass = mysqli_real_escape_string($this->db->link, md5($data['adminPass']));

			$query = "UPDATE tbl_admin SET
			adminPass = '$adminPass'
			WHERE adminId = '$id'";
			$result = $this->db->update($query);
			if($result){
				$alert = "<span class='success'>Phục hồi thành công.</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Phục hồi không thành công.</span>";
				return $alert;
			}
		}

		public function del_admin($id){
			$query = "DELETE FROM tbl_admin where adminId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Admin Deleted Successfully</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Admin Deleted Not Success</span>";
				return $alert;
			}
			
		}
		
	}
?>