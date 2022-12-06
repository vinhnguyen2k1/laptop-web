-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 06, 2022 lúc 06:00 AM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlyshoplaptop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `idCart` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `total` int(11) NOT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCart`),
  KEY `cart_ibfk_1` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`idCart`, `idUser`, `name`, `phone`, `address`, `note`, `total`, `date`) VALUES
(54, 10, 'Tráº§n Táº¥n TÃ i', 372998712, '9/5, 152 Ä‘Æ°á»ng cao lá»—, phÆ°á»ng 4 , quáº­n 8, tp^hcm', '', 20508145, 1669488166),
(55, 11, 'HoÃ ng Ngá»c Diá»‡p', 372998712, '9/5, 152 Ä‘Æ°á»ng cao lá»—, phÆ°á»ng 4 , quáº­n 8, tp^hcm', '', 39001000, 1669488207);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `i4user`
--

DROP TABLE IF EXISTS `i4user`;
CREATE TABLE IF NOT EXISTS `i4user` (
  `idI4` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  PRIMARY KEY (`idI4`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `i4user`
--

INSERT INTO `i4user` (`idI4`, `idUser`, `email`, `fullname`, `address`, `phone`, `sex`) VALUES
(2, 2, 'tantaid19@gmail-com', 'Tráº§n Táº¥n TÃ i', '9/5, 152 Ä‘Æ°á»ng cao lá»—, phÆ°á»ng 4 , quáº­n 8, tp^hcm ', '0372998712', 'nam'),
(6, 10, 'tantaid19@gmail-com', 'Tráº§n Táº¥n TÃ i', '9/5, 152 Ä‘Æ°á»ng cao lá»—, phÆ°á»ng 4 , quáº­n 8, tp^hcm', '0372998712', 'nam'),
(7, 11, 'tantaid19@gmail-com', 'HoÃ ng Ngá»c Diá»‡p', '9/5, 152 Ä‘Æ°á»ng cao lá»—, phÆ°á»ng 4 , quáº­n 8, tp^hcm', '0372998712', 'nu'),
(8, 12, 'tantaid19@gmail-com', 'Tráº§n Táº¥n TÃ i', '9/5, 152 Ä‘Æ°á»ng cao lá»—, phÆ°á»ng 4 , quáº­n 8, tp^hcm', '0372998712', 'nam'),
(30, 34, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oder`
--

DROP TABLE IF EXISTS `oder`;
CREATE TABLE IF NOT EXISTS `oder` (
  `idOder` int(11) NOT NULL AUTO_INCREMENT,
  `idCart` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`idOder`),
  KEY `idCart` (`idCart`),
  KEY `oder_ibfk_2` (`idProduct`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `oder`
--

INSERT INTO `oder` (`idOder`, `idCart`, `idProduct`, `quantity`) VALUES
(62, 54, 4, 1),
(63, 55, 3, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(200) NOT NULL,
  `title` varchar(300) NOT NULL,
  `review` varchar(1500) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(3) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  `manufacturer` varchar(10) NOT NULL,
  PRIMARY KEY (`idProduct`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`idProduct`, `img`, `title`, `review`, `price`, `discount`, `quantity`, `manufacturer`) VALUES
(1, './assets/image/new.png', '<p>[Má»›i 99%] Dell Inspiron 15 5510 (Core i5-11320H, 8GB, 256GB, Iris Xe Graphics, 15.6&#39;&#39; FHD)&nbsp;</p>\r\n', '<p>Náº¿u báº¡n l&agrave; má»™t fan cá»©ng cá»§a d&ograve;ng m&aacute;y&nbsp;<a href=\"&amp;&amp;https://laptopaz.vn/tim?q=Dell&amp;&amp;\" target=\"&amp;&amp;_blank&amp;&amp;\">Dell</a>&nbsp;- bá»n bá»‰, á»•n Ä‘á»‹nh v&agrave; muá»‘n sá»Ÿ há»¯u má»™t chiáº¿c&nbsp;<a href=\"&amp;&amp;https://laptopaz.vn/laptop-mong-nhe-cao-cap.html&amp;&amp;\" target=\"&amp;&amp;_blank&amp;&amp;\">laptop vÄƒn ph&ograve;ng cao cáº¥p</a>, sang trá»ng v&agrave; hiá»‡u nÄƒng Ä‘&aacute;ng gá»m th&igrave; chiáº¿c Dell Inspiron 5510 l&agrave; má»™t trong nhá»¯ng chiáº¿c m&aacute;y sáº½ khiáº¿n báº¡n v&ocirc; c&ugrave;ng h&agrave;i l&ograve;ng. H&atilde;y c&ugrave;ng&nbsp;<a href=\"&amp;&amp;https://laptopaz.vn/&amp;&amp;\" target=\"&amp;&amp;_blank&amp;&amp;\">LaptopAZ</a>&nbsp;Ä‘i t&igrave;m hiá»ƒu chi tiáº¿t vá» chiáº¿c m&aacute;y n&agrave;y ngay th&ocirc;i n&agrave;o!</p>\r\n', 20800999, 0, 1, 'Dell'),
(2, './assets/image/new.png', '<p>[Má»›i 99%] Dell Inspiron 15 5510 (Core i5-11320H, 8GB, 256GB, Iris Xe Graphics, 15.6&#39;&#39; FHD) Test</p>\r\n', '<p>Náº¿u báº¡n l&agrave; má»™t fan cá»©ng cá»§a d&ograve;ng m&aacute;y&nbsp;<a href=\"&amp;&amp;https://laptopaz.vn/tim?q=Dell&amp;&amp;\" target=\"&amp;&amp;_blank&amp;&amp;\">Dell</a>&nbsp;- bá»n bá»‰, á»•n Ä‘á»‹nh v&agrave; muá»‘n sá»Ÿ há»¯u má»™t chiáº¿c&nbsp;<a href=\"&amp;&amp;https://laptopaz.vn/laptop-mong-nhe-cao-cap.html&amp;&amp;\" target=\"&amp;&amp;_blank&amp;&amp;\">laptop vÄƒn ph&ograve;ng cao cáº¥p</a>, sang trá»ng v&agrave; hiá»‡u nÄƒng Ä‘&aacute;ng gá»m th&igrave; chiáº¿c Dell Inspiron 5510 l&agrave; má»™t trong nhá»¯ng chiáº¿c m&aacute;y sáº½ khiáº¿n báº¡n v&ocirc; c&ugrave;ng h&agrave;i l&ograve;ng. H&atilde;y c&ugrave;ng&nbsp;<a href=\"&amp;&amp;https://laptopaz.vn/&amp;&amp;\" target=\"&amp;&amp;_blank&amp;&amp;\">LaptopAZ</a>&nbsp;Ä‘i t&igrave;m hiá»ƒu chi tiáº¿t vá» chiáº¿c m&aacute;y n&agrave;y ngay th&ocirc;i n&agrave;o!</p>\r\n', 21909801, 44, 100, 'Dell'),
(3, './assets/image/new.png', '<p>Má»›i 100%</p>\r\n', '<p>Test</p>\r\n', 19500500, 0, 1, 'Think Pad'),
(4, './Assets/Image/1.Jpg', '<p>[Má»›i 99%] Dell Inspiron 15 5510 (Core i5-11320H, 8GB, 256GB, Iris Xe Graphics, 15.6&#39;&#39; FHD) Test&nbsp;Test&nbsp;Test&nbsp;Test&nbsp;Test</p>\r\n', '<p>[Má»›i 99%] Dell Inspiron 15 5510 (Core i5-11320H, 8GB, 256GB, Iris Xe Graphics, 15.6&#39;&#39; FHD) Test</p>\r\n', 28884712, 29, 22, 'Sony VAIO'),
(5, './assets/image/new.png', '<p>[Má»›i 99%] Dell Inspiron 15 5510 (Core i5-11320H, 8GB, 256GB, Iris Xe Graphics, 15.6&#39;&#39; FHD)&nbsp;</p>\r\n', '<p>[Má»›i 99%] Dell Inspiron 15 5510 (Core i5-11320H, 8GB, 256GB, Iris Xe Graphics, 15.6&#39;&#39; FHD)&nbsp;</p>\r\n', 21319802, 22, 1, 'Sam Sung'),
(6, './Assets/Image/1.Jpg', '<p>[Má»›i 99%] Dell Inspiron 15 5510 (Core i5-11320H, 8GB, 256GB, Iris Xe Graphics, 15.6&#39;&#39; FHD)&nbsp;</p>\r\n', '<p>[Má»›i 99%] Dell Inspiron 15 5510 (Core i5-11320H, 8GB, 256GB, Iris Xe Graphics, 15.6&#39;&#39; FHD)&nbsp;</p>\r\n', 123123124, 12, 0, 'Think Pad'),
(7, './Assets/Image/new.png', '<p>122</p>\r\n', '<p>1</p>\r\n', 55555555, 90, 1, 'Lenovo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `idSlider` int(11) NOT NULL AUTO_INCREMENT,
  `imgSlider` varchar(200) NOT NULL,
  `linkSlider` varchar(200) NOT NULL DEFAULT '#',
  PRIMARY KEY (`idSlider`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `slider`
--

INSERT INTO `slider` (`idSlider`, `imgSlider`, `linkSlider`) VALUES
(8, './assets/image/Untitled.png', '#'),
(14, './assets/image/mi-lapotops.jpg', '#'),
(24, './assets/image/15_Jul61774c36e93704bf449eabe1846e635f.jpg', '#');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'user',
  `creat_date` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `status`, `creat_date`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1668602722),
(10, 'kingazttt', '78d806042b564f67ebc123366ba9350b', 'user', 1669220867),
(11, 'Hoangngocdiep', 'c4ca4238a0b923820dcc509a6f75849b', 'admin', 1669224485),
(12, 'newacc', 'f5bb0c8de146c67b44babbf4e6584cc0', 'user', 1669275803),
(13, '123123', '8d4646eb2d7067126eb08adb0672f7bb', 'user', 1669648339),
(16, '242222222', 'f5bb0c8de146c67b44babbf4e6584cc0', 'user', 1669648406),
(22, 'admin2', 'f5bb0c8de146c67b44babbf4e6584cc0', 'user', 1670168849),
(34, 'kingaztttttt', 'f5bb0c8de146c67b44babbf4e6584cc0', 'user', 1670169450);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `i4user`
--
ALTER TABLE `i4user`
  ADD CONSTRAINT `i4user_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `oder`
--
ALTER TABLE `oder`
  ADD CONSTRAINT `oder_ibfk_1` FOREIGN KEY (`idCart`) REFERENCES `cart` (`idCart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oder_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
