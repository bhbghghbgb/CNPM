
<div>
    <h3 id="title_km">Quản lý danh mục</h3>
    <button id="add_dm" onclick=add()>Tạo danh mục</button>
    <table id="tbl_km">
        <tr>
            <th style = "width: 15%">Mã danh mục</th>
            <th>Tên danh mục</th>
            <th style = "width: 20%">Thao tác</th>
        </tr>

        <?php 
            include ("../db/DAODanhMuc.php");
            $db_km = new DAODanhMuc();
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
                <td>
                    <button id="edit_dm" onclick="edit(`<?php echo $data[$i][0]?>`,`<?php echo $data[$i][1]?>`)">Sửa</button>
                    <a href="./template/template_content/DanhMuc/xulyDanhMuc.php?cn=Delete&MaDanhMuc=<?php echo $data[$i][0]?>"><div id="delete_dm" onclick="return confirm(`Bạn có muốn xóa không ?`)">Xóa</div></a>
                    <!--onclick="return confirm(`Bạn có muốn xóa không ?`)" thực hiện kiểm tra xem người dùng có muốn xóa hay không nếu onclick trả về giá trị false thì không thực hiện di chuyển đến href  -->
                </td>
            </tr>
        <?php
                $i++;
            }
        ?>
    </table>
</div>

<form  method="POST" action="./template/template_content/DanhMuc/xulyDanhMuc.php" id="form_dm">
        <p id="exit_dm" onclick=exit()>X</p> 
        <label for="MaDanhMuc">Mã danh mục: </label><br>
        <input type="text" id="MaDanhMuc" name="MaDanhMuc" value="" ><br>
        <!-- Su dung thuoc tinh readonly de thuc hien khoa ma DanhMuc lai -->

        <label for="TenDanhMuc">Tên danh mục: </label><br>
        <input type="text" id="TenDanhMuc" name="TenDanhMuc" value=""><br>

        <input type = "submit" id = "tt_dm" name = "tt_dm" value = "Thêm danh mục">
</form>


