-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2023 lúc 08:24 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

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
  `Gia` int(11) NOT NULL,
  `TongTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaSP`, `MaDonHang`, `SoLuong`, `Gia`, `TongTien`) VALUES
('001', 2, 10, 1190000, 11900000),
('003', 5, 1, 1900000, 1900000),
('007', 3, 1, 3100000, 3100000),
('007', 4, 2, 3100000, 6200000),
('008', 7, 1, 3500000, 3500000),
('010', 8, 1, 2900000, 2900000),
('013', 5, 1, 4100000, 4100000),
('013', 6, 1, 4100000, 4100000),
('013', 9, 1, 4100000, 4100000),
('021', 10, 1, 3500000, 3500000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `MaSP` varchar(50) NOT NULL,
  `MaPhieu` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Gia` int(11) NOT NULL,
  `TongGia` int(11) NOT NULL,
  `TrangThai` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`MaSP`, `MaPhieu`, `SoLuong`, `Gia`, `TongGia`, `TrangThai`) VALUES
('014', 8, 10, 1000, 10000, 1);

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
(10, 2, '2023-06-23', 0, 3500000);

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
(2, 'Nguyen Thi Trang', '589/965 Nguyen Kiem Quan Go Vap', '0908878795', 5, 1);

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
('1', 1, '589/965 Le Van Duyet Quan Binh Thanh', 'Nguyen Thi Linh', '0569896512', 3, 1),
('2', 1, '589/965 Le Quang Dinh Quan Binh Thanh', 'Nguyen Van Tai', '0598978954', 4, 1),
('3', 1, '589/965 Le Quang Dinh Quan Binh Thanh', 'Le Kien', '0598978985', 8, 1);

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
('BTV', 'pn');

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
(8, '2023-05-19', 10000, 'MH-001', 3, 1);

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
('User', 'Thành viên đăng ký');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(50) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `Gia` int(6) NOT NULL,
  `MaKhuyenMai` varchar(50) NOT NULL,
  `AnhChinh` varchar(50) NOT NULL,
  `MaDM` varchar(50) NOT NULL,
  `MoTa` varchar(50) NOT NULL,
  `NgayTao` date NOT NULL,
  `MaHang` varchar(50) NOT NULL,
  `SLTonKho` int(11) NOT NULL,
  `TrangThai` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `Ten`, `Gia`, `MaKhuyenMai`, `AnhChinh`, `MaDM`, `MoTa`, `NgayTao`, `MaHang`, `SLTonKho`, `TrangThai`) VALUES
('001', 'ADIDAS NEMEZIZ 19.3 TF TRẮNG XANH MUTATOR 2020 PAC', 1190000, 'KM_001', '19-05-2023/LOGO.jpg          ', 'DM-1', '<p><span style=\"font-size:24px\"><span style=\"font-', '2021-09-23', 'MH-001', 99, 1),
('002', 'ADIDAS COPA SENSE.3 TF GAME DATA PACK - GZ1366', 1890000, 'KM_002', '002.jpg', 'DM-1', '#', '2022-06-23', 'MH-001', 90, 1),
('003', 'ADIDAS PREDATOR EDGE.3 L TF - GV8527 Data Game Pac', 1900000, 'KM_002', '003.jpg', 'DM-1', '#', '2022-06-23', 'MH-001', 20, 1),
('004', ' ADIDAS PREDATOR EDGE .1 TF GW9997 SAPPHIRE EDGE', 2200000, 'KM_003', '004.jpg', 'DM-1', '#', '2021-12-10', 'MH-001', 89, 1),
('005', 'ADIDAS X SPEEDPORTAL.1 TF GW8973 GAME DATA PACK - ', 2950000, 'KM_002', '005.jpg', 'DM-1', '#', '2021-12-12', 'MH-001', 76, 1),
('006', 'ADIDAS X SPEEDPORTAL .1 FG GW8426 GAME DATA PACK', 3800000, 'KM_001', '006.jpg', 'DM-2', '#', '2023-03-11', 'MH-001', 80, 1),
('007', 'ADIDAS PREDATOR MUTATOR 20.1 FG EG1602', 3100000, '#', '007.jpg', 'DM-2', '#', '2021-03-11', 'MH-001', 80, 1),
('008', 'ADIDAS X SPEEDFLOW .1 FG GW7456 DIAMOND EDGE PACK ', 3500000, '#', '008.jpg', 'DM-2', '#', '2021-03-11', 'MH-001', 80, 1),
('009', 'ten', 99787, '#', '19-05-2023/LOGO(1).jpg ', 'DM-1', '<p>RTGR</p>\r\n', '2023-05-19', 'MH-001', 0, 0),
('010', 'NIKE ZOOM MERCURIAL VAPOR 15 PRO TF TRẮNG', 2900000, '#', '010.jpg', 'DM-1', '#', '2023-02-10', 'MH-002', 189, 1),
('011', 'NIKE GRIPKNIT PHANTOM GX ELITE FG', 5500000, '#', '011.jpg', 'DM-2', '#', '2020-09-10', 'MH-002', 99, 1),
('012', 'NIKE TIEMPO LEGEND 9 ELITE FG CZ8482-075 RECHARGE ', 3900000, '#', '012.jpg', 'DM-2', '#', '2022-09-11', 'MH-002', 100, 1),
('013', 'NIKE MERCURIAL SUPERFLY 8 ELITE FG CV0958-760 MOTI', 4100000, '#', '013.jpg', 'DM-2', '#', '2023-09-11', 'MH-002', 100, 1),
('014', '34534', 5643453, '#', ' ', 'DM-1', '<p>45643</p>\r\n', '2023-05-19', 'MH-001', 0, 0),
('016', ' NIKE TIEMPO LEGEND 9 ACADEMY TF WORLD CUP', 1690000, '#', '016.jpg', 'DM-1', '#', '2020-09-10', 'MH-002', 100, 1),
('017', 'NIKE TIEMPO REACT LEGEND 9 PRO TF WORLD CUP', 2550000, '#', '017.jpg', 'DM-1', '#', '2021-09-10', 'MH-002', 100, 1),
('018', 'NIKE TIEMPO REACT LEGEND 9 PRO TF', 2550000, '#', '018.jpg', 'DM-1', '#', '2021-09-10', 'MH-002', 101, 1),
('019', ' NIKE ZOOM MERCURIAL VAPOR 15 PRO TF HỒNG', 2950000, '#', '019.jpg', 'DM-1', '#', '2023-02-10', 'MH-002', 190, 1),
('020', '  PUMA ULTRA ULTIMATE CAGE TF 10689301 FASTEST PAC', 2850000, '#', '020.jpg', 'DM-1', '#', '2023-02-10', 'MH-033', 190, 1),
('021', 'PUMA ULTRA 1.3 FG/AG 106477-02 FASTER FOOTBALL PAC', 3500000, '#', '021.jpg', 'DM-2', '#', '2023-01-10', 'MH-033', 190, 1),
('022', 'PUMA FUTURE Z NEYMAR X COPA AMERICA FG 10684201', 6500000, '#', '022.jpg', 'DM-2', '#', '2022-01-10', 'MH-033', 190, 1),
('031', 'GIÀY PAN VIGOR X TF ĐẾ ĐINH', 550000, '#', '031.jpg', 'DM-1', '#', '2023-07-11', 'MH-021', 190, 1),
('032', 'GIÀY PAN VIGOR X LTD XANH DƯƠNG', 1850000, '#', '032.jpg', 'DM-4', '#', '2022-07-11', 'MH-021', 190, 1),
('033', 'GIÀY PAN WAVE II LEGEND IC ĐEN', 990000, '#', '033.jpg', 'DM-4', '#', '2023-03-11', 'MH-021', 190, 1),
('034', 'GIÀY PAN VIGOR X IC ĐẾ BẰNG', 520000, '#', '034.jpg', 'DM-4', '#', '2023-02-11', 'MH-021', 190, 1),
('035', 'GIÀY PAN SUPER SONIC IC ĐẾ BẰNG', 540000, '#', '035.jpg', 'DM-4', '#', '2023-02-11', 'MH-021', 190, 1),
('036', 'PHANTOM VSN ACADEMY BRIGHT CRIMSON IC', 1500000, '#', '035.jpg', 'DM-4', '#', '2023-02-11', 'MH-021', 190, 1),
('041', 'NIKE JR. MERCURIAL VAPOR 14 ACADEMY TF CV0822-474 ', 850000, '#', '041.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 190, 1),
('042', 'NIKE PHANTOM VNM ACADEMY TF KIDS AO0377-600', 1250000, '#', '042.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 190, 1),
('043', 'NIKE PHANTOM VSN ACADEMY TF KIDS AR4343-060', 750000, '#', '043.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 190, 1),
('044', '  NIKE TIEMPO LEGEND 9 ACADEMY TF FOR KIDS', 850000, '#', '044.jpg', 'DM-3', '#', '2022-02-11', 'MH-002', 190, 1);

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
(8, 'kiennhanvien', 'c4ca4238a0b923820dcc509a6f75849b', 'a@gmail.com', '2023-05-14', 1, 'User', 1);

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
  ADD PRIMARY KEY (`MaSP`,`MaPhieu`),
  ADD KEY `MaPhieu` (`MaPhieu`);

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
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKhach` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTaiKhoan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`Quyen`) REFERENCES `quyen` (`MaQuyen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
