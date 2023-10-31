<?php 
include('../db/DAOSP.php');
include('../db/DAOSoSize.php');
if (isset ($_POST["maHang"])) {
    $maHang  = $_POST["maHang"];
    $daoSP = new DAOSP();
    $ListSP = $daoSP->getListSPFollow($maHang);
    for ($i = 0; $i<count($ListSP); $i++) {
        $maSP =   $ListSP[$i]['MaSP']; // mã hãng
        $tenSP =   $ListSP[$i]['Ten']; // tên hãng
        echo"<option value='$maSP~$tenSP'>$tenSP</option>";   
    }
}

if (isset ($_POST["maSP"])) {
    $maSP = $_POST["maSP"];
    $daoSoSize = new DAOSoSize();
    $ListSoSize = $daoSoSize->getSoSize($maSP);
    for ($i = 0; $i<count($ListSoSize); $i++) {
        $size =   $ListSoSize[$i]['Size']; // mã hãng
        echo"<option value='$size'>$size</option>";   
    }

}

if (isset ($_POST["listCTPN"])) {
    $listCTPN = $_POST["listCTPN"];
    for ($i=0; $i<count($listCTPN); $i++) {
        var_dump($listCTPN[$i]);
    }
}





?>