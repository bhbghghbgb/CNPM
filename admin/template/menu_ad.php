<?php
session_start();
if (isset($_SESSION['MaQuyen']) && isset($_SESSION['MaTaiKhoan'])) {

    $MaQuyen = $_SESSION['MaQuyen'];
    include("../db/DAOPhanQuyen.php");
    $db = new DAOPhanQuyen();
    $db->connect();

    // Lấy ra những mã chi tiết quyền đã được phân cho mã quyền
    $PQ = $db->getQuyen($MaQuyen);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = '';
    }
?>

    <div id="menu" class="position-fixed">
        <div class="img-logo">
            <a href="index.php">
                <img src="../img/img-logo/sneaker.jpg" alt="Logo">
            </a>
        </div>
        <ul id="ulMenu">
            <?php
            $listIcon = [
                'sticky-note',
                'sticky-note',
                'book',
                'list',
                'place-of-worship',
                'percent',
                'user',
                'sticky-note',
                'users-cog',
                'box',
                'home'
            ];
            $n = 0;
            if ($PQ != null) {
                $n = count($PQ);
            }
            for ($i = $n - 1; $i >= 0; $i--) {
                if ($PQ[$i]["MaChiTiet"] != 'd') {
            ?>
                    <a href="index.php?id=<?php echo $PQ[$i]["MaChiTiet"] ?>" class="<?php echo ($id == $PQ[$i]["MaChiTiet"]) ? 'active' : '' ?>">
                        <li>
                            <i class="fa fa-<?php echo $listIcon[$i] ?>"></i>
                            <span><?php echo $PQ[$i]["TenChiTiet"] ?></span>
                        </li>
                    </a>
            <?php
                }
            }
            ?>
        </ul>
    </div>

    <!-- Main Content Wrapper -->
    <div id="main">
        <!-- Your main content goes here -->
    </div>

<?php
}
?>