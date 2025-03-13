<?php
include_once("DataBaseConfig.php");
class DAOKhuyenMai extends DatabaseConfig
{

    public function getList()
    {
        $sql = "SELECT * FROM khuyenmai";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                if ($row[0] != '#') {
                    $data[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function hasKM($MaKM)
    {
        $sql = "SELECT * FROM khuyenmai WHERE MaKhuyenMai='" . $MaKM . "'";
        if ($result = mysqli_query($this->conn, $sql)) {
            if ($result->num_rows != 0) {
                return false;
            }
        }
        return true;
    }
    public function getTenTheoMa($maKM)
    {
        $sql = "SELECT TenKhuyenMai FROM khuyenmai where MaKhuyenMai = '$maKM'";
        if ($result = mysqli_query($this->conn, $sql)) {
            $row = mysqli_fetch_array($result);
            return $row["TenKhuyenMai"];
        }
    }

    public function insertKM($MaKM, $TenKM, $MoTa, $TiLeGiam)
    {
        $sql = "INSERT INTO khuyenmai (MaKhuyenMai,TenKhuyenMai,MoTa,TiLeGiam) VALUES ('$MaKM', '$TenKM', '$MoTa', '$TiLeGiam')";
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }

    public function updateKM($MaKM, $TenKM, $MoTa, $TiLeGiam)
    {
        $sql = "UPDATE khuyenmai SET TenKhuyenMai = '" . $TenKM . "' ,MoTa = '" . $MoTa . "' ,TiLeGiam = " . $TiLeGiam . " WHERE MaKhuyenMai = '" . $MaKM . "'";
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }

    public function hasSP($MaKM)
    {
        $sql = "SELECT * FROM sanpham WHERE MaKhuyenMai='" . $MaKM . "'";
        if ($result = mysqli_query($this->conn, $sql)) {
            if ($result->num_rows != 0) {
                return false;
            }
        }
        return true;
    }

    public function deleteKM($MaKM)
    {
        $sql = "DELETE FROM khuyenmai WHERE MaKhuyenMai = '" . $MaKM . "'";
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }
}
