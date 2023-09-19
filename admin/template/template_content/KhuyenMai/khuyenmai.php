
<form method="post" action="./template/template_content/KhuyenMai/xulyKhuyenMai.php?">
    <h3 id="title_km">Quản lý khuyến mãi</h3>
    <a href="./template/template_content/KhuyenMai/xulyKhuyenMai.php?cn=Add"><div id="add_km">Tạo khuyến mãi</div></a>
    <table id="tbl_km">
        <tr>
            <th style = "width: 15%">Mã khuyến mãi</th>
            <th style = "width: 30%">Tên khuyến mãi</th>
            <th>Mô tả</th>
            <th style = "width: 20%">Thao tác</th>
        </tr>

        <?php 
            include ("../db/DAOKhuyenMai.php");
            $db_km = new DAOKhuyenMai();
            $db_km->connect();
            $data = $db_km->getList();
            if($data==null){
                return;
            }
            $i = 0;
            while ($i < count($data)){
        ?>
            <tr>
                <td><?php echo $data[$i][0]?></td>
                <td><?php echo $data[$i][1]?></td>
                <td><?php echo $data[$i][2]?></td>
                <td>
                    <a href="./template/template_content/KhuyenMai/xulyKhuyenMai.php?cn=Edit&MaKM=<?php echo $data[$i][0]?>&TenKM=<?php echo $data[$i][1]?>&MoTa=<?php echo $data[$i][2]?>&TiLeGiam=<?php echo $data[$i][3]?>"><div id="edit_km">Sửa</div></a>
                    <a href="./template/template_content/KhuyenMai/xulyKhuyenMai.php?cn=Delete&MaKM=<?php echo $data[$i][0]?>"><div id="delete_km" onclick="return confirm(`Bạn có muốn xóa không ?`)">Xóa</div></a>
                    <!--onclick="return confirm(`Bạn có muốn xóa không ?`)" thực hiện kiểm tra xem người dùng có muốn xóa hay không nếu onclick trả về giá trị false thì không thực hiện di chuyển đến href  -->
                </td>
            </tr>
        <?php
                $i++;
            }
        ?>
        
    </table>

</form>