<?php
if (isset($_POST['hd'])) {
    $hd = $_POST['hd'];
    include '../../db/dbconnect.php';

    //kiểm tra điều kiện pattern
    if (isset($_POST['id']))
        $id = $_POST['id'];


    switch ($hd) {
        case "Thêm":
            // Tao listid phiếu nhập da co san
            $listIdtk = [];
            $sql = "SELECT MaPhieu FROM phieunhaphang";
            $result = $conn->query($sql);
            // Kiểm tra kết quả trả về
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $listId[$i] = $row['MaPhieu'];
                    $i++;
                }
            }
            // tìm id thích hợp
            for ($i = 1; $i < 1000; $i++) {
                $found = false;
                if (!in_array($i, $listId)) {
                    $maphieu = $i;
                    break;
                }
            }
            // ép kiểu string
            $maphieu = (string) $maphieu;
//////////////////////////////////////////////////////////////

            // Thêm vào db
            $sql = "INSERT INTO phieunhaphang (MaPhieu ,NgayTao ,TongDon ,MaHang ,MaTaiKhoan ,TrangThai )
            VALUES (
            $maphieu ,
            CURDATE(),
            0,
            '" . $_POST['hang'] . "',
            " . $_POST['nhanvien'] . ",
            1)";
            $result = mysqli_query($conn, $sql);
            echo $sql;
            if ($result) {
                echo "<script>
                alert('Thêm Thành Công');
                window.location = '../index.php?id=pn';
                </script>";
                $conn->close();
                return;
            } else {
                echo "<script>
                alert('Thêm không Thành Công');
                // window.location = '../index.php?id=pn';
                </script>";
                $conn->close();
                return;
            }
    }
}

?>