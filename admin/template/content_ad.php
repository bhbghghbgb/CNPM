<div id="content"class="row" style="background-color:#f0f5f8;height:calc(100% - 72px)">
<?php
// if(isset($_GET['id'])&&isset($_GET['hd'])&&isset($_GET['idsp'])){
//     if($_GET['id'])
//         include('template_content/detail_'.$id.'.php');
// }
// else
if (isset($_SESSION['MaQuyen']) && isset($_SESSION['MaTaiKhoan'])){

    $MaQuyen = $_SESSION['MaQuyen'];
    $db = new DAOPhanQuyen();
    $db->connect();

    //Lấy ra những mã chi tiết quyền đã được phân cho mã quyền

    $PQ = $db->getQuyen($MaQuyen);


    if(isset($_GET['id'])){
        // //kiểm xem đường dẫn truy cập có đúng theo quyền không
        $id = $_GET['id'];

        $n = 0;

        $flag = false;

        if($PQ != null){
            $n = count($PQ);
        }

        for($i=0;$i<$n;$i++){
            if($id == $PQ[$i][1]){
                $flag = true;
            }
        }

        if($flag == true){

            switch($_GET['id']){
                case 'tc':
                    include('template_content/trangchu.php');
                break;
                case 'nd':
                    include('template_content/nguoidung.php');
                break;
                case 'sp':
                    include('template_content/sanpham.php');
                break;
                case 'dh':
                    include('template_content/donhang.php');
                break;
                case 'bd':
                    include('template_content/baidang.php');
                break;
                case 'pq':
                    include('template_content/phanquyen.php');
                break;
                case 'pn':
                    include('template_content/phieunhap.php');
                break;
                case 'h':
                    include('template_content/Hang/Hang.php');
                break;
                case 'dm':
                    include('template_content/DanhMuc/DanhMuc.php');
                break;
                case 'km':
                    include('template_content/KhuyenMai/khuyenmai.php');
                break;
            }

        }
    }
}
                    
?>


    
</div>