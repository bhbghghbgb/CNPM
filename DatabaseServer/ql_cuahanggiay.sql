-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2023 lúc 05:36 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_cuahanggiay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MaSP` varchar(50) NOT NULL,
  `MaDonHang` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaBan` int(11) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `Size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaSP`, `MaDonHang`, `SoLuong`, `GiaBan`, `TongTien`, `Size`) VALUES
('003', 52, 1, 20700, 20700, 40),
('003', 54, 1, 20700, 20700, 40),
('003', 60, 1, 20700, 20700, 40),
('004', 57, 1, 20000, 20000, 20),
('005', 53, 1, 21600, 21600, 35),
('006', 53, 1, 33150, 33150, 39),
('016', 53, 1, 42000, 42000, 42),
('016', 61, 1, 50000, 50000, 40);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `MaSP` varchar(50) NOT NULL,
  `MaPhieu` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaNhap` int(11) NOT NULL,
  `TongGia` int(11) NOT NULL,
  `TrangThai` int(2) NOT NULL DEFAULT 1,
  `Size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`MaSP`, `MaPhieu`, `SoLuong`, `GiaNhap`, `TongGia`, `TrangThai`, `Size`) VALUES
('002', 1, 12, 1300, 15600, 0, 40),
('002', 2, 21, 22, 462, 0, 40),
('002', 3, 5, 12000, 60000, 0, 40),
('002', 4, 5, 12000, 60000, 0, 40),
('005', 5, 15, 12, 180, 0, 35),
('006', 5, 10, 13, 130, 0, 39),
('016', 6, 15, 20, 300, 0, 40),
('016', 7, 5, 45, 225, 0, 42),
('018', 8, 20, 150000, 3000000, 0, 30),
('002', 10, 45, 1312, 59040, 0, 40),
('004', 10, 12, 123, 1476, 0, 20),
('007', 10, 45, 456, 20520, 0, 50),
('010', 11, 45, 54, 2430, 0, 30),
('013', 11, 54, 54, 2916, 0, 41),
('002', 12, 45645, 45, 2054025, 0, 40),
('005', 14, 10, 12000000, 120000000, 0, 42),
('002', 15, 5, 140000, 700000, 0, 40),
('002', 16, 12, 13000, 156000, 0, 40),
('002', 19, 4, 455, 1820, 0, 40);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietquyen`
--

CREATE TABLE `chitietquyen` (
  `MaChiTiet` varchar(50) NOT NULL,
  `TenChiTiet` varchar(50) NOT NULL,
  `MoTa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietquyen`
--

INSERT INTO `chitietquyen` (`MaChiTiet`, `TenChiTiet`, `MoTa`) VALUES
('d', 'Duyệt phiếu nhập', 'Được duyệt phiếu nhập'),
('dh', 'Đơn hàng', 'Quản lý đơn hàng'),
('dm', 'Danh mục', 'Quản lý danh mục'),
('h', 'Hãng', 'Quản lý hãng'),
('km', 'Khuyến mãi', 'Quản lý khuyến mãi'),
('nd', 'Người dùng', 'Quản lý người dùng'),
('pn', 'Phiếu nhập', 'Quản lý phiếu nhập'),
('pq', 'Phân quyền', 'Quản lý phân quyền'),
('sp', 'Sản phẩm', 'Quản lý sản phẩm'),
('tc', 'Trang chủ', 'Được xem trang thống kê');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDM` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TenDM` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TrangThai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`MaDM`, `TenDM`, `TrangThai`) VALUES
('DM-1', 'Giay dinh san co nhan tao', 1),
('DM-2', 'Giay dinh san co tu nhien', 1),
('DM-3', 'Giay tre em', 1),
('DM-4', 'Giay de bang', 1),
('DM-5', 'Phu kien', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaTaiKhoan` int(50) NOT NULL,
  `NgayDat` date NOT NULL,
  `TrangThai` tinyint(1) NOT NULL,
  `TongTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDonHang`, `MaTaiKhoan`, `NgayDat`, `TrangThai`, `TongTien`) VALUES
(52, 18, '2023-11-06', 1, 20700),
(53, 18, '2023-11-06', 1, 96750),
(54, 18, '2023-11-06', 1, 20700),
(57, 18, '2023-11-14', 1, 20000),
(60, 18, '2023-11-14', 1, 20700),
(61, 18, '2023-11-14', 1, 50000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaTaiKhoan` int(50) NOT NULL,
  `MaSP` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hang`
--

CREATE TABLE `hang` (
  `MaHang` varchar(50) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `NgayTao` date NOT NULL,
  `TrangThai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hang`
--

INSERT INTO `hang` (`MaHang`, `Ten`, `NgayTao`, `TrangThai`) VALUES
('MH-001', 'Adidas', '2022-02-23', 1),
('MH-002', 'Nike', '2021-09-23', 1),
('MH-007', 'Hãng mơi', '2023-11-10', 1),
('MH-021', 'Pan Thailand', '2020-06-18', 1),
('MH-033', 'Puma', '2023-02-23', 1),
('MH-TDVietNam', 'Thượng Đình', '2023-11-14', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKhach` int(50) NOT NULL,
  `TenKhach` varchar(50) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `SDT` varchar(50) NOT NULL,
  `MaTaiKhoan` int(50) NOT NULL,
  `TrangThai` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MaKhach`, `TenKhach`, `DiaChi`, `SDT`, `MaTaiKhoan`, `TrangThai`) VALUES
(1, 'Nguyễn Văn D', 'Tân Phú', '0963717300', 5, 1),
(2, 'Nguyen van khach moi', 'Tân Phú', '0963717300', 8, 1),
(3, 'Nguyen Khach Hang', 'Tan Phu', '0963717300', 7, 1),
(9, 'Nguyễn Văn A', 'Tân Phú', '0963717300', 11, 1),
(12, 'Nguyễn Văn BCDEDER', 'hcm', '0963714568', 18, 1),
(16, 'Nguyễn Văn B', 'hcm', '0963717845', 22, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKhuyenMai` varchar(50) NOT NULL,
  `TenKhuyenMai` varchar(50) NOT NULL,
  `MoTa` varchar(50) NOT NULL,
  `TiLeGiam` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKhuyenMai`, `TenKhuyenMai`, `MoTa`, `TiLeGiam`) VALUES
('#', '#', '#', 0),
('KM_001', 'Mung sinh nhat cua hang', 'Cac doi giay ap dung se duoc giam 15%', 15),
('KM_002', 'Mung worldcup ', 'Cac doi giay ap dung se duoc giam 10%', 10),
('KM_003', 'Mung viet nam vo dich Sea Game', 'Cac doi giay ap dung se duoc giam 20%', 20),
('KM_005', 'Mua Euro', 'Cac giay ap dung duoc giam 7%', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` varchar(50) NOT NULL,
  `Quyen` tinyint(1) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `TenNhanVien` varchar(50) NOT NULL,
  `SDT` varchar(50) NOT NULL,
  `MaTaiKhoan` int(50) NOT NULL,
  `TrangThai` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `Quyen`, `DiaChi`, `TenNhanVien`, `SDT`, `MaTaiKhoan`, `TrangThai`) VALUES
('1', 1, 'Tan phu hoa binh', 'Nguyễn Văn Admin', '0987415423', 1, 1),
('2', 0, 'Tân Phú', 'Nguyễn Văn Kho', '0963717300', 2, 1),
('3', 0, 'Tân Phú', 'Lê Nguyễn Bán Hàng', '0963717300', 3, 1),
('4', 0, 'Tân Phú', 'Nguyễn Văn Kho', '0963717300', 6, 0),
('5', 0, 'Tân Phú', 'Nguyễn Văn A', '0963717300', 9, 1),
('6', 0, 'Tân Phú', 'Nguyễn Văn A', '0963717300', 10, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanquyen`
--

CREATE TABLE `phanquyen` (
  `MaQuyen` varchar(50) NOT NULL,
  `MaChiTiet` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phanquyen`
--

INSERT INTO `phanquyen` (`MaQuyen`, `MaChiTiet`) VALUES
('Admin', 'd'),
('Admin', 'dh'),
('Admin', 'dm'),
('Admin', 'h'),
('Admin', 'km'),
('Admin', 'nd'),
('Admin', 'pn'),
('Admin', 'pq'),
('Admin', 'sp'),
('Admin', 'tc'),
('NVBanHang', 'dh'),
('NVBanHang', 'dm'),
('NVBanHang', 'km'),
('NVBanHang', 'sp'),
('QLKho', 'dm'),
('QLKho', 'h'),
('QLKho', 'km'),
('QLKho', 'pn'),
('QLKho', 'sp'),
('QLKho', 'tc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhaphang`
--

CREATE TABLE `phieunhaphang` (
  `MaPhieu` int(11) NOT NULL,
  `NgayTao` date NOT NULL,
  `TongDon` int(11) NOT NULL,
  `MaHang` varchar(50) NOT NULL,
  `MaTaiKhoan` int(50) NOT NULL,
  `TrangThai` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhaphang`
--

INSERT INTO `phieunhaphang` (`MaPhieu`, `NgayTao`, `TongDon`, `MaHang`, `MaTaiKhoan`, `TrangThai`) VALUES
(1, '2023-11-10', 15600, 'MH-001', 1, 1),
(2, '2023-11-10', 462, 'MH-001', 1, 1),
(3, '2023-11-10', 60000, 'MH-001', 1, 1),
(4, '2023-11-10', 60000, 'MH-001', 1, 1),
(5, '2023-11-11', 310, 'MH-001', 1, 1),
(6, '2023-11-11', 300, 'MH-002', 1, 1),
(7, '2023-11-11', 225, 'MH-002', 1, 1),
(8, '2023-11-11', 3000000, 'MH-002', 1, 1),
(10, '2023-11-11', 81036, 'MH-001', 1, 1),
(11, '2023-11-13', 5346, 'MH-002', 1, 1),
(12, '2023-11-13', 2054025, 'MH-001', 1, 1),
(14, '2023-11-14', 120000000, 'MH-001', 1, 1),
(15, '2023-11-14', 700000, 'MH-001', 2, 1),
(16, '2023-11-15', 156000, 'MH-001', 1, 1),
(19, '2023-11-18', 1820, 'MH-001', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `MaQuyen` varchar(50) NOT NULL,
  `TenQuyen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`MaQuyen`, `TenQuyen`) VALUES
('Admin', 'Quản lý'),
('NVBanHang', 'Nhân viên bán hàng'),
('QLKho', 'Quản lý kho'),
('User', 'Thành viên đăng ký');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(50) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `MaKhuyenMai` varchar(50) NOT NULL,
  `AnhChinh` varchar(50) NOT NULL,
  `MaDM` varchar(50) NOT NULL,
  `MoTa` text NOT NULL,
  `NgayTao` date NOT NULL,
  `MaHang` varchar(50) NOT NULL,
  `TrangThai` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `Ten`, `MaKhuyenMai`, `AnhChinh`, `MaDM`, `MoTa`, `NgayTao`, `MaHang`, `TrangThai`) VALUES
('001', 'ADIDAS NEMEZIZ 19.3 TF TRẮNG XANH MUTATOR 2020 PAC', 'KM_001', '19-05-2023/LOGO.jpg                      ', 'DM-1', '&lt;p&gt;helloo&lt;/p&gt;\r\n', '2021-09-23', 'MH-001', 0),
('002', 'ADIDAS COPA SENSE.3 TF GAME DATA PACK - GZ1366', 'KM_002', '002.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2022-06-23', 'MH-001', 1),
('003', 'ADIDAS PREDATOR EDGE.3 L TF - GV8527 Data Game Pac', 'KM_002', '003.jpg  ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2022-06-23', 'MH-001', 1),
('004', ' ADIDAS PREDATOR EDGE .1 TF GW9997 SAPPHIRE EDGE', 'KM_003', '004.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2021-12-10', 'MH-001', 1),
('005', 'ADIDAS X SPEEDPORTAL.1 TF GW8973 GAME DATA PACK - ', 'KM_002', '005.jpg  ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2021-12-12', 'MH-001', 1),
('006', 'ADIDAS X SPEEDPORTAL .1 FG GW8426 GAME DATA PACK', 'KM_001', '006.jpg ', 'DM-2', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-03-11', 'MH-001', 1),
('007', 'ADIDAS PREDATOR MUTATOR 20.1 FG EG1602', '#', '007.jpg ', 'DM-2', '&lt;p&gt;#&lt;/p&gt;\r\n', '2021-03-11', 'MH-001', 1),
('008', 'ADIDAS X SPEEDFLOW .1 FG GW7456 DIAMOND EDGE PACK ', '#', '008.jpg', 'DM-2', '#', '2021-03-11', 'MH-001', 1),
('010', 'NIKE ZOOM MERCURIAL VAPOR 15 PRO TF TRẮNG', '#', '010.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-02-10', 'MH-002', 1),
('011', 'NIKE GRIPKNIT PHANTOM GX ELITE FG', '#', '011.jpg ', 'DM-2', '&lt;p&gt;#&lt;/p&gt;\r\n', '2020-09-10', 'MH-002', 1),
('012', 'NIKE TIEMPO LEGEND 9 ELITE FG CZ8482-075 RECHARGE ', '#', '012.jpg', 'DM-2', '#', '2022-09-11', 'MH-002', 1),
('013', 'NIKE MERCURIAL SUPERFLY 8 ELITE FG CV0958-760 MOTI', '#', '013.jpg ', 'DM-2', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-09-11', 'MH-002', 1),
('016', ' NIKE TIEMPO LEGEND 9 ACADEMY TF WORLD CUP', '#', '016.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2020-09-10', 'MH-002', 1),
('017', 'NIKE TIEMPO REACT LEGEND 9 PRO TF WORLD CUP', '#', '017.jpg', 'DM-1', '#', '2021-09-10', 'MH-002', 0),
('018', 'NIKE TIEMPO REACT LEGEND 9 PRO TF', '#', '018.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2021-09-10', 'MH-002', 1),
('019', ' NIKE ZOOM MERCURIAL VAPOR 15 PRO TF HỒNG', '#', '019.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-02-10', 'MH-002', 1),
('020', '  PUMA ULTRA ULTIMATE CAGE TF 10689301 FASTEST PAC', 'KM_001', '020.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-02-10', 'MH-033', 1),
('021', 'PUMA ULTRA 1.3 FG/AG 106477-02 FASTER FOOTBALL PAC', '#', '021.jpg ', 'DM-2', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-01-10', 'MH-033', 1),
('022', 'PUMA FUTURE Z NEYMAR X COPA AMERICA FG 10684201', '#', '022.jpg ', 'DM-2', '&lt;p&gt;#&lt;/p&gt;\r\n', '2022-01-10', 'MH-033', 1),
('031', 'GIÀY PAN VIGOR X TF ĐẾ ĐINH', '#', '031.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-07-11', 'MH-021', 1),
('032', 'GIÀY PAN VIGOR X LTD XANH DƯƠNG', '#', '032.jpg ', 'DM-4', '&lt;p&gt;#&lt;/p&gt;\r\n', '2022-07-11', 'MH-021', 1),
('033', 'GIÀY PAN WAVE II LEGEND IC ĐEN', '#', '033.jpg ', 'DM-4', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-03-11', 'MH-021', 1),
('034', 'GIÀY PAN VIGOR X IC ĐẾ BẰNG', '#', '034.jpg ', 'DM-4', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-02-11', 'MH-021', 1),
('035', 'GIÀY PAN SUPER SONIC IC ĐẾ BẰNG', '#', '035.jpg', 'DM-4', '#', '2023-02-11', 'MH-021', 1),
('036', 'PHANTOM VSN ACADEMY BRIGHT CRIMSON IC', '#', '035.jpg  ', 'DM-4', '&lt;p&gt;#&lt;/p&gt;\r\n', '2023-02-11', 'MH-021', 1),
('041', 'NIKE JR. MERCURIAL VAPOR 14 ACADEMY TF CV0822-474 ', '#', '041.jpg ', 'DM-3', '&lt;p&gt;#&lt;/p&gt;\r\n', '2022-02-11', 'MH-002', 1),
('042', 'NIKE PHANTOM VNM ACADEMY TF KIDS AO0377-600', '#', '042.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 1),
('043', 'NIKE PHANTOM VSN ACADEMY TF KIDS AR4343-060', '#', '043.jpg ', 'DM-3', '&lt;p&gt;#&lt;/p&gt;\r\n', '2022-02-11', 'MH-002', 1),
('044', '  NIKE TIEMPO LEGEND 9 ACADEMY TF FOR KIDS', '#', '044.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sosize`
--

CREATE TABLE `sosize` (
  `MaSP` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Size` int(11) NOT NULL,
  `GiaBan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sosize`
--

INSERT INTO `sosize` (`MaSP`, `SoLuong`, `Size`, `GiaBan`) VALUES
('002', 45778, 40, 20000),
('002', 0, 41, 21000),
('002', 0, 42, 22000),
('002', 0, 43, 23000),
('003', 20, 40, 23000),
('003', 0, 41, 50000),
('004', 36, 20, 25000),
('004', 0, 40, 50000),
('005', 14, 35, 24000),
('005', 10, 42, 42000),
('006', 9, 39, 39000),
('006', 0, 40, 40000),
('007', 0, 30, 30000),
('007', 45, 50, 20000),
('010', 45, 30, 46000),
('010', 0, 35, 40000),
('011', 0, 45, 45000),
('011', 0, 60, 40000),
('013', 54, 41, 30000),
('013', 0, 42, 42000),
('016', 14, 40, 50000),
('016', 4, 42, 42000),
('018', 0, 23, 23000),
('018', 20, 30, 32000),
('019', 0, 20, 23000),
('019', 0, 50, 50000),
('021', 0, 23, 23000),
('021', 0, 45, 42000),
('022', 0, 30, 30000),
('022', 0, 35, 35000),
('031', 0, 23, 23000),
('031', 0, 25, 25000),
('032', 0, 41, 40000),
('032', 0, 42, 42000),
('033', 0, 23, 32000),
('033', 0, 41, 41000),
('034', 0, 30, 35000),
('034', 0, 35, 35000),
('036', 0, 23, 30000),
('036', 0, 25, 20000),
('041', 0, 30, 30000),
('041', 0, 35, 35000),
('043', 0, 50, 50000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTaiKhoan` int(50) NOT NULL,
  `TenDN` varchar(50) NOT NULL,
  `MatKhau` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `NgayTao` date NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL,
  `Quyen` varchar(50) NOT NULL,
  `TrangThai` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTaiKhoan`, `TenDN`, `MatKhau`, `Email`, `NgayTao`, `TinhTrang`, `Quyen`, `TrangThai`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'lengocduong003@gmail.com', '2023-11-05', 1, 'Admin', 1),
(2, 'nvkho', '827ccb0eea8a706c4c34a16891f84e7b', 'nvkho@gmail.com', '2023-11-05', 1, 'QLKho', 1),
(3, 'nvbanhang', '827ccb0eea8a706c4c34a16891f84e7b', 'nvbanhang@gmail.com', '2023-11-05', 1, 'NVBanHang', 1),
(4, 'khachhang1', '827ccb0eea8a706c4c34a16891f84e7b', 'lengocduong003@gmail.com', '2023-11-10', 1, 'User', 0),
(5, 'khachhangmoinhat', '827ccb0eea8a706c4c34a16891f84e7b', 'lengocduong3@gmail.com', '2023-11-11', 1, 'User', 1),
(6, 'nvkho', '827ccb0eea8a706c4c34a16891f84e7b', '', '2023-11-11', 1, 'User', 0),
(7, 'khachhanghi', '827ccb0eea8a706c4c34a16891f84e7b', 'lengocduong00@gmail.com', '2023-11-15', 1, 'User', 1),
(8, 'khachhangm', '827ccb0eea8a706c4c34a16891f84e7b', 'lengocduong0@gmail.com', '2023-11-15', 1, 'User', 1),
(9, 'adminnehihi', '827ccb0eea8a706c4c34a16891f84e7b', 'quanlynehihi@gmail.com', '2023-11-15', 0, 'Admin', 1),
(10, 'nhanvienmoi', '827ccb0eea8a706c4c34a16891f84e7b', 'nhanvienmoi@gmail.com', '2023-11-16', 1, 'Admin', 1),
(11, 'khachhangmneeee', '827ccb0eea8a706c4c34a16891f84e7b', 'lengocduong005@gmail.com', '2023-11-16', 1, 'Admin', 1),
(18, 'khachhang', '827ccb0eea8a706c4c34a16891f84e7b', 'lengocduong4231@gmail.com', '2023-11-06', 1, 'User', 1),
(22, 'khachhang123', '827ccb0eea8a706c4c34a16891f84e7b', 'lengocduong00354@gmail.com', '2023-11-21', 1, 'User', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MaSP`,`MaDonHang`),
  ADD KEY `MaDonHang` (`MaDonHang`);

--
-- Chỉ mục cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD KEY `MaPhieu` (`MaPhieu`),
  ADD KEY `chitietphieunhap_ibfk_2` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  ADD PRIMARY KEY (`MaChiTiet`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDM`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaTaiKhoan`,`MaSP`,`Size`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `hang`
--
ALTER TABLE `hang`
  ADD PRIMARY KEY (`MaHang`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKhach`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKhuyenMai`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`MaQuyen`,`MaChiTiet`),
  ADD KEY `MaChiTiet` (`MaChiTiet`);

--
-- Chỉ mục cho bảng `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  ADD PRIMARY KEY (`MaPhieu`),
  ADD KEY `MaHang` (`MaHang`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`MaQuyen`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaHang` (`MaHang`),
  ADD KEY `KhuyenMai` (`MaKhuyenMai`),
  ADD KEY `MaDM` (`MaDM`);

--
-- Chỉ mục cho bảng `sosize`
--
ALTER TABLE `sosize`
  ADD PRIMARY KEY (`MaSP`,`Size`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTaiKhoan`),
  ADD KEY `Quyen` (`Quyen`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKhach` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  MODIFY `MaPhieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTaiKhoan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `chitietdonhang_ibfk_3` FOREIGN KEY (`MaDonHang`) REFERENCES `donhang` (`MaDonHang`);

--
-- Các ràng buộc cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `chitietphieunhap_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `chitietphieunhap_ibfk_3` FOREIGN KEY (`MaPhieu`) REFERENCES `phieunhaphang` (`MaPhieu`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD CONSTRAINT `phanquyen_ibfk_1` FOREIGN KEY (`MaQuyen`) REFERENCES `quyen` (`MaQuyen`),
  ADD CONSTRAINT `phanquyen_ibfk_2` FOREIGN KEY (`MaChiTiet`) REFERENCES `chitietquyen` (`MaChiTiet`);

--
-- Các ràng buộc cho bảng `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  ADD CONSTRAINT `phieunhaphang_ibfk_1` FOREIGN KEY (`MaHang`) REFERENCES `hang` (`MaHang`),
  ADD CONSTRAINT `phieunhaphang_ibfk_2` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaHang`) REFERENCES `hang` (`MaHang`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`MaKhuyenMai`) REFERENCES `khuyenmai` (`MaKhuyenMai`),
  ADD CONSTRAINT `sanpham_ibfk_3` FOREIGN KEY (`MaDM`) REFERENCES `danhmuc` (`MaDM`);

--
-- Các ràng buộc cho bảng `sosize`
--
ALTER TABLE `sosize`
  ADD CONSTRAINT `sosize_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`Quyen`) REFERENCES `quyen` (`MaQuyen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
