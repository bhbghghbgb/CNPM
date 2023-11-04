-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 04, 2023 lúc 02:57 PM
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
('001', 2, 10, 1190000, 11900000, 0),
('001', 44, 1, 1011500, 1011500, 0),
('002', 45, 8, 1701000, 13608000, 0),
('003', 5, 1, 1900000, 1900000, 0),
('003', 49, 1, 108000, 108000, 44),
('004', 46, 3, 1760000, 5280000, 0),
('006', 44, 1, 3230000, 3230000, 0),
('007', 3, 1, 3100000, 3100000, 0),
('007', 4, 2, 3100000, 6200000, 0),
('007', 47, 1, 3100000, 3100000, 0),
('007', 48, 1, 3100000, 3100000, 0),
('008', 7, 1, 3500000, 3500000, 0),
('008', 46, 1, 3500000, 3500000, 0),
('010', 8, 1, 2900000, 2900000, 0),
('013', 5, 1, 4100000, 4100000, 0),
('013', 6, 1, 4100000, 4100000, 0),
('013', 9, 1, 4100000, 4100000, 0),
('021', 10, 1, 3500000, 3500000, 0),
('035', 47, 1, 540000, 540000, 0);

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
('001', 1, 55, 20000, 30000, 1, 25),
('001', 16, 2, 12, 24, 0, 36),
('001', 16, 2, 12, 24, 0, 39),
('001', 18, 212, 121, 25652, 0, 36),
('001', 20, 5, 15, 75, 0, 36),
('001', 20, 5, 15, 75, 0, 39),
('001', 22, 21, 2000, 42000, 0, 36),
('003', 22, 17, 20, 340, 0, 42),
('003', 22, 5, 10, 50, 0, 42),
('001', 22, 5, 20, 100, 0, 36),
('001', 22, 5, 15, 75, 0, 36),
('001', 22, 5, 20, 100, 0, 36),
('003', 22, 12, 13, 156, 0, 42),
('001', 28, 5, 20000, 100000, 0, 36),
('001', 29, 5, 20000, 100000, 0, 36),
('001', 30, 5, 20, 100, 0, 36),
('001', 31, 20, 5, 100, 0, 36),
('001', 31, 5, 15, 75, 0, 36),
('001', 1, 2, 23, 46, 0, 36),
('001', 35, 12, 200, 2400, 0, 36),
('003', 36, 12, 23, 276, 0, 42),
('004', 38, 45, 12, 540, 0, 40),
('004', 40, 1212, 12, 14544, 0, 40),
('004', 42, 30, 2, 60, 0, 40);

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
('bd', 'Bài đăng', 'Quản lý bài đăng'),
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
('DM-1', 'Giay dinh san co nhan ', 1),
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
(2, 2, '2023-12-31', 1, 11900000),
(3, 2, '2023-07-12', 1, 3100000),
(4, 2, '2023-08-09', 1, 6200000),
(5, 3, '2023-09-13', 1, 6000000),
(6, 2, '2023-09-17', 1, 4100000),
(7, 2, '2023-02-17', 1, 3500000),
(8, 2, '2023-02-28', 1, 2900000),
(9, 3, '2023-05-28', 1, 4100000),
(10, 2, '2023-06-23', 1, 3500000),
(44, 11, '2023-09-11', 1, 4241500),
(45, 11, '2023-09-11', 1, 13608000),
(46, 1, '2023-09-12', 1, 8780000),
(47, 1, '2023-09-12', 1, 3640000),
(48, 11, '2023-09-22', 0, 3100000),
(49, 1, '2023-11-04', 0, 108000),
(50, 1, '2023-11-04', 0, 0);

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
('MH-021', 'Pan Thailand', '2020-06-18', 1),
('MH-033', 'Puma', '2023-02-23', 1),
('MH-rtes', 'ádđ', '2023-05-17', 0);

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
(1, 'Le Trung Kien', '187 Le Van Tho Phuong 15 Quan Go Vap', '0908123456', 2, 1),
(2, 'Nguyen Thi Trang', '589/965 Nguyen Kiem Quan Go Vap', '0908878795', 5, 1),
(9, '1', '1', '1', 11, 1),
(10, '12312', '1231231', '123123', 12, 1);

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
('', 1, 'Tan phu', 'admin ne', '0963717300', 1, 1),
('1', 1, '589/965 Le Van Duyet Quan Binh Thanh', 'Nguyen Thi Linh', '0569896512', 3, 1),
('2', 1, '589/965 Le Quang Dinh Quan Binh Thanh', 'Nguyen Van Tai', '0598978954', 4, 1),
('3', 1, '589/965 Le Quang Dinh Quan Binh Thanh', 'Le Kien', '0598978985', 8, 1),
('4', 0, 'Tân Phú', 'Nguyễn Văn Kho', '0963717300', 6, 0),
('5', 0, 'Tân Phú', 'nhanvienkho', '0963717300', 7, 1);

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
('Admin', 'bd'),
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
('BTV', 'bd'),
('BTV', 'dh'),
('BTV', 'pn'),
('QLKho', 'h'),
('QLKho', 'pn'),
('QLKho', 'sp');

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
  `TrangThai` int(2) NOT NULL DEFAULT 1,
  `GhiChu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhaphang`
--

INSERT INTO `phieunhaphang` (`MaPhieu`, `NgayTao`, `TongDon`, `MaHang`, `MaTaiKhoan`, `TrangThai`, `GhiChu`) VALUES
(1, '2023-11-09', 20000, 'MH-002', 3, 1, NULL),
(16, '2023-11-02', 48, 'MH-001', 7, 1, ''),
(18, '2023-11-02', 25652, 'MH-001', 7, 1, ''),
(20, '2023-11-03', 150, 'MH-001', 7, 1, ''),
(22, '2023-11-03', 42390, 'MH-001', 7, 1, ''),
(28, '2023-11-03', 100000, 'MH-001', 7, 1, ''),
(29, '2023-11-03', 100000, 'MH-001', 7, 1, ''),
(30, '2023-11-03', 100, 'MH-001', 7, 1, ''),
(31, '2023-11-03', 100, 'MH-001', 7, 1, ''),
(35, '2023-11-03', 2400, 'MH-001', 1, 1, ''),
(36, '2023-11-03', 276, 'MH-001', 1, 1, ''),
(38, '2023-11-04', 540, 'MH-001', 1, 1, ''),
(40, '2023-11-04', 14544, 'MH-001', 1, 1, ''),
(42, '2023-11-04', 60, 'MH-001', 1, 0, '');

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
('BTV', 'Biên tập viên'),
('QLKho', 'Nhân viên kho'),
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
('002', 'ADIDAS COPA SENSE.3 TF GAME DATA PACK - GZ1366', 'KM_002', '002.jpg', 'DM-1', '#', '2022-06-23', 'MH-001', 1),
('003', 'ADIDAS PREDATOR EDGE.3 L TF - GV8527 Data Game Pac', 'KM_002', '003.jpg', 'DM-1', '#', '2022-06-23', 'MH-001', 1),
('004', ' ADIDAS PREDATOR EDGE .1 TF GW9997 SAPPHIRE EDGE', 'KM_003', '004.jpg', 'DM-1', '#', '2021-12-10', 'MH-001', 1),
('005', 'ADIDAS X SPEEDPORTAL.1 TF GW8973 GAME DATA PACK - ', 'KM_002', '005.jpg ', 'DM-1', '&lt;p&gt;#&lt;/p&gt;\r\n', '2021-12-12', 'MH-001', 1),
('006', 'ADIDAS X SPEEDPORTAL .1 FG GW8426 GAME DATA PACK', 'KM_001', '006.jpg', 'DM-2', '#', '2023-03-11', 'MH-001', 1),
('007', 'ADIDAS PREDATOR MUTATOR 20.1 FG EG1602', '#', '007.jpg', 'DM-2', '#', '2021-03-11', 'MH-001', 1),
('008', 'ADIDAS X SPEEDFLOW .1 FG GW7456 DIAMOND EDGE PACK ', '#', '008.jpg', 'DM-2', '#', '2021-03-11', 'MH-001', 1),
('009', 'ten', '#', '19-05-2023/LOGO(1).jpg ', 'DM-1', '<p>RTGR</p>\r\n', '2023-05-19', 'MH-001', 0),
('010', 'NIKE ZOOM MERCURIAL VAPOR 15 PRO TF TRẮNG', '#', '010.jpg', 'DM-1', '#', '2023-02-10', 'MH-002', 1),
('011', 'NIKE GRIPKNIT PHANTOM GX ELITE FG', '#', '011.jpg', 'DM-2', '#', '2020-09-10', 'MH-002', 1),
('012', 'NIKE TIEMPO LEGEND 9 ELITE FG CZ8482-075 RECHARGE ', '#', '012.jpg', 'DM-2', '#', '2022-09-11', 'MH-002', 1),
('013', 'NIKE MERCURIAL SUPERFLY 8 ELITE FG CV0958-760 MOTI', '#', '013.jpg', 'DM-2', '#', '2023-09-11', 'MH-002', 1),
('014', '34534', '#', ' ', 'DM-1', '<p>45643</p>\r\n', '2023-05-19', 'MH-001', 0),
('015', 'Adidas 1', '#', ' ', 'DM-1', '<p>Si&ecirc;u bền</p>\r\n', '2023-09-12', 'MH-001', 1),
('016', ' NIKE TIEMPO LEGEND 9 ACADEMY TF WORLD CUP', '#', '016.jpg', 'DM-1', '#', '2020-09-10', 'MH-002', 1),
('017', 'NIKE TIEMPO REACT LEGEND 9 PRO TF WORLD CUP', '#', '017.jpg', 'DM-1', '#', '2021-09-10', 'MH-002', 1),
('018', 'NIKE TIEMPO REACT LEGEND 9 PRO TF', '#', '018.jpg', 'DM-1', '#', '2021-09-10', 'MH-002', 1),
('019', ' NIKE ZOOM MERCURIAL VAPOR 15 PRO TF HỒNG', '#', '019.jpg', 'DM-1', '#', '2023-02-10', 'MH-002', 1),
('020', '  PUMA ULTRA ULTIMATE CAGE TF 10689301 FASTEST PAC', '#', '020.jpg', 'DM-1', '#', '2023-02-10', 'MH-033', 1),
('021', 'PUMA ULTRA 1.3 FG/AG 106477-02 FASTER FOOTBALL PAC', '#', '021.jpg', 'DM-2', '#', '2023-01-10', 'MH-033', 1),
('022', 'PUMA FUTURE Z NEYMAR X COPA AMERICA FG 10684201', '#', '022.jpg', 'DM-2', '#', '2022-01-10', 'MH-033', 1),
('023', 'hello', 'KM_001', ' ', 'DM-1', '', '0000-00-00', 'MH-001', 1),
('031', 'GIÀY PAN VIGOR X TF ĐẾ ĐINH', '#', '031.jpg', 'DM-1', '#', '2023-07-11', 'MH-021', 1),
('032', 'GIÀY PAN VIGOR X LTD XANH DƯƠNG', '#', '032.jpg', 'DM-4', '#', '2022-07-11', 'MH-021', 1),
('033', 'GIÀY PAN WAVE II LEGEND IC ĐEN', '#', '033.jpg', 'DM-4', '#', '2023-03-11', 'MH-021', 1),
('034', 'GIÀY PAN VIGOR X IC ĐẾ BẰNG', '#', '034.jpg', 'DM-4', '#', '2023-02-11', 'MH-021', 1),
('035', 'GIÀY PAN SUPER SONIC IC ĐẾ BẰNG', '#', '035.jpg', 'DM-4', '#', '2023-02-11', 'MH-021', 1),
('036', 'PHANTOM VSN ACADEMY BRIGHT CRIMSON IC', '#', '035.jpg', 'DM-4', '#', '2023-02-11', 'MH-021', 1),
('041', 'NIKE JR. MERCURIAL VAPOR 14 ACADEMY TF CV0822-474 ', '#', '041.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 1),
('042', 'NIKE PHANTOM VNM ACADEMY TF KIDS AO0377-600', '#', '042.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 1),
('043', 'NIKE PHANTOM VSN ACADEMY TF KIDS AR4343-060', '#', '043.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 1),
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
('001', 0, 5, 12),
('001', 0, 45, 45),
('003', 14, 42, 145000),
('003', 5, 44, 120000),
('004', 1269, 40, 150000),
('005', 0, 12, 12),
('006', 12, 41, 130000),
('010', 5, 23, 20000);

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
(1, 'TK1', 'c4ca4238a0b923820dcc509a6f75849b', 'TK1@gmail.com', '2023-05-24', 1, 'Admin', 1),
(2, 'TK222', 'c4ca4238a0b923820dcc509a6f75849b', 'TK2@gmail.com', '2023-03-24', 1, 'BTV', 1),
(3, 'TK33423', 'c4ca4238a0b923820dcc509a6f75849b', 'TK3@gmail.com', '2020-03-24', 1, 'BTV', 1),
(4, 'TK444', 'c4ca4238a0b923820dcc509a6f75849b', 'TK4@gmail.com', '2020-12-24', 1, 'BTV', 1),
(5, 'TK5', 'c4ca4238a0b923820dcc509a6f75849b', 'TK5@gmail.com', '2020-12-24', 1, 'User', 1),
(6, 'nvkho', '70873e8580c9900986939611618d7b1e', 'lengocduong003@gmail.com', '2023-11-02', 1, 'QLKho', 0),
(7, 'nvkhohang', 'c4ca4238a0b923820dcc509a6f75849b', 'lengocduong003@gmail.com', '2023-11-02', 1, 'QLKho', 1),
(8, 'kiennhanvien', 'c4ca4238a0b923820dcc509a6f75849b', 'a@gmail.com', '2023-05-14', 1, 'User', 1),
(11, '1', 'c4ca4238a0b923820dcc509a6f75849b', '111@111.111', '2023-09-11', 1, 'User', 1),
(12, '1231', '202cb962ac59075b964b07152d234b70', '1231', '2023-09-22', 1, 'User', 1);

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
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKhach` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  MODIFY `MaPhieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTaiKhoan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
