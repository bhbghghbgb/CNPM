<?php
    include("../../../../db/DAODanhMuc.php");
    $db = new DAODanhMuc();
    $db->connect();
    if(isset($_POST['tt_dm'])){
        switch($_POST['tt_dm']) {
            case 'Thêm thông tin danh mục':{
                if(isset($_POST['MaDanhMuc']) && isset($_POST['TenDanhMuc'])){
                    $_Ma = $_POST['MaDanhMuc'];
                    $_Ten = $_POST['TenDanhMuc'];

                    if($_Ma == "" || $_Ten == ""){
                        echo "<script>alert('Không để trống thông tin');window.location = '../../../index.php?id=dm';</script>";
                        return;
                    }
                    
                    $pattern = '/^DM-/';
                    if(preg_match($pattern, $_Ma)==false) {
                        echo "<script>alert('Mã danh mục bắt đầu bằng DM-');window.location = '../../../index.php?id=dm';</script>";
                        return;
                    }

                    if($db->checkDanhMucDaXoa($_Ma)){
                        if($db->insertDanhMucDaXoa($_Ma,$_Ten)){
                            echo "<script>alert('Thêm danh mục thành công');window.location = '../../../index.php?id=dm';</script>";
                            return;
                        }
                        else{
                            echo "<script>alert('Thêm danh mục thất bại');window.location = '../../../index.php?id=dm';</script>";
                            return;
                        }
                    }


                    if($db->hasDanhMuc($_Ma)){
                        echo "<script>alert('Mã danh mục đã tồn tại');window.location = '../../../index.php?id=dm';</script>";
                        return;
                    }

                    if($db->insertDanhMuc($_Ma,$_Ten)){
                        echo "<script>alert('Thêm danh mục thành công');window.location = '../../../index.php?id=dm';</script>";
                        return;
                    }
                    else{
                        echo "<script>alert('Thêm danh mục thất bại');window.location = '../../../index.php?id=dm';</script>";
                        return;
                    }

                } 
            }

            case 'Sửa thông tin danh mục' :{
                if(isset($_POST['TenDanhMuc']) && isset($_POST['MaDanhMuc'])){
                    $_Ma = $_POST['MaDanhMuc'];
                    $_Ten = $_POST['TenDanhMuc'];

                    if($_Ten == ""){
                        echo "<script>alert('Không để trống thông tin');window.location = '../../../index.php?id=dm';</script>";
                        return;
                    }

                    if($db->updateDanhMuc($_Ma,$_Ten)){
                        echo "<script>alert('Sửa danh mục thành công');window.location = '../../../index.php?id=dm';</script>";
                        return;
                    }
                    else{
                        echo "<script>alert('Sửa danh mục thất bại');window.location = '../../../index.php?id=dm';</script>";
                        return;
                    }

                }
            }
        
        }
    }

    if(isset($_GET['cn'])){
        $Ma = $_GET['MaDanhMuc'];

        if($db->deleteDanhMuc($Ma)){
            echo "<script>alert('Xóa danh mục thành công');window.location = '../../../index.php?id=dm';</script>";
            return;
        }
        else{
            echo "<script>alert('Xóa danh mục thất bại');window.location = '../../../index.php?id=dm';</script>";
            return;
        }
    }
?>