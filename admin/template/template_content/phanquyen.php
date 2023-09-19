<form action="" method="POST">
    
    <h2 id="title-pq">Quản lý phân quyền</h2>
    <div id="ADD">
        <label for="MaQuyen">
            <div>Mã quyền: </div>
            <input tydive="text" name="MaQuyen" id = "MaQuyen">
        </label>
        <label for="TenQuyen">
            <div>Tên quyền: </div>
            <input type="text" name="TenQuyen" id = "TenQuyen">
        </label>
        <input type="submit" id="add" name="add" value="Thêm quyền mới">
    </div>

    <br>   
    <h4 id="dsq">Danh sách quyền: </h4> 
    <table id="quyen">
        <tr>
            <th>Mã quyền</th>
            <th>Tên quyền</th>
            <th>Thực hiện phân quyền</th>
        </tr>
        <?php
            include("../db/DAOQuyen.php");
            //include("../db/DAOPhanQuyen.php");
            $db = new DAOQuyen();
            $db->connect();
            $dbPQ = new DAOPhanQuyen();
            $dbPQ->connect();
            $data = $db->getList();
            if($data==null){
                return;
            }
            $i = 0;
            while ($i < count($data)){ 
        
        ?>
            <tr>
                <td><?php echo $data[$i][0]?></td>
                <td><?php echo $data[$i][1]?></td>
                <td><a href = "../admin/template/template_content/PhanQuyen/xulyPhanQuyen.php?id=<?php echo $data[$i][0]?>"><div>Thực hiện phân quyền</div></a></td>
                <td><a href = "index.php?id=pq&MaQuyen=<?php echo $data[$i][0]?>&delete=1" onclick = "return confirm(`Bạn có muốn xóa không`)"><i class="fas fa-trash"></i></a></td>
            <tr>
        <?php
                $i++;
            }
        
        ?>
    </table>
    
</form>

<?php
    if(isset($_POST['add'])){
        $MaQuyen = $_POST['MaQuyen'];
        $TenQuyen = $_POST['TenQuyen'];

        if($MaQuyen == null || $TenQuyen == null){
            echo "<script>alert('Không để trống thông tin');</script>";
            return;
        }

        if($db->hasQuyen($MaQuyen)==false){
            echo "<script>alert('Mã quyền đã được sử dụng');</script>";
            return;
        }
        
        if($db->insertQuyen($MaQuyen,$TenQuyen)){
            echo "<script>alert('Thêm quyền thành công');window.location='index.php?id=pq';</script>";
        }
    }

    if(isset($_GET['delete'])){
        $MaQuyen = $_GET['MaQuyen'];
        if($dbPQ->delete($MaQuyen)){
            if($db->deleteQuyen($MaQuyen)){
                echo "<script>alert('Xóa quyền thành công');window.location='index.php?id=pq';</script>"; 
            }
            else{
                echo "<script>alert('Có tài khoản đang dùng quyền này');window.location='index.php?id=pq';</script>";
            }
        }
    }

?>