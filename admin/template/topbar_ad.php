<div id="topbar" class="row bg-black text-light d-none d-lg-flex d-md-flex m-0">
    <div id="topbar-1" class="col col-5 col-lg-4 d-flex px-4">
        <div class="icon-back">
            <i class="fas fa-house-user"></i>
        </div>
        <a href="../"> Xem Trang</a>
    </div>
    <div class="col  col-4 d-none d-lg-flex">

    </div>
    <div class="col col-7 col-lg-4 px-4 justify-content-end d-flex align-text-top">
        <p class="text-center">
            Xin chào <?php 
            include_once("../db/DAOThongTinTaiKhoan.php");
            $daoTTTK = new DAOThongTinTaiKhoan();
            $daoTTTK->connect();
            $data = $daoTTTK->getTaiKhoan($_SESSION['MaTaiKhoan']);
            echo $data['TenDN'];
            ?> | <a href="logout.php" class="text-light">Đăng xuất</a>
        </p>
    </div>
</div>