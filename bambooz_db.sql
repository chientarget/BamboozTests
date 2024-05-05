-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:6060
-- Thời gian đã tạo: Th5 05, 2024 lúc 11:11 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bambooz_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `airfield` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `address`
--

INSERT INTO `address` (`id`, `city`, `country`, `airfield`) VALUES
(1, 'Hà Nội', 'Việt Nam', 'Sân bay Nội Bài'),
(2, 'TP.Hồ Chí Minh', 'Việt Nam', 'Sân bay Tân Sơn Nhất'),
(3, 'Đà Nẵng', 'Việt Nam', 'Sân bay Đà Nẵng'),
(4, 'Hải Phòng', 'Việt Nam', 'Sân bay Cát Bi'),
(5, 'Nha Trang', 'Việt Nam', 'Sân bay Cam Ranh'),
(6, 'Vũng Tàu', 'Việt Nam', 'Sân bay Cảng hàng không Phú Cường'),
(7, 'Quy Nhơn', 'Việt Nam', 'Sân bay Phù Cát'),
(8, 'Cần Thơ', 'Việt Nam', 'Sân bay Cần Thơ'),
(9, 'Huế', 'Việt Nam', 'Sân bay Phú Bài'),
(10, 'Bắc Giang', 'Việt Nam', 'Sân bay Nội Bài');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `flight_id` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `bookingDate` datetime DEFAULT NULL,
  `seatNumber` varchar(10) DEFAULT NULL,
  `roundTrip` tinyint(1) DEFAULT NULL,
  `seatClassId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `booking`
--

INSERT INTO `booking` (`id`, `customer_id`, `flight_id`, `bookingDate`, `seatNumber`, `roundTrip`, `seatClassId`) VALUES
(1, 1, 'VN124', '2024-01-27 14:30:00', 'A12', 0, 1),
(2, 2, 'VN457', '2024-01-28 09:45:00', 'B15', 1, 2),
(3, 3, 'VN790', '2024-01-29 17:00:00', 'C8', 0, 3),
(4, 4, 'VN102', '2024-01-30 13:15:00', 'D20', 1, 4),
(5, 5, 'VN203', '2024-01-31 20:30:00', 'E10', 0, 1),
(6, 6, 'VN304', '2024-02-01 12:45:00', 'F18', 1, 2),
(7, 7, 'VN405', '2024-02-02 08:00:00', 'G14', 0, 3),
(8, 8, 'VN506', '2024-02-03 16:30:00', 'H25', 1, 4),
(9, 9, 'VN607', '2024-02-04 10:45:00', 'I5', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `CMND` varchar(200) DEFAULT NULL,
  `visaCreated` tinyint(1) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `fullName`, `address`, `phone`, `CMND`, `visaCreated`, `username`, `password`, `birth_date`, `email`) VALUES
(1, 'Nguyễn Văn A', '123 Đường ABC, Hà Nội', '0912345678', '123456789012', 1, 'user1', 'password1', '1990-01-01', 'user1@email.com'),
(2, 'Trần Thị B', '456 Đường XYZ, TP.Hồ Chí Minh', '0987654321', '987654321098', 0, 'user2', 'password2', '1985-05-15', 'user2@email.com'),
(3, 'Lê Văn C', '789 Đường LMN, Đà Nẵng', '0912123456', '654321098765', 1, 'user3', 'password3', '1995-08-20', 'user3@email.com'),
(4, 'Phạm Thị D', '101 Đường PQRS, Hải Phòng', '0918765432', '789012345678', 0, 'user4', 'password4', '1988-11-10', 'user4@email.com'),
(5, 'Nguyễn Văn E', '202 Đường UVW, Nha Trang', '0901122334', '543210987654', 1, 'user5', 'password5', '1992-04-25', 'user5@email.com'),
(6, 'Trần Thị F', '303 Đường GHI, Vũng Tàu', '0976543210', '876543210987', 0, 'user6', 'password6', '1998-07-15', 'user6@email.com'),
(7, 'Lê Văn G', '404 Đường JKL, Quy Nhơn', '0987654321', '234567890123', 1, 'user7', 'password7', '1993-09-30', 'user7@email.com'),
(8, 'Phạm Thị H', '505 Đường XYZ, Cần Thơ', '0909876543', '567890123456', 0, 'user8', 'password8', '1987-02-18', 'user8@email.com'),
(9, 'Nguyễn Văn I', '606 Đường ABC, Huế', '0912345678', '012345678901', 1, 'user9', 'password9', '1991-06-05', 'user9@email.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `employee`
--

INSERT INTO `employee` (`id`, `position`, `username`, `password`, `birth_date`, `email`) VALUES
(1, 'Quản lý', 'manager1', 'managerpass1', '1980-10-20', 'manager1@email.com'),
(2, 'Nhân viên', 'staff1', 'staffpass1', '1995-03-25', 'staff1@email.com'),
(3, 'Nhân viên', 'staff2', 'staffpass2', '1992-09-15', 'staff2@email.com'),
(4, 'Quản lý', 'manager2', 'managerpass2', '1978-12-05', 'manager2@email.com'),
(5, 'Nhân viên', 'staff3', 'staffpass3', '1994-07-30', 'staff3@email.com'),
(6, 'Nhân viên', 'staff4', 'staffpass4', '1989-02-14', 'staff4@email.com'),
(7, 'Quản lý', 'manager3', 'managerpass3', '1983-06-28', 'manager3@email.com'),
(8, 'Nhân viên', 'staff5', 'staffpass5', '1996-11-23', 'staff5@email.com'),
(9, 'Nhân viên', 'staff6', 'staffpass6', '1990-04-10', 'staff6@email.com'),
(10, 'Quản lý', 'manager4', 'managerpass4', '1975-08-08', 'manager4@email.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flight`
--

CREATE TABLE `flight` (
  `id` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `arrivalAddressID` int(11) DEFAULT NULL,
  `departureAddressID` int(11) DEFAULT NULL,
  `flightTime` varchar(255) DEFAULT NULL,
  `departureTime` datetime DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `availableSeats` int(11) DEFAULT NULL,
  `totalSeats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `flight`
--

INSERT INTO `flight` (`id`, `arrivalAddressID`, `departureAddressID`, `flightTime`, `departureTime`, `arrivalTime`, `availableSeats`, `totalSeats`) VALUES
('662a61f', 9, 9, '45', '2024-04-10 12:00:00', '2024-04-02 21:00:00', 20, 100),
('662a622', 5, 7, 'sdfsdfsf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 23),
('662a623', 5, 7, 'sdfsdfsf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 23),
('662a65e', 5, 7, 'sdfsdfsf', '2024-04-25 23:16:00', '2024-04-27 21:17:00', 0, 23),
('662a663', 5, 7, 'sdfsdfsf', '2024-04-25 23:16:00', '2024-04-27 21:17:00', 0, 23),
('662a664', 5, 7, 'sdfsdfsf', '2024-04-25 23:16:00', '2024-04-27 21:17:00', 0, 23),
('662a6bb', 2, 1, '2 hours 30 minutes', '2024-04-15 15:00:00', '2024-04-15 17:30:00', 20, 100),
('662a6bc', 5, 1, '1 hours 30 minutes', '2024-03-30 15:00:00', '2024-03-30 16:30:00', 30, 100),
('662a6bd', 2, 1, '2 hours 30 minutes', '2024-04-15 15:00:00', '2024-04-15 15:00:00', 60, 100),
('662a6be', 2, 1, '2 hours 30 minutes', '2021-04-15 15:00:00', '2024-04-15 17:30:00', 70, 100),
('662a6bf', 2, 1, '2 hours 30 minutes', '2024-04-15 15:00:00', '2021-04-15 17:30:00', 80, 100),
('662a6c0', 2, 1, '2 hours 30 minutes', '2024-04-15 15:00:00', '2024-04-15 17:30:00', 30, 50),
('66374b3', 9, 9, 's43', '2024-05-16 16:05:00', '2024-06-09 16:06:00', 20, 100),
('66374b8', 8, 4, '1 TIẾNG OK', '2024-05-01 06:03:00', '2024-05-30 18:03:00', 15, 100),
('66374ba', 8, 8, 'Ằ23F2F23F', '2024-05-11 06:06:00', '2024-06-09 09:09:00', 0, 0),
('VN102', 4, 3, '2.5 giờ', '2024-02-04 09:15:00', '2024-02-04 11:45:00', 90, 130),
('VN124', 1, 2, '2 giờ', '2024-02-01 08:00:00', '2024-02-01 10:00:00', 100, 150),
('VN203', 5, 6, '1 giờ', '2024-02-05 14:45:00', '2024-02-05 15:45:00', 60, 100),
('VN304', 6, 5, '2 giờ', '2024-02-06 18:30:00', '2024-02-06 20:30:00', 110, 160),
('VN405', 7, 8, '1.5 giờ', '2024-02-07 11:00:00', '2024-02-07 12:30:00', 70, 110),
('VN457', 2, 1, '3 giờ', '2024-02-02 12:00:00', '2024-02-02 15:00:00', 120, 180),
('VN506', 8, 7, '2.5 giờ', '2024-02-08 08:45:00', '2024-02-08 11:15:00', 85, 125),
('VN607', 9, 10, '1 giờ', '2024-02-09 13:30:00', '2024-02-09 14:30:00', 1, 100),
('VN708', 10, 9, '2 giờ', '2024-02-10 17:15:00', '2024-02-10 19:15:00', 95, 140),
('VN790', 3, 4, '1.5 giờ', '2024-02-03 16:30:00', '2024-02-03 18:00:00', 80, 120);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `totalAmount` float DEFAULT NULL,
  `departureTime` datetime DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `paymentStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `invoice`
--

INSERT INTO `invoice` (`id`, `booking_id`, `totalAmount`, `departureTime`, `arrivalTime`, `paymentStatus`) VALUES
(1, 1, 50, '2024-02-01 08:00:00', '2024-02-01 10:00:00', 'Đã thanh toán'),
(2, 2, 200, '2024-02-02 12:00:00', '2024-02-02 15:00:00', 'Chờ thanh toán'),
(3, 3, 90, '2024-02-03 16:30:00', '2024-02-03 18:00:00', 'Đã thanh toán'),
(4, 4, 190, '2024-02-04 09:15:00', '2024-02-04 11:45:00', 'Chờ thanh toán'),
(5, 5, 55, '2024-02-05 14:45:00', '2024-02-05 15:45:00', 'Đã thanh toán'),
(6, 6, 220, '2024-02-06 18:30:00', '2024-02-06 20:30:00', 'Chờ thanh toán'),
(7, 7, 65, '2024-02-07 11:00:00', '2024-02-07 12:30:00', 'Đã thanh toán'),
(8, 8, 250, '2024-02-08 08:45:00', '2024-02-08 11:15:00', 'Chờ thanh toán'),
(9, 9, 50, '2024-02-09 13:30:00', '2024-02-09 14:30:00', 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paymentpartner`
--

CREATE TABLE `paymentpartner` (
  `id` int(11) NOT NULL,
  `partner_name` varchar(200) DEFAULT NULL,
  `partner_thumbnail` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `paymentpartner`
--

INSERT INTO `paymentpartner` (`id`, `partner_name`, `partner_thumbnail`) VALUES
(1, 'PaymentCo', 'paymentco_logo.png'),
(2, 'SecurePay', 'securepay_logo.png'),
(3, 'FastPay', 'fastpay_logo.png'),
(4, 'EasyPay', 'easypay_logo.png'),
(5, 'SwiftPay', 'swiftpay_logo.png'),
(6, 'QuickPay', 'quickpay_logo.png'),
(7, 'SimplePay', 'simplepay_logo.png'),
(8, 'SpeedyPay', 'speedypay_logo.png'),
(9, 'RapidPay', 'rapidpay_logo.png'),
(10, 'ExpressPay', 'expresspay_logo.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seatclass`
--

CREATE TABLE `seatclass` (
  `id` int(11) NOT NULL,
  `seat_clazz` varchar(200) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `seat_class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `seatclass`
--

INSERT INTO `seatclass` (`id`, `seat_clazz`, `amount`, `seat_class_id`) VALUES
(1, 'Business', 4690000, NULL),
(2, 'SkyBoss', 3690000, NULL),
(3, 'Veluxe', 1550000, NULL),
(4, 'Eco', 1420000, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seatClassId` (`seatClassId`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arrivalAddressID` (`arrivalAddressID`),
  ADD KEY `departureAddressID` (`departureAddressID`);

--
-- Chỉ mục cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Chỉ mục cho bảng `paymentpartner`
--
ALTER TABLE `paymentpartner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `seatclass`
--
ALTER TABLE `seatclass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seat_class_id` (`seat_class_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT cho bảng `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `paymentpartner`
--
ALTER TABLE `paymentpartner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `seatclass`
--
ALTER TABLE `seatclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`seatClassId`) REFERENCES `seatclass` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`);

--
-- Các ràng buộc cho bảng `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`arrivalAddressID`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `flight_ibfk_2` FOREIGN KEY (`departureAddressID`) REFERENCES `address` (`id`);

--
-- Các ràng buộc cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Các ràng buộc cho bảng `seatclass`
--
ALTER TABLE `seatclass`
  ADD CONSTRAINT `seatclass_ibfk_1` FOREIGN KEY (`seat_class_id`) REFERENCES `seatclass` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
