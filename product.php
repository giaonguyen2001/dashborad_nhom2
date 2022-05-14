<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type = get_safe_value($con, $_GET['type']);

	if($type=='delete'){
		$id = get_safe_value($con, $_GET['id']);
		$delete_sql="delete from SanPham where masanPham = '$id'";
		mysqli_query($con, $delete_sql);
	}
}

$sql = "select SanPham.*, DanhMuc.tenDanhMuc 
		from SanPham, DanhMuc 
		where SanPham.maDanhMuc = DanhMuc.maDanhMuc 
		order by SanPham.maDanhMuc desc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Sản phẩm </h4>
				   <h4 class="box-link"><a href="manage_product.php">Thêm sản phẩm</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Mã sản phẩm</th>
							   <th>Tên sản phẩm</th>
							   <th>Giá</th>
							   <th>Thông tin sản phẩm</th>
							   <th>Ảnh</th>
							   <th>Số lượng</th>
							   <th>Danh mục</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i = 1;
							while($row = mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['maSanPham']?></td>
							   <td><?php echo $row['tenSanPham']?></td>
							   <td><?php echo $row['gia']?></td>
							   <td><?php echo $row['thongTinSanPham']?></td>
							   <td><img src="<?php echo 'images/products/'.$row['anh']?>"/></td>
							   <td><?php echo $row['soLuong']?></td>
							   <td><?php echo $row['tenDanhMuc']?></td>
							   <td>
								<?php 
								echo "<span class='badge badge-edit'><a href='manage_product.php?id=".$row['maSanPham']."'>Chỉnh sửa</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['maSanPham']."'>Xóa</a></span>";
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>