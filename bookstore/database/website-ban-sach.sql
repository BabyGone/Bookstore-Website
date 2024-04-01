-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 08:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website-ban-sach`
--

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_khach_hang` int(10) UNSIGNED NOT NULL,
  `ho_ten` varchar(150) NOT NULL,
  `dien_thoai` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `ghi_chu` text NOT NULL,
  `ngay_dat_hang` datetime NOT NULL,
  `thanh_tien` int(10) NOT NULL,
  `trang_thai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id`, `id_khach_hang`, `ho_ten`, `dien_thoai`, `email`, `dia_chi`, `ghi_chu`, `ngay_dat_hang`, `thanh_tien`, `trang_thai`) VALUES
(31, 32, 'Nguyễn Trung Hiếu', '0983742434', 'user1@gmail.com', 'Hà Nam', '', '2024-01-09 05:03:30', 135000, 'Đã thanh toán'),
(32, 32, 'Nguyễn Trung Hiếu', '0983742434', 'user1@gmail.com', 'Hà Nam', '', '2024-01-09 08:05:43', 79200, 'Đã hủy'),
(33, 33, 'Nguyễn Trung Hiếu', '0983742434', 'user2@gmail.com', 'Hà Nội', '', '2024-01-09 09:14:12', 543600, 'Đã hủy'),
(34, 32, 'Nguyễn Trung Hiếu', '0983742434', 'user1@gmail.com', 'Hà Nam', '', '2024-01-09 11:44:07', 329400, 'Đã thanh toán'),
(35, 32, 'Nguyễn Trung Hiếu', '0983742434', 'user1@gmail.com', 'Hà Nam', 'Xin chao', '2024-01-10 05:11:40', 768000, 'Đang giao hàng'),
(36, 32, 'Nguyễn Trung Hiếu', '0983742434', 'user1@gmail.com', 'Hà Nam', '', '2024-01-13 09:27:02', 397600, 'Đã hủy'),
(37, 32, 'Nguyễn Trung Hiếu', '0983742434', 'user1@gmail.com', 'Hà Nam', '', '2024-01-16 11:55:51', 57600, 'Đang chờ duyệt'),
(38, 34, 'Hiếu', '0987654321', 'user3@gmail.com', 'Bắc Ninh', '', '2024-01-19 01:19:57', 57600, 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang_chi_tiet`
--

CREATE TABLE `don_hang_chi_tiet` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_don_hang` int(10) UNSIGNED DEFAULT NULL,
  `id_khach_hang` int(10) UNSIGNED NOT NULL,
  `id_san_pham` int(10) UNSIGNED NOT NULL,
  `gia_tien` int(10) NOT NULL,
  `so_luong` int(10) NOT NULL,
  `thanh_tien` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `don_hang_chi_tiet`
--

INSERT INTO `don_hang_chi_tiet` (`id`, `id_don_hang`, `id_khach_hang`, `id_san_pham`, `gia_tien`, `so_luong`, `thanh_tien`) VALUES
(52, 33, 33, 23, 79200, 2, 158400),
(53, 33, 33, 24, 57600, 2, 115200),
(54, 33, 33, 27, 135000, 2, 270000),
(65, 31, 32, 27, 135000, 1, 135000),
(66, 32, 32, 23, 79200, 1, 79200),
(67, 34, 32, 23, 79200, 1, 79200),
(68, 34, 32, 24, 57600, 2, 115200),
(69, 34, 32, 27, 135000, 1, 135000),
(70, 35, 32, 31, 170000, 3, 510000),
(71, 35, 32, 32, 129000, 2, 258000),
(80, 36, 32, 24, 57600, 1, 57600),
(81, 36, 32, 31, 170000, 2, 340000),
(82, 37, 32, 24, 57600, 1, 57600),
(83, NULL, 32, 24, 57600, 3, 172800),
(84, NULL, 32, 27, 135000, 2, 270000),
(85, NULL, 32, 33, 65000, 1, 65000),
(86, 38, 34, 24, 57600, 1, 57600);

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id` int(10) UNSIGNED NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `ten_tai_khoan` varchar(100) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `dien_thoai` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `vai_tro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `ho_ten`, `ten_tai_khoan`, `mat_khau`, `dien_thoai`, `email`, `dia_chi`, `vai_tro`) VALUES
(17, 'Nguyễn Trung Hiếu', 'admin', '21232f297a57a5a743894a0e4a801fc3', '0984934532', 'admin@gmail.com', 'Hà Nội', 'Quản Trị Viên'),
(19, 'Nguyễn Trung Hiếu', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', '0987385643', 'admin1@gmail.com', 'Hà Nội', 'Quản Trị Viên'),
(23, 'Nguyễn Trung Hiếu', 'admin2', 'c84258e9c39059a89ab77d846ddab909', '0123456789', 'admin2@gmail.com', 'Hà Nội', 'Quản Trị Viên'),
(25, 'Nguyễn Trung Hiếu', 'admin3', '32cacb2f994f6b42183a1300d9a3e8d6', '0983742434', 'admin3@gmail.com', 'Hà Nam', 'Quản Trị Viên'),
(29, 'Nguyễn Trung Hiếu', 'admin4', 'fc1ebc848e31e0a68e868432225e3c82', '0123456789', 'admin4@gmail.com', 'Nam Định', 'Quản Trị Viên'),
(32, 'Nguyễn Trung Hiếu', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', '0983742434', 'user1@gmail.com', 'Hà Nam', 'Khách Hàng'),
(33, 'Nguyễn Trung Hiếu', 'user2', '7e58d63b60197ceb55a1c487989a3720', '0983742434', 'user2@gmail.com', 'Hà Nội', 'Khách Hàng'),
(34, 'Hiếu', 'user3', '92877af70a45fd6a2ed7fe81e1236b78', '0987654321', 'user3@gmail.com', 'Bắc Ninh', 'Khách Hàng');

-- --------------------------------------------------------

--
-- Table structure for table `nha_xuat_ban`
--

CREATE TABLE `nha_xuat_ban` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_nxb` varchar(100) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `dien_thoai` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nha_xuat_ban`
--

INSERT INTO `nha_xuat_ban` (`id`, `ten_nxb`, `dia_chi`, `dien_thoai`, `email`) VALUES
(1, 'Kim Đồng', 'Số 55 Quang Trung, Nguyễn Du, Hai Bà Trưng, Hà Nội', '01900571595', 'cskh_online@nxbkimdong.com.vn'),
(5, 'Trẻ', '161B Lý Chính Thắng, Phường Võ Thị Sáu, Quận 3 , TP. Hồ Chí Minh', '02839316289', 'hopthubandoc@nxbtre.com.vn'),
(6, 'Chính trị Quốc gia', '', '', ''),
(7, 'Tư pháp', '', '', ''),
(8, 'Hồng Đức', '', '', ''),
(9, 'Quân đội', '', '', ''),
(10, 'Công an nhân dân', '', '', ''),
(11, 'Thanh niên', '', '', ''),
(12, 'Lao động', '', '', ''),
(13, 'Phụ nữ', '', '', ''),
(14, 'Mỹ thuật', '', '', ''),
(15, 'Sân khấu', '', '', ''),
(16, 'Hội nhà văn', '', '', ''),
(17, 'Lao động xã hội', '', '', ''),
(18, 'Khoa học xã hội', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_san_pham` varchar(100) NOT NULL,
  `mo_ta` text NOT NULL,
  `gia_tien` int(10) UNSIGNED NOT NULL,
  `giam_gia` int(10) UNSIGNED NOT NULL,
  `anh_nen` varchar(255) NOT NULL,
  `tac_gia` varchar(50) NOT NULL,
  `so_luong` int(10) UNSIGNED NOT NULL,
  `nam_xuat_ban` varchar(50) NOT NULL,
  `noi_bat` varchar(10) NOT NULL,
  `trang_thai` varchar(10) NOT NULL,
  `id_nha_xuat_ban` int(10) UNSIGNED NOT NULL,
  `id_the_loai` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id`, `ten_san_pham`, `mo_ta`, `gia_tien`, `giam_gia`, `anh_nen`, `tac_gia`, `so_luong`, `nam_xuat_ban`, `noi_bat`, `trang_thai`, `id_nha_xuat_ban`, `id_the_loai`) VALUES
(23, 'Bắt trẻ đồng xanh', 'Holden Caulfield, 17 tuổi, đã từng bị đuổi học khỏi ba trường, và trường dự bị đại học Pencey Prep là ngôi trường thứ tư. Và rôi cậu lại trượt 4 trên 5 môn học và nhận được thông báo đuổi học. Câu chuyện kể về chuỗi ngày tiếp theo sau đó của Holden, với ánh nhìn cay độc, giễu cợt vào một cuộc đời tẻ nhạt, xấu xa, trụy lạc và vô phương hướng của một thanh niên trẻ. Bắt trẻ đồng xanh đã từng trở thành chủ đề tranh luận hết sức sâu rộng tại Mỹ. Sau rất nhiều thị phi, tác phẩm đã được đưa vào giảng dạy tại chương trình trung học Mỹ. Và hơn thế, tạp chí Time đã xếp Bắt trẻ đồng xanh vào một trong 100 tác phẩm viết bằng tiếng Anh hay nhất từ năm 1923 đến nay.', 88000, 10, 'bat-tre-dong-xanh.jpg', 'Jerome David Salinger', 0, '2019', 'Có', 'Có', 1, 10),
(24, 'Đắc nhân tâm', 'Tại sao Đắc Nhân Tâm luôn trong Top sách bán chạy nhất thế giới? Bởi vì đó là cuốn sách MỌI NGƯỜI ĐỀU NÊN ĐỌC. Hiện nay có một sự hiểu nhầm đã xảy ra. Tuy Đắc Nhân Tâm là tựa sách hầu hết mọi người đều biết đến, vì những danh tiếng và mức độ phổ biến, nhưng một số người lại “ngại” đọc. Lý do vì họ tưởng đây là cuốn sách “dạy làm người” nên có tâm lý e ngại. Có lẽ là do khi giới thiệu về cuốn sách, người ta luôn gắn với miêu tả đây là “nghệ thuật đối nhân xử thế”, “nghệ thuật thu phục lòng người”… Những cụm từ này đã không còn hợp với hiện nay nữa, gây cảm giác xa lạ và không thực tế. Nhưng đâu phải thế, Đắc Nhân Tâm là cuốn sách không hề lỗi thời! Những vấn đề được chỉ ra trong đó đều là căn bản ứng xử giữa người với người. Nếu diễn giải theo từ ngữ bây giờ, có thể gọi đây là “giáo trình” giúp hiểu mình – hiểu người để thành công trong giao tiếp. Có ai sống mà không cần giao tiếp? Có bao nhiêu người ngày ngày mệt mỏi, khổ sở vì gặp phải các vấn đề trong giao tiếp? Vì thế, Đắc Nhân Tâm chính là cuốn sách dành cho mọi người. Con cái nên đọc – cha mẹ càng nên đọc, nhân viên nên đọc – sếp càng nên đọc, người quen nhau nên đọc – người lạ nhau càng nên đọc…. Và đó mới chính thật là lý do Đắc Nhân Tâm luôn lọt vào Top sách bán chạy nhất thế giới, dù đã ra đời cách đây gần 80 năm. Có lẽ sẽ có người vừa đọc vừa nghĩ, mấy điều trong sách này đơn giản mà, ai chẳng biết? Đúng thế, vì toàn bộ đều là những quy tắc, những cách cư xử căn bản giữa chúng ta với nhau thôi. Kiểu như “Không chỉ trích, oán trách hay than phiền”, “Thành thật khen ngợi và biết ơn người khác”, “Thật lòng làm cho người khác thấy rằng họ quan trọng”… Những điều này đúng thật là ai cũng biết, nhưng bạn có chắc bạn nhớ được và làm được những điều đơn giản đó? Vì vậy, cuốn sách mới ra đời, để giúp bạn thực hành. Nhưng có lẽ đa số người đọc sẽ thành thật gật gù đồng ý với từng trang sách. Ồ nếu như bình tâm suy xét lại mọi việc, thì trong bất cứ trường hợp nào mình cũng có thể cư xử đúng mực, không làm người khác tổn thương, giúp bầu không khí luôn thoải mái, và thế là cả hai bên đều vui vẻ, công việc cũng vì thế mà suôn sẻ, thành công hơn. Vậy chứ mà cũng không dễ, bởi “cái tôi” của mỗi người thường chiến thắng tâm trí trong đa số trường hợp. Để thỏa mãn nó, chúng ta hay mắc sai lầm không đáng. Đó cũng chính là lý do Đắc Nhân Tâm có mặt, để nhắc nhở và từng chút giúp ta uốn nắn chính “cái tôi” của mình. Với giọng văn giản dị, cách trình bày gần gũi nhưng cực kỳ khoa học bằng cách đúc rút những điều mối chốt ở cuối chương, Đắc Nhân Tâm là cuốn sách hiếm hoi không kén chọn người đọc. Bất cứ ai cũng có thể đồng cảm. Đây là công trình tâm huyết cả đời của Ngài Dale Carnegie, xuất phát từ chính nhu cầu của Dale khi cảm thấy cuộc đời mình sẽ không phạm phải quá nhiều sai lầm đã qua nếu như được học tử tế về cách cư xử trong cuộc sống. Ông đã viết bằng chính trải nghiệm phong phú cả đời mình. Thậm chí ông còn thuê cả một nhà nghiên cứu chuyên nghiệp để tìm và cùng ông nghiên cứu các tài liệu liên quan. Và cuốn sách hữu ích đến mức vừa ra đời đã phải tái bản liên tục, trở thành hiện tượng chưa từng có trong bối cảnh xuất bản ảm đạm của nước Anh lúc đó. Và mãi đến bây giờ. Từ ngày ấy, Đắc Nhân Tâm trở thành cuốn sách không-chịu-nằm-yên-trên-kệ. Ngoài ý được tái bản liên tục ở khắp nơi trên thế giới, thì cụm từ này còn có một ý khác, đó là cuốn sách đã được Ngài Dale bổ sung và hiệu chỉnh liên tục các câu chuyện mới, cách diễn đạt mới, nên ở mỗi lần xuất hiện, Đắc Nhân Tâm đều có những điều mới mẻ. Việc này cũng tiếp tục được con trai ông thực hiện sau khi ông qua đời, như ý nguyện của ông. Được đánh giá là cuốn sách có sức lan tỏa rộng lớn, được dịch ra hầu hết các ngôn ngữ trên thế giới và luôn nằm trong Top sách bán chạy ở mọi thị trường xuất bản, Đắc Nhân Tâm đã có đời sống xứng tầm với giá trị thực tế của mình. Đây có thể coi là một trong những cuốn sách dòng self-hepl chính thống đầu tiên. Và Ngài Dale cũng trở thành một trong những tác giả ảnh hưởng trực tiếp nhiều nhất đến sự thay đổi tích cực của hàng triệu độc giả trên thế giới.', 64000, 10, 'dac-nhan-tam.png', 'Dale Carnegie', 97, '2019', 'Có', 'Có', 1, 18),
(27, 'Con chim xanh biếc bay về', 'Con Chim Xanh Biếc Bay Về Không giống như những tác phẩm trước đây lấy bối cảnh vùng quê miền Trung đầy ắp những hoài niệm tuổi thơ dung dị, trong trẻo với các nhân vật ở độ tuổi dậy thì, trong quyển sách mới lần này nhà văn Nguyễn Nhật Ánh lấy bối cảnh chính là Sài Gòn – Thành phố Hồ Chí Minh nơi tác giả sinh sống (như là một sự đền đáp ân tình với mảnh đất miền Nam). Các nhân vật chính trong truyện cũng “lớn” hơn, với những câu chuyện mưu sinh lập nghiệp lắm gian nan thử thách của các sinh viên trẻ đầy hoài bão. Tất nhiên không thể thiếu những câu chuyện tình cảm động, kịch tính và bất ngờ khiến bạn đọc ngẩn ngơ, cười ra nước mắt. Và như trong mọi tác phẩm Nguyễn Nhật Ánh, sự tử tế và tinh thần hướng thượng vẫn là điểm nhấn quan trọng trong quyển sách mới này. Như một cuốn phim “trinh thám tình yêu”, Con chim xanh biếc bay về dẫn bạn đi hết từ bất ngờ này đến tò mò suy đoán khác, để kết thúc bằng một nỗi hân hoan vô bờ sau bao phen hồi hộp nghi kỵ đến khó thở. Bạn sẽ theo phe sinh viên-nhân viên với những câu thơ dịu dàng và đáo để, hay phe ông chủ với những kỹ năng kinh doanh khởi nghiệp? Và hãy đoán thử, điều gì khiến bạn có thể cảm động đến rưng rưng trong cuộc sống giữa Sài Gòn bộn bề? Lâu lắm mới có hình ảnh thành phố rộn ràng trong tác phẩm của Nguyễn Nhật Ánh - điều hấp dẫn khác thường của Con chim xanh biếc bay về. Chính vì thế mà cuốn sách chỉ có một cách đọc thôi: một mạch từ đầu đến cuối! Mã hàng 8934974170617 Tên Nhà Cung Cấp NXB Trẻ Tác giả Nguyễn Nhật Ánh NXB NXB Trẻ Năm XB 2020 Ngôn Ngữ Tiếng Việt Trọng lượng (gr) 400 Kích Thước Bao Bì 20 x 13 cm Số trang 396 Hình thức Bìa Mềm Sản phẩm bán chạy nhất Top 100 sản phẩm Tiểu thuyết bán chạy của tháng Con Chim Xanh Biếc Bay Về Không giống như những tác phẩm trước đây lấy bối cảnh vùng quê miền Trung đầy ắp những hoài niệm tuổi thơ dung dị, trong trẻo với các nhân vật ở độ tuổi dậy thì, trong quyển sách mới lần này nhà văn Nguyễn Nhật Ánh lấy bối cảnh chính là Sài Gòn – Thành phố Hồ Chí Minh nơi tác giả sinh sống (như là một sự đền đáp ân tình với mảnh đất miền Nam). Các nhân vật chính trong truyện cũng “lớn” hơn, với những câu chuyện mưu sinh lập nghiệp lắm gian nan thử thách của các sinh viên trẻ đầy hoài bão. Tất nhiên không thể thiếu những câu chuyện tình cảm động, kịch tính và bất ngờ khiến bạn đọc ngẩn ngơ, cười ra nước mắt. Và như trong mọi tác phẩm Nguyễn Nhật Ánh, sự tử tế và tinh thần hướng thượng vẫn là điểm nhấn quan trọng trong quyển sách mới này. Như một cuốn phim “trinh thám tình yêu”, Con chim xanh biếc bay về dẫn bạn đi hết từ bất ngờ này đến tò mò suy đoán khác, để kết thúc bằng một nỗi hân hoan vô bờ sau bao phen hồi hộp nghi kỵ đến khó thở. Bạn sẽ theo phe sinh viên-nhân viên với những câu thơ dịu dàng và đáo để, hay phe ông chủ với những kỹ năng kinh doanh khởi nghiệp? Và hãy đoán thử, điều gì khiến bạn có thể cảm động đến rưng rưng trong cuộc sống giữa Sài Gòn bộn bề? Lâu lắm mới có hình ảnh thành phố rộn ràng trong tác phẩm của Nguyễn Nhật Ánh - điều hấp dẫn khác thường của Con chim xanh biếc bay về. Chính vì thế mà cuốn sách chỉ có một cách đọc thôi: một mạch từ đầu đến cuối!', 150000, 10, 'con-chim-xanh-biec-bay-ve.jpg', 'Nguyễn Nhật Ánh', 98, '2020', 'Có', 'Có', 5, 10),
(31, 'Sapiens Lược Sử Loài Người (Tái Bản 2022)', 'Sapiens là một câu chuyện lịch sử lớn về nền văn minh nhân loại – cách chúng ta phát triển từ xã hội săn bắt hái lượm thuở sơ khai đến cách chúng ta tổ chức xã hội và nền kinh tế ngày nay.\r\n\r\nTrong ấn bản mới này của cuốn Sapiens - Lược sử loài người, chúng tôi đã có một số hiệu chỉnh về nội dung với sự tham gia, đóng góp của các thành viên Cộng đồng đọc sách Tinh hoa. Xin trân trọng cảm ơn ý kiến đóng góp tận tâm của các quý độc giả, đặc biệt là ông Nguyễn Hoàng Giang, ông Nguyễn Việt Long, ông Đặng Trọng Hiếu cùng những người khác. Mong tiếp tục nhận được sự quan tâm và góp ý từ độc giả.', 200000, 15, 'sapiens-luoc-su-ve-loai-nguoi-outline-5-7-2017-02.webp', 'Yuval Noah Harari', 50, '2022', 'Có', 'Có', 11, 16),
(32, 'Lịch sử tranh đoạt tài nguyên thế giới', 'Tài nguyên là tất cả các dạng vật chất, tri thức, thông tin được con người sử dụng để tạo ra của cải vật chất hoặc tạo ra giá trị sử dụng mới cho con người. Cùng với diễn trình lịch sử luôn luôn biến động thì tài nguyên cũng không ngừng thay đổi, từ các nguồn tài nguyên truyền thống như gia vị, than đá, dầu mỏ cho đến các nguồn năng lượng mới gần đây như đất hiếm, rác thải, năng lượng tái tạo. Và để kiếm tìm sự tiện lợi, sự giàu có và quyền lực, các cường quốc trên thế giới đã bước vào cuộc cạnh tranh hòng bảo vệ, giữ gìn và sử dụng các nguồn tài nguyên thông qua cuộc tranh đua phát triển công nghệ. Nhờ công nghệ đã giúp con người nhận ra giá trị của các loại tài nguyên, giúp con người biến những thứ chưa phải là tài nguyên trở thành tài nguyên và thúc đẩy việc phổ cập rộng rãi tài nguyên ra toàn thế giới. Và cũng chính sự ganh đua trong công nghệ chuyển đổi năng lượng có khả năng làm lung lay cán cân quyền lực toàn cầu và tạo ra những cuộc cạnh tranh mới tầm quốc tế. Liệu rằng trong tương lai, tài nguyên năng lượng thế giới sẽ ra sao, và nó sẽ gây ra những cuộc tranh đoạt như thế nào?', 150000, 14, 'lich_su_tranh_doat_tai_nguyen_the_gioi.jpg', 'Hikaru Hiranuma', 100, '2023', 'Có', 'Có', 16, 16),
(33, 'Cây Cam Ngọt Của Tôi', '“Vị chua chát của cái nghèo hòa trộn với vị ngọt ngào khi khám phá ra những điều khiến cuộc đời này đáng số một tác phẩm kinh điển của Brazil.”\r\n\r\n- Booklist\r\n\r\n“Một cách nhìn cuộc sống gần như hoàn chỉnh từ con mắt trẻ thơ… có sức mạnh sưởi ấm và làm tan nát cõi lòng, dù người đọc ở lứa tuổi nào.”\r\n\r\n- The National\r\n\r\nHãy làm quen với Zezé, cậu bé tinh nghịch siêu hạng đồng thời cũng đáng yêu bậc nhất, với ước mơ lớn lên trở thành nhà thơ cổ thắt nơ bướm. Chẳng phải ai cũng công nhận khoản “đáng yêu” kia đâu nhé. Bởi vì, ở cái xóm ngoại ô nghèo ấy, nỗi khắc khổ bủa vây đã che mờ mắt người ta trước trái tim thiện lương cùng trí tưởng tượng tuyệt vời của cậu bé con năm tuổi.\r\n\r\nCó hề gì đâu bao nhiêu là hắt hủi, đánh mắng, vì Zezé đã có một người bạn đặc biệt để trút nỗi lòng: cây cam ngọt nơi vườn sau. Và cả một người bạn nữa, bằng xương bằng thịt, một ngày kia xuất hiện, cho cậu bé nhạy cảm khôn sớm biết thế nào là trìu mến, thế nào là nỗi đau, và mãi mãi thay đổi cuộc đời cậu.\r\nMở đầu bằng những thanh âm trong sáng và kết thúc lắng lại trong những nốt trầm hoài niệm, Cây cam ngọt của tôi khiến ta nhận ra vẻ đẹp thực sự của cuộc sống đến từ những điều giản dị như bông hoa trắng của cái cây sau nhà, và rằng cuộc đời thật khốn khổ nếu thiếu đi lòng yêu thương và niềm trắc ẩn. Cuốn sách kinh điển này bởi thế không ngừng khiến trái tim người đọc khắp thế giới thổn thức, kể từ khi ra mắt lần đầu năm 1968 tại Brazil.', 100000, 35, 'cay_cam_ngot_cua_toi.jpg', 'José Mauro de Vasconcelos', 100, '2020', 'Có', 'Có', 16, 12),
(34, 'Nhà Giả Kim', 'Tất cả những trải nghiệm trong chuyến phiêu du theo đuổi vận mệnh của mình đã giúp Santiago thấu hiểu được ý nghĩa sâu xa nhất của hạnh phúc, hòa hợp với vũ trụ và con người. \r\n\r\nTiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.\r\n\r\n“Nhưng nhà luyện kim đan không quan tâm mấy đến những điều ấy. Ông đã từng thấy nhiều người đến rồi đi, trong khi ốc đảo và sa mạc vẫn là ốc đảo và sa mạc. Ông đã thấy vua chúa và kẻ ăn xin đi qua biển cát này, cái biển cát thường xuyên thay hình đổi dạng vì gió thổi nhưng vẫn mãi mãi là biển cát mà ông đã biết từ thuở nhỏ. Tuy vậy, tự đáy lòng mình, ông không thể không cảm thấy vui trước hạnh phúc của mỗi người lữ khách, sau bao ngày chỉ có cát vàng với trời xanh nay được thấy chà là xanh tươi hiện ra trước mắt. ‘Có thể Thượng đế tạo ra sa mạc chỉ để cho con người biết quý trọng cây chà là,’ ông nghĩ.”\r\n\r\n- Trích Nhà giả kim\r\n\r\nNhận định\r\n\r\n“Sau Garcia Márquez, đây là nhà văn Mỹ Latinh được đọc nhiều nhất thế giới.” - The Economist, London, Anh\r\n\r\n \r\n\r\n“Santiago có khả năng cảm nhận bằng trái tim như Hoàng tử bé của Saint-Exupéry.” - Frankfurter Allgemeine Zeitung, Đức\r\n\r\nMã hàng	8935235226272\r\nTên Nhà Cung Cấp	Nhã Nam\r\nTác giả	Paulo Coelho\r\nNgười Dịch	Lê Chu Cầu\r\nNXB	NXB Hội Nhà Văn\r\nNăm XB	2020\r\nTrọng lượng (gr)	220\r\nKích Thước Bao Bì	20.5 x 13 cm\r\nSố trang	227\r\nHình thức	Bìa Mềm\r\nSản phẩm hiển thị trong	\r\nĐồ Chơi Cho Bé - Giá Cực Tốt\r\nNhã Nam\r\nTop sách được phiên dịch nhiều nhất\r\nRƯỚC DEAL LINH ĐÌNH VUI ĐÓN TRUNG THU\r\nSản phẩm bán chạy nhất	Top 100 sản phẩm Tiểu thuyết bán chạy của tháng\r\nGiá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...\r\nChính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc\r\nTất cả những trải nghiệm trong chuyến phiêu du theo đuổi vận mệnh của mình đã giúp Santiago thấu hiểu được ý nghĩa sâu xa nhất của hạnh phúc, hòa hợp với vũ trụ và con người. \r\n\r\nTiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.\r\n\r\n“Nhưng nhà luyện kim đan không quan tâm mấy đến những điều ấy. Ông đã từng thấy nhiều người đến rồi đi, trong khi ốc đảo và sa mạc vẫn là ốc đảo và sa mạc. Ông đã thấy vua chúa và kẻ ăn xin đi qua biển cát này, cái biển cát thường xuyên thay hình đổi dạng vì gió thổi nhưng vẫn mãi mãi là biển cát mà ông đã biết từ thuở nhỏ. Tuy vậy, tự đáy lòng mình, ông không thể không cảm thấy vui trước hạnh phúc của mỗi người lữ khách, sau bao ngày chỉ có cát vàng với trời xanh nay được thấy chà là xanh tươi hiện ra trước mắt. ‘Có thể Thượng đế tạo ra sa mạc chỉ để cho con người biết quý trọng cây chà là,’ ông nghĩ.”\r\n\r\n- Trích Nhà giả kim', 80000, 22, 'nha_gia_kim.jpg', 'Paulo Coelho', 100, '2020', 'Có', 'Có', 16, 12);

-- --------------------------------------------------------

--
-- Table structure for table `the_loai`
--

CREATE TABLE `the_loai` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_the_loai` varchar(100) NOT NULL,
  `noi_bat` varchar(10) NOT NULL,
  `trang_thai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `the_loai`
--

INSERT INTO `the_loai` (`id`, `ten_the_loai`, `noi_bat`, `trang_thai`) VALUES
(10, 'Văn học', 'Có', 'Có'),
(11, 'Công nghệ', 'Có', 'Có'),
(12, 'Tiểu thuyết', 'Có', 'Có'),
(14, 'Khoa học', 'Có', 'Có'),
(15, 'Công nghệ thông tin', 'Có', 'Có'),
(16, 'Lịch sử', 'Có', 'Có'),
(17, 'Địa lý', 'Có', 'Có'),
(18, 'Phát triển bản thân', 'Có', 'Có');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_khach_hang` (`id_khach_hang`);

--
-- Indexes for table `don_hang_chi_tiet`
--
ALTER TABLE `don_hang_chi_tiet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_khach_hang` (`id_khach_hang`),
  ADD KEY `id_don_hang` (`id_don_hang`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nha_xuat_ban`
--
ALTER TABLE `nha_xuat_ban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nha_xuat_ban` (`id_nha_xuat_ban`),
  ADD KEY `id_the_loai` (`id_the_loai`);

--
-- Indexes for table `the_loai`
--
ALTER TABLE `the_loai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `don_hang_chi_tiet`
--
ALTER TABLE `don_hang_chi_tiet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `nha_xuat_ban`
--
ALTER TABLE `nha_xuat_ban`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `the_loai`
--
ALTER TABLE `the_loai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `nguoi_dung` (`id`);

--
-- Constraints for table `don_hang_chi_tiet`
--
ALTER TABLE `don_hang_chi_tiet`
  ADD CONSTRAINT `don_hang_chi_tiet_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `don_hang_chi_tiet_ibfk_2` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id`),
  ADD CONSTRAINT `don_hang_chi_tiet_ibfk_3` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id`);

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`id_nha_xuat_ban`) REFERENCES `nha_xuat_ban` (`id`),
  ADD CONSTRAINT `san_pham_ibfk_2` FOREIGN KEY (`id_the_loai`) REFERENCES `the_loai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
