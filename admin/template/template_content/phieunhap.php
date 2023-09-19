<form action="" method="POST">
    <h2 id="title_dh">Danh sách phiếu nhập</h2>
    <!-- Tạo thành chọn ngày lọc -->
    <h3 id="title_loc">Lọc đơn hàng theo ngày</h3>
    <label for="from" class="label_from">Từ :</label>
    <input type="date" name="from" id="from">
    <label for="to" class="to">Đến :</label>
    <input type="date" name="to" id="to">
    <input type="submit" name="Loc" id="Loc" value="Lọc">
    <input type="submit" name="Refresh" id="Refresh" value="Refresh">
 </form>
 <div class="row">
    <div class="buttonadd">
        <a href="editpn.php?">
            <div class="col text-black">
                Thêm Phiếu
            </div>
        </a>
    </div>
 </div>

    
    <table id="ds_donhang">
        <tr>
            <th>Mã</th>
            <th style = "width: 20%">Tổng đơn</th>
            <th>Mã hãng</th>
            <th style = "width: 15%">Mã tài khoản</th>
            <th style = "width: 23%">Hành động</th>
        </tr>
        <?php
            if(isset($_POST['Loc']) == false){
                include("../db/DAOPhieuNhap.php");
                $db = new DAOPhieuNhap();
                $db->connect();
                $data = $db->getList();
                if($data == null){
                    return;
                }
                $i=0;
                while ($i < count($data)){
        ?>
                <tr>
                    <td><?php echo $data[$i][0]?></td>
                    <td><?php echo number_format($data[$i][2],0,',','.')."đ"?></td>
                    <td><?php echo $data[$i][3]?></td>
                    <td><?php echo $data[$i][4]?></td>
                    <td>
                        <a href="ChiTietPhieuNhap.php?CT=<?php echo $data[$i][0]?>"><div>Xem chi tiết</div></a>
                        <a href='xuly/xulyXoaPN.php?idpn=<?php echo $data[$i][0]?>'>
                            <div>Xóa</div>
                        </a>
                    </td>
                </tr>
        <?php
                    $i++;
                }
            }
            else{
                if(isset($_POST['from']) && $_POST['to']){
                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    include('../db/DAOPhieuNhap.php');
                    $db = new DAOPhieuNhap();
                    $db->connect();
                    $data = $db->Loc($from,$to);
                    if($data == false){
                        return;
                    }
                    $i=0;
                    while ($i < count($data)){
        ?>
                        <tr>
                    <td><?php echo $data[$i][0]?></td>
                    <td><?php echo number_format($data[$i][2],0,',','.')."đ"?></td>
                    <td><?php echo $data[$i][3]?></td>
                    <td><?php echo $data[$i][4]?></td>
                    <td><a href="ChiTietPhieuNhap.php?CT=<?php echo $data[$i][0]?>"><div>Xem chi tiết đơn hàng</div></a></td>
                        
                </tr>
        <?php    
                        $i++;
                    }
                }
            }
        ?>

    </table>


