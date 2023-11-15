<?php
include_once '../../../db/DAOSP.php';
include_once '../../../db/DAOHang.php';
include_once '../../../db/DAOKhuyenMai.php';
include_once '../../../db/DAOSoSize.php';

$daoSP = new DAOSP();
$daoHang = new DAOHang();
$daoSoSize = new DAOSoSize();
$daoKM = new DAOKhuyenMai();
if (isset($_POST['sort'])&&isset($_POST['order'])) {
    $order= $_POST['order']=='asc'?1:2;
    if ($_POST['sort'] == "sort-name")
        $data = $daoSP->getList1("Ten",$order);
    if ($_POST['sort'] == "sort-id")
        $data = $daoSP->getList1("MaSP",$order);
    if ($_POST['sort'] == "sort-quantity")
        $data = getListAddSL($daoSP,$daoSoSize,$order);
    if ($_POST['sort'] == "sort-firm")
        $data = $daoSP->getList1("MaHang",$order);
    if ($_POST['sort'] == "sort-sale")
        $data = $daoSP->getList1("MaKhuyenMai",$order);
    
    if(!$data)echo "<script>alert('".$_POST['sort']."')</script>";

    foreach ($data as $row) {
        $hang = $daoHang->getTenTheoMa($row["MaHang"]);
        $khuyenMai = $daoKM->getTenTheoMa($row["MaKhuyenMai"]);
        $soLuong = $daoSoSize->getSLSoSize($row["MaSP"]);

            echo "<tr class='productRow'>
        <td>" . $row["MaSP"] . "</td>";
        if ($row["AnhChinh"] == " ")
            $row["AnhChinh"] = "giay404.jpg";
        echo "
        <td> <img style='max-height:60px; max-width:60px' src='../img/products/" . $row["AnhChinh"] . "' alt=''> </td>
        <td>
            <div class='row'>"
            . $row["Ten"] . "
            </div>
            <div class='row hanhdong'>";
        echo "<a href='../ChiTietSP.php?MaSP=" . $row["MaSP"] . "' class='xem'>

                        <div class='col'>
                        Xem
                    </div>
                </a>";

            echo "<a href='editSP.php?hd=s&id=" . $row["MaSP"] . "' class='sua'>
                    <div class='col'>
                        Sửa
                    </div>
                </a>";

            if ($soLuong == 0)
            echo "<a href='xuly/xulyXoaSP.php?idsp=" . $row["MaSP"] . "' class='xoa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm " . $row["Ten"] . "')\">";
        else
            echo "<a href='#' class='xoa' onclick=\"return confirm('Số lượng sản phẩm lớn hơn 0 nên không được phép xóa')\">";
        echo "
                    <div class='col'>
                        Xóa
                    </div>
                </a>";

            echo "        </div>
        </td>
        <td>" . $soLuong . "</td>
        <td>" . $hang . "</td>
        <td>" . $khuyenMai . "</td>
    </tr>";
    }
}
function getListAddSL($daoSP,$daoSoSize,$order){
    $data=$daoSP->getList1();
    $datas=array();
    foreach ($data as $row){
        $row['SoLuong']= $daoSoSize->getSLSoSize($row['MaSP']);
        $datas[] = $row;
    }
    if($order==1)
    usort($datas, function($a, $b) {
        return $a['SoLuong'] - $b['SoLuong'];
    });
    else
    usort($datas, function($a, $b) {
        return $b['SoLuong'] - $a['SoLuong'];
    });
    return $datas;
}
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Thực hiện tìm kiếm dựa trên $searchQuery và trả về kết quả gợi ý ở đây
    // Ví dụ:
    $suggestions =$daoSP->findSP("Ten",$searchQuery);
    $u=0;
    foreach ($suggestions as $suggestion) {
        if($u==5)break;
        echo "<div class='suggestion border border-ligth p-1'><a class='text-black' href='./editSP.php?hd=s&id=".$suggestion['MaSP']."'>" . $suggestion['Ten'] . "</a></div>";
        $u++;
    }
}

