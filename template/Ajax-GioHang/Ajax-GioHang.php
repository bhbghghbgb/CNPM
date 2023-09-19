<?php
    //Kiem tra xem so trang co bang 1 khong neu co thi in them ten cot cho bang
    $Trang = $_GET['Trang'];

    if($Trang == 1){
?>
    <tr>
        <th>Mã đơn</th>
        <th>Mã tài khoản</th>
        <th>Ngày đặt</th>
        <th>Trạng thái</th>
        <th>Tổng tiền</th>
        <th style = "width: 23%">Xem chi tiết</th>
    </tr>
<?php
    }

    if(isset($_GET['MaTK'])){
        include ('../../db/DAODonHang.php');
        $db = new DAODonHang();
        $db->connect();
        $MaTK = $_GET['MaTK'];
        $sql = "SELECT * FROM donhang WHERE MaTaiKhoan = '" . $MaTK . "'";

        if(isset($_GET['From']) || isset($_GET['To'])){
            $From = $_GET['From'];
            $To = $_GET['To'];
            if($From != "" && $To != ""){
                $sql = $sql . " AND NgayDat BETWEEN '" .$From."' AND '".$To."'" ;
            }
            
        }

        

        $From = ($Trang - 1) * 5;

        $sql = $sql . "  ORDER BY MaDonHang DESC  LIMIT ".$From.",5";


        $data = $db->getListDaDat($sql);

        $n = 0;

        if($data != null) {
            $n = count($data);
        }

        for($i = 0; $i < $n; $i++) {
?>
            <tr>
                    <td><?php echo $data[$i][0]?></td>
                    <td><?php echo $data[$i][1]?></td>
                    <td><?php echo $data[$i][2]?></td>
                    <td><div id="TinhTrang" style = "background-color:<?php if($data[$i][3] != 1) { echo "red";}?>;">
                        <?php 
                            if($data[$i][3]==1){
                                echo 'Đã xử lý';
                            }
                            else{
                                echo 'Chưa xử lý';
                            }
                        ?></div>
                    </td>
                    <td><?php echo number_format($data[$i][4],0,',','.')."đ"?></td>
                    <td><a href="./admin/template/template_content/ChiTietDonHang.php?PQ=User&CT=<?php echo $data[$i][0]?>&MaTK=<?php echo $data[$i][1]?>&Date=<?php echo $data[$i][2]?>&TT=<?php echo $data[$i][4]?>"><div>Xem chi tiết đơn hàng</div></a></td>
            </tr>
<?php
        }
    }
?>



