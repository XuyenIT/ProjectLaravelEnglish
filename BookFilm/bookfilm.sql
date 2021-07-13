-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 07, 2021 lúc 08:16 AM
-- Phiên bản máy phục vụ: 10.1.32-MariaDB
-- Phiên bản PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookfilm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book_fd`
--

CREATE TABLE `book_fd` (
  `ID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `BookTicket_ID` int(11) NOT NULL,
  `FoodDrink_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book_fd`
--

INSERT INTO `book_fd` (`ID`, `Quantity`, `TotalPrice`, `created_at`, `updated_at`, `BookTicket_ID`, `FoodDrink_ID`) VALUES
(1, 1, '259000.00', NULL, NULL, 1, 1),
(3, 1, '99000.00', NULL, NULL, 1, 4),
(8, 1, '259000.00', NULL, NULL, 5, 1),
(9, 1, '89000.00', NULL, NULL, 5, 3),
(10, 1, '109000.00', NULL, NULL, 8, 2),
(11, 1, '109000.00', NULL, NULL, 11, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book_sit`
--

CREATE TABLE `book_sit` (
  `ID` int(11) NOT NULL,
  `Sit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` int(11) NOT NULL,
  `Count` int(11) NOT NULL,
  `Price` decimal(65,0) NOT NULL,
  `TotalMoney` decimal(65,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `BookTicket_ID` int(11) NOT NULL,
  `RoomDetail_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book_sit`
--

INSERT INTO `book_sit` (`ID`, `Sit`, `Type`, `Count`, `Price`, `TotalMoney`, `created_at`, `updated_at`, `BookTicket_ID`, `RoomDetail_ID`) VALUES
(1, 'B8, B9,', 3, 2, '15000', '30000', NULL, NULL, 1, NULL),
(2, 'G8, G9,', 2, 2, '10000', '20000', NULL, NULL, 1, NULL),
(3, 'L8, L9,', 1, 2, '5000', '10000', NULL, NULL, 1, NULL),
(7, 'C9, C10,', 3, 2, '15000', '30000', NULL, NULL, 5, NULL),
(8, 'G9, G10,', 2, 2, '10000', '20000', NULL, NULL, 5, NULL),
(9, 'K9, K10,', 1, 2, '5000', '10000', NULL, NULL, 5, NULL),
(10, 'D9, D10,', 3, 2, '15000', '30000', NULL, NULL, 7, NULL),
(11, 'F8, F9,', 2, 2, '10000', '20000', NULL, NULL, 8, NULL),
(12, 'B8, B9,', 3, 2, '15000', '30000', NULL, NULL, 9, NULL),
(13, 'D5, D6,', 3, 2, '15000', '30000', NULL, NULL, 10, NULL),
(14, 'H5, H6,', 2, 2, '10000', '20000', NULL, NULL, 10, NULL),
(15, 'C5,', 3, 1, '15000', '15000', NULL, NULL, 11, NULL),
(16, 'D5, D6,', 2, 2, '10000', '20000', NULL, NULL, 11, NULL),
(17, 'I5,', 1, 1, '5000', '5000', NULL, NULL, 11, NULL),
(18, 'K5,', 1, 1, '5000', '5000', NULL, NULL, 12, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book_ticket`
--

CREATE TABLE `book_ticket` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `Sit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CountTicket` int(11) NOT NULL,
  `TotalPrice` decimal(8,2) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  `Film_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book_ticket`
--

INSERT INTO `book_ticket` (`ID`, `Date`, `Time`, `CreatedDate`, `Sit`, `CountTicket`, `TotalPrice`, `Status`, `created_at`, `updated_at`, `User_ID`, `Film_ID`) VALUES
(1, '2021-07-01', '13:00:00', '2021-07-01 13:17:33', 'B8, B9, G8, G9, L8, L9,', 6, '658000.00', 0, NULL, NULL, 1, 7),
(5, '2021-07-31', '01:00:00', '2021-07-01 20:01:03', 'C9, C10, G9, G10, K9, K10,', 6, '648000.00', 1, NULL, NULL, 2, 1),
(7, '2021-05-07', '01:00:00', '2021-07-05 13:48:58', 'D9, D10,', 2, '90000.00', 0, NULL, NULL, 4, 5),
(8, '2021-07-15', '01:00:00', '2021-07-05 15:01:36', 'F8, F9,', 2, '209000.00', 1, NULL, NULL, 4, 8),
(9, '2021-07-05', '09:00:00', '2021-07-05 15:20:17', 'B8, B9,', 2, '90000.00', 0, NULL, NULL, 1, 2),
(10, '2021-07-27', '11:00:00', '2021-07-06 14:42:22', 'D5, D6, H5, H6,', 4, '190000.00', 1, NULL, NULL, 1, 1),
(11, '2021-08-06', '01:00:00', '2021-07-07 09:51:46', 'C5, D5, D6, I5,', 4, '309000.00', 1, NULL, NULL, 5, 6),
(12, '2021-07-08', '11:00:00', '2021-07-07 10:14:59', 'K5,', 1, '55000.00', 1, NULL, NULL, 5, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DisplayOrder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`ID`, `Name`, `Link`, `DisplayOrder`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'Hài', 'hai', '1', 1, NULL, NULL),
(2, 'Gia đình', 'gia-dinh', '2', 0, NULL, NULL),
(3, 'Hành động', 'hanh-dong', '3', 1, NULL, NULL),
(4, 'Chính kịch', 'chinh-kich', '4', 1, NULL, NULL),
(5, 'Kinh dị', 'kinh-di', '', 1, NULL, NULL),
(7, 'Phiêu lưu', 'phieu-luu', '', 1, NULL, NULL),
(8, 'Cướp ngân hàng', 'cuop-ngan-hang', '', 1, NULL, NULL),
(9, 'Tình cảm', 'tinh-cam', '', 1, NULL, NULL),
(10, 'Hài kịch', 'hanh-kich', '', 1, NULL, NULL),
(11, 'Tâm lý', 'tam-ly', '', 1, NULL, NULL),
(12, 'Khoa học viễn tưởng', 'khoa-hoc-vien-tuong', '', 1, NULL, NULL),
(13, 'Hồi hộp', 'hoi-hop', '', 1, NULL, NULL),
(14, 'Hoạt hình', 'hoat-hinh', '', 1, NULL, NULL),
(15, 'Anime', 'anime', '', 1, NULL, NULL),
(16, 'Thần thoại', 'than-thoai', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categoryfilm`
--

CREATE TABLE `categoryfilm` (
  `ID` int(11) NOT NULL,
  `Film_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categoryfilm`
--

INSERT INTO `categoryfilm` (`ID`, `Film_ID`, `Category_ID`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 1, 16, NULL, NULL),
(3, 2, 4, NULL, NULL),
(4, 2, 5, NULL, NULL),
(5, 3, 5, NULL, NULL),
(6, 4, 7, NULL, NULL),
(7, 4, 16, NULL, NULL),
(8, 5, 3, NULL, NULL),
(9, 5, 8, NULL, NULL),
(10, 6, 2, NULL, NULL),
(11, 6, 9, NULL, NULL),
(12, 7, 4, NULL, NULL),
(13, 7, 10, NULL, NULL),
(14, 8, 11, NULL, NULL),
(15, 9, 3, NULL, NULL),
(16, 9, 12, NULL, NULL),
(17, 10, 13, NULL, NULL),
(18, 10, 12, NULL, NULL),
(19, 11, 3, NULL, NULL),
(20, 11, 5, NULL, NULL),
(21, 12, 2, NULL, NULL),
(22, 12, 14, NULL, NULL),
(23, 13, 3, NULL, NULL),
(24, 13, 1, NULL, NULL),
(25, 14, 3, NULL, NULL),
(26, 15, 1, NULL, NULL),
(27, 15, 9, NULL, NULL),
(28, 16, 15, NULL, NULL),
(30, 2, 16, NULL, NULL),
(34, 18, 1, NULL, NULL),
(35, 18, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Rate` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  `Film_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`ID`, `Content`, `Rate`, `CreatedDate`, `Status`, `created_at`, `updated_at`, `User_ID`, `Film_ID`) VALUES
(1, 'abc xyz', 5, '2021-06-28 09:35:24', 1, NULL, NULL, 1, 2),
(2, 'Phim cũng tạm được, còn nhiều sạn', 9, '2021-06-28 10:20:43', 1, NULL, NULL, 2, 2),
(3, 'Phim hay', 9, '2021-06-28 14:21:30', 1, NULL, NULL, 1, 3),
(4, 'Phim hay, cảnh quay hoành tráng, không bõ 40k mua vé', 10, '2021-07-04 20:49:18', 1, NULL, NULL, 4, 1),
(5, 'Cao Thái Hà sexy quá vậy ', 9, '2021-07-04 20:57:42', 1, NULL, NULL, 4, 8),
(6, 'Phim hack não ghê', 9, '2021-07-05 13:47:23', 1, NULL, NULL, 4, 5),
(7, 'Phim sắp chiếu rồi. Yeah!!!!!', 9, '2021-07-05 14:26:31', 1, NULL, NULL, 4, 14),
(8, '                            ok', 9, '2021-07-05 14:28:46', 1, NULL, NULL, 2, 7),
(9, '                            Xem trailer phim có vẻ nhạt', 8, '2021-07-05 14:40:17', 1, NULL, NULL, 4, 6),
(10, '                            Bộ phim huyền thoại', 10, '2021-07-05 15:23:06', 1, NULL, NULL, 1, 4),
(11, '                            Nhìn poster phim hầm hố vãi', 10, '2021-07-07 09:40:05', 1, NULL, NULL, 1, 9),
(12, '                            Đặt vé thành công', 7, '2021-07-07 09:53:12', 1, NULL, NULL, 5, 6),
(13, '                            phim hay', 8, '2021-07-07 10:08:09', 1, NULL, NULL, 5, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `film`
--

CREATE TABLE `film` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Metatitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Actor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ReleaseDate` datetime NOT NULL,
  `Country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Vote` float NOT NULL,
  `AgeRestriction` int(11) NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Trailer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `film`
--

INSERT INTO `film` (`ID`, `Name`, `Metatitle`, `Image`, `Director`, `Actor`, `Time`, `ReleaseDate`, `Country`, `Vote`, `AgeRestriction`, `Description`, `Trailer`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'Godzilla Đại Chiến Kong - Godzilla vs. Kong', 'godzilla-dai-chien-kong-godzilla-vs-kong', 'godzilla-vs-kong.jpg', 'Adam Wingard', ' Alexander Skarsgård, Millie Bobby Brown, Rebecca Hall, Brian Tyree Henry,…', '110 phút', '2021-03-26 00:00:00', 'Mỹ', 4.2, 13, 'Hai kẻ thù truyền kiếp Kong và Godzilla sẽ chạm trán trong một trận chiến thế kỉ. Kong và các đồng đội cùng với Jia là một cô gái trẻ mồ côi, sẽ dấn thân vào cuộc thám hiểm đầy hiểm nguy mong tìm ra được ngôi nhà thật sự của mình.\r\n\r\nKhông may thay, họ lại bất ngờ gặp phải Godzilla và ngăn cản việc phá hủy trái đất của nó. Cuộc đụng độ giữa hai kẻ khổng lồ bởi những thế lực vô hình phía sau, chỉ là khởi đầu của bí ẩn nằm sâu phía dưới lòng đất.', 'https://www.youtube.com/embed/yFpuUGFS1Kg', 1, NULL, NULL),
(2, 'Song Song', 'song-song', 'song-song.jpg', 'Nguyễn Hữu Hoàng', 'Nabi Nhã Phương, Trương Thế Vinh, Tiến Luật, Khương Ngọc, Hoàng Phi,..', 'Chưa xác định', '2021-04-02 00:00:00', 'Việt Nam', 4, 16, 'Với sự pha trộn giữa thể loại giật gân, tâm lý, ly kỳ, Song Song hứa hẹn sẽ mang tới màu sắc rất riêng cho loạt phim kinh dị chiếu rạp trong tháng này. Ngay tựa đề phim, Song Song đã tạo cho khán giả không ít sự tò mò và hứng thú. Song Song được lấy cảm hứng từ hiệu ứng cánh bướm, về một phụ nữ phải tìm cách sửa chữa sai lầm khi vô tình thay đổi quá khứ, khiến cuộc sống của họ bị đảo lộn.\r\nVào một đêm mưa bão, Phong (Thuận Phát) đã vô tình chứng kiến cảnh ông Sơn (Tiến Luật) hàng xóm đang cố gắng di chuyển một xác chết. Vì quá sợ hãi, Phong chạy ra khỏi nhà nhưng đã bị xe tải tông chết ngay tại chỗ trước sự bất lực của ông Sơn. Liệu mọi chuyện sẽ diễn ra như thế nào? Mời bạn theo dõi phim để có câu trả lời.', 'https://www.youtube.com/embed/hhiKQbGxEOw', 1, NULL, NULL),
(3, 'Ấn Quỷ - The Unholy', 'an-quy-the-unholy', 'an-quy.png', 'Evan Spiliotopoulos', 'Cricket Brown, Jeffrey Dean Morgan, Katie Aselton, William Sadler, Cary Elwes,...', '90 phút', '2021-04-02 00:00:00', 'Anh', 4, 13, 'Kịch bản phim Ấn quỷ được dựa trên cuốn tiểu thuyết Shrine phát hành năm 1983. Nội dung cho thấy phim được ranh giới mỏng manh giữ đức tin và đức tin mù quáng, Ấn quỷ đã gửi được thông điệp đức tin có thể mang lại niềm tin, lý tưởng sống nhưng vẫn phải tỉnh táo để không lạc lối.\r\n\r\nTại một miền quê tại New England, là nơi cô gái khiếm thính Alice sinh ra và lớn lên chính là nơi bộ phim diễn ra.\r\n\r\nBỗng một ngày, một thế lực thần bí đã chữa lành cho Alice, giúp cô có thể nghe, nói như bình thường và có thể chữa lành mọi căn bệnh cho người khác. Dưới sự chứng kiến của hàng trăm ngàn người. Cũng từ đây hàng loạt sự kiện kinh hoàng và quỷ dị xảy ra.', 'https://www.youtube.com/embed/f1Nv2O7VJuo', 1, NULL, NULL),
(4, 'Harry Potter Và Bảo Bối Tử Thần Phần 2 - Harry Potter And The Deathly Hallows Part 2', 'harry-potter-va-bao-boi-tu-than-phan-2-harry-potter-and-the-deathly', 'harry-potter.jpg', 'David Yates', 'Daniel Radcliffe, Rupert Grint, Emma Watson, Ralph Fiennes,…', '130 phút', '2021-04-02 00:00:00', 'Mỹ', 4.7, 10, 'Không còn sự dẫn dắt của các giáo sư, nhóm bạn Harry (Daniel Radcliffe), Ron (Rupert Grint) và Hermione (Emma Watson) bắt đầu cuộc hành trình phá hủy các Trường Sinh Linh Giá - những vật phẩm giúp Chúa tể Voldemort (Ralph Fiennes) đạt đến sự bất tử.\r\n\r\nVào lúc này, khi cả ba phải đồng lòng với nhau hơn bất cứ khi nào, những thế lực hắc ám lại đang âm mưu chia rẽ nhóm bạn. Lúc đó, những Tử thần Thực tử của Chúa tể Voldemort chiếm được quyền lãnh đạo Bộ Pháp thuật và Hogwarts, cũng như điên cuồng tìm kiếm Harry và những người bạn thân - trước cuộc chiến tối thượng cuối cùng. ', 'https://www.youtube.com/embed/eONDcHfpG0s', 1, NULL, NULL),
(5, 'Siêu Trộm - Way Down', 'sieu-trom-way-down', 'way-down.jpg', 'Jaume Balagueró', 'Freddie Highmore, Astrid Bergès-Frisbey, Sam Riley, Liam Cunningham,...', '118 phút', '2021-04-02 00:00:00', 'Tây Ban Nha', 4.3, 18, 'Là một bom tấn điện ảnh Tây Ban Nha nói về chủ đề Cướp ngân hàng, Siêu Trộm - Way Down hứa hẹn sẽ đem đến cho khán giả những trải nghiệm cực kỳ mãn nhãn và khó đoán.\r\n\r\nNhà thám hiểm đại dương Walter Moeland vừa thành công trong việc trục vớt một xác tàu đắm thuộc vùng biển Tây Ban Nha, đồng thời tìm được 3 đồng xu vàng được cho là dẫn đến kho báu “bất tận” được chôn giấu của huyền thoại Sir Francis Drake.\r\n\r\nTuy nhiên chính quyền Tây Ban Nha quyết định tịch thu toàn bộ sản vật, kể cả 3 đồng xu, và mọi nỗ lực pháp lý đều không thể giúp Walter đoạt được quyền sở hữu. Kho báu của anh giờ đây được cất giấu tại két sắt thuộc ngân hàng bảo mật nhất thế giới - Bank of Spain.\r\n\r\nKhông từ bỏ hy vọng, Walter thành lập một biệt đội “siêu trộm”, với những bộ óc thiên tài và gan dạ nhất, bắt đầu lên kế hoạch để lấy lại những thứ thuộc về mình.', 'https://www.youtube.com/embed/XfLslifRe0g', 1, NULL, NULL),
(6, 'Khát Vọng Đổi Đời - Minari', 'khat-vong-doi-doi-minari', 'minari.jpg', 'Lee Isaac Chung', ' Steven Yeun, Yeri Han, Alan Kim, Noel Kate Cho, Scott Haze, Yuh-Jung Youn, Will Patton,…', '115 phút', '2021-04-02 00:00:00', 'Hàn Quốc', 3.7, 16, 'Nội dung phim xoay quanh câu chuyện về một gia đình người Hàn chuyển đến vùng nông thôn Arkansas để tìm kiếm giấc mơ Mỹ.\r\n\r\nTrải qua hàng loạt khó khăn thử thách với cuộc sống mới ở vùng Ozarks khô cằn, họ phát hiện ra sức mạnh không thể chối bỏ từ hai tiếng “gia đình” và điều gì thực sự tạo nên một mái ấm gia đình. Cùng ra rạp để xem các diễn biến hấp dẫn bạn nhé.', 'https://www.youtube.com/embed/z4bqat8idns', 1, NULL, NULL),
(7, 'Cô Gái Trẻ Hứa Hẹn - Promising Young Woman', 'co-gai-tre-huu-hen-promising-young', 'Promising-Young-Woman-1-poster_KP.jpg', 'Emerald Fennell', 'Carey Mulligan, Bo Burnham, Alison Brie', '113 phút', '2021-04-02 00:00:00', 'Anh Quốc', 4.3, 18, 'Tác phẩm hài kịch đen Cô Gái Trẻ Hứa Hẹn của nữ đạo diễn người Anh Emerald Fennell vừa được công chiếu vào ngày 02/04 tại các cụm rạp trên toàn quốc.\r\n\r\nTrước vụ việc người bạn thân nhất Nina Fisher bị tấn công tình dục và rồi tự sát vì không tìm thấy công lý, Cassandra Cassie Thomas đã gặp phải tổn thương tâm lý nặng nề và bỏ học. Giờ đây, Cassie 30 tuổi lang thang giữa các hộp đêm Ohio, đóng giả làm một “con mồi béo bở” đang say khướt để mời gọi và dạy dỗ những chàng trai ngây ngô hư hỏng.', 'https://www.youtube.com/embed/-CNNp-ylxwY', 1, NULL, NULL),
(8, 'Kiều', 'kieu', 'kieu.jpg', ' Mai Thu Huyền', 'Cao Thái Hà, Phan Thị Mơ,…', '125 phút', '2021-03-08 00:00:00', 'Việt Nam', 4.3, 18, 'Tiếp nối những bộ phim được chuyển thể từ các tác phẩm văn học, Kiều là một cái tên sáng giá, hứa hẹn mang tới cho người hâm mộ điện ảnh thứ 7 những giây phút thư giãn đỉnh cao.\r\n\r\nBộ phim dựa trên tác phẩm văn học kinh điển cùng tên của đại thi hào Nguyễn Du. Chỉ khi vừa tung ra đoạn trailer ngắn, Kiều đã khiến không ít khán giả phải tò mò và mong chờ. Liệu Kiều trên màn ảnh có thu hút được khán giả không? Mời bạn cùng ra rạp để có được câu trả lời chính xác nhất.', 'https://www.youtube.com/embed/AHMQlyNXDm8', 1, NULL, NULL),
(9, 'Cuộc Chiến Sinh Tử - Mortal Kombat', 'cuoc-chien-sinh-tu-mortal-kombat', 'mortal-kombat-elle-man-1.jpg', 'Simon McQuoid', 'Lewis Tan, Jessica McNamee, Tadanobu Asano', '110 phút', '2021-07-09 00:00:00', 'Trung Quốc', 4.7, 18, 'Phim nói về Cole Young, một võ sĩ tài ba trẻ tuổi, nhà vô địch MMA, vô tình sở hữu vết chàm hình Rồng đầy bí ẩn trên cơ thể. Cũng từ đó, anh bị một tên Ninja với khả năng sử dụng sức mạnh băng giá, Sub-zero, truy đuổi và đe dọa mạng sống.\r\n\r\nQua cuộc gặp gỡ với một người tên Sonya Blade, anh dần hiểu hơn về vết chàm trên cơ thể mình. Một cuộc chiến ngàn năm đang dần đến hồi kết và Cole Young chính là hy vọng cuối cùng giúp lật ngược thế cờ.', 'https://www.youtube.com/embed/NYH2sLid0Zc', 1, NULL, NULL),
(10, 'Bản Năng Hoang Dại - Voyagers ', 'ban-nang-hoang-dai-voyagers', 'voyagers.jpg', 'Neil Burger', 'Tye Sheridan, Lily-Rose Depp, Fionn Whitehead, Chanté Adams, Isaac Hempstead Wright,…', '108 phút', '2021-07-09 00:00:00', 'Mỹ', 4, 13, 'Phim nói về tương lai không xa khi nhân loại đang trên bờ vực diệt chủng, một nhóm thanh thiếu niên được nuôi dưỡng để phục vụ cho mục đích khai thác trí tuệ và chấp nhận sai khiến. Họ bắt đầu một chuyến hành trình thám hiểm khai phá một hành tinh xa xôi khác.\r\n\r\nNhưng khi họ phát hiện ra bí mật che giấu đằng sau nhiệm vụ cao cả này, tất cả bắt đầu kháng cự lại việc huấn luyện này và bắt đầu để bản năng nguyên thuỷ lấn chiếm cảm xúc. Khi đó, vận mệnh của cả phi đoàn rơi vào hỗn loạn, họ bị chôn vùi trong sợ hãi, ham muốn và cơn khao khát quyền lực.', 'https://www.youtube.com/embed/PiyN2zS32jE', 1, NULL, NULL),
(11, 'Bàn Tay Diệt Quỷ - Evil Expeller', 'ban-tay-diet-quy-evil-expeller', 'ban-tay-diet-quy.jpg', 'Kim Joo Hwan', 'Park Seo Joon, Ahn Sung Ki, Woo Do Hwan, Choi Woo Sik,…', '128 phút', '2021-07-09 00:00:00', 'Hàn Quốc', 4, 16, 'Phim nói về võ sĩ sau khi bản thân bỗng nhiên sở hữu “Bàn tay diệt quỷ”, nên võ sĩ MMA Yong Hoo (Park Seo Joon thủ vai) đã dấn thân vào hành trình trừ tà, trục quỷ đối đầu với Giám Mục Bóng Tối (Woo Do Hwan) – tên quỷ Satan đột lốt người.\r\n\r\nTừ đó sự thật về cái chết của cha Yong Hoo cũng dần được hé lộ cũng như nguyên nhân anh trở thành “người được chọn”. Cùng ra rạp để xem tiếp những tình tiết hấp dẫn nhé.', 'https://www.youtube.com/embed/-zBfJFu84O8', 1, NULL, NULL),
(12, 'Nào Mình Cùng Mơ - Dreambuilders', 'nao-minh-cung-mo-drembuilders', 'dreambuilers-cgv-phim-hoat-hinh_1_.jpg', 'Nào Mình Cùng Mơ - Dreambuilders', 'Rasmus Botoft, Martin Buch, Caroline Vedel, Emilie Kroyer Koppel,…', '81 phút', '2021-08-08 00:00:00', 'Anh', 4, 8, 'Nội dung phim là chuyến hành trình đầy màu sắc của cô bé Minna vào xứ sở của những giấc mơ, nơi có những “thợ xây mơ” dễ thương và rộn chuyện. Cuộc sống của Minna đảo lộn khi cha cô tiến thêm bước nữa.\r\n\r\nCô em gái Jenny mới đến là một trong những “hot Instagram” khó ưa. Vì thế mà Minna quyết định xâm nhập và điều khiển giấc mơ, dạy cho Jenny một bài học. Và những màu nhiệm cũng như sự cố không ngờ đã xảy đến với “công xưởng giấc mơ”. Hãy cùng xem những chi tiết hấp dẫn diễn ra tại rạp nhé.', 'https://www.youtube.com/embed/MNMH5s4k1LE', 1, NULL, NULL),
(13, 'Lật Mặt: 48h', 'lat-mat-48h', 'poster-lat-mat_lpmy.jpg', 'Lý Hải', 'Ốc Thanh Vân, Võ Thành Tâm, Mạc Văn Khoa, Huỳnh Đông...', '110 phút', '2021-08-19 00:00:00', 'Việt Nam', 4, 12, 'Câu chuyện xoay quanh hành trình trốn chạy bọn xã hội đen của gia đình anh Hiền - một võ sư có xuất thân là tay đấm bốc trong quá khứ. Vì cần một số tiền lớn, anh đã vô tình lọt vào cái bẫy của bọn người xấu nhưng may mắn thoát được. \r\n\r\nHiền cùng vợ con phải bỏ trốn về quê của một người bạn cũ để thoát khỏi sự truy sát ấy nhưng bọn chúng vẫn lần theo đến nơi và truy sát anh cho bằng được. Liệu Hiền có thoát khỏi sự truy lùng đó và bảo vệ được vợ con của mình hay không? Cùng theo dõi các diễn biến phim tại rạp nhé', 'https://www.youtube.com/embed/ykBfss-8H4Y', 1, NULL, NULL),
(14, 'Người Nhân Bản - SEOBOK', 'nguoi-nhan-ban-seobok', 'seobok-nguoi-nhan-ban.jpg', 'Lee Yong-zoo', ' Gong Yoo, Park Bo-gum, Jo Woo-jin, Jang Young-nam, Park Byung-eun,…', '110 phút', '2021-07-19 00:00:00', 'Hàn Quốc', 4.3, 12, 'Phim kể về Ki-hun – một cựu đặc vụ sống tách biệt với thế giới bên ngoài kể từ sau biến cố trong quá khứ, chấp nhận thực hiện nhiệm vụ cuối cùng từ Cơ quan Tình báo. Anh phải chịu trách nhiệm di chuyển Seobok, một đối tượng thử nghiệm được tạo ra bằng cách nhân bản tế bào gốc và biến đổi gen.\r\n\r\nTuy nhiên mọi việc không hề suôn sẻ với họ, khi Seobok trở thành mục tiêu của các thế lực khác với những tham vọng và âm mưu khó đoán. Ki-hun sẽ vượt qua tất cả những hiểm nguy đang chực chờ phía trước, hay Seobok cuối cùng sẽ rơi vào tay kẻ muốn chiếm đoạt vận mệnh của toàn nhân loại? Cùng đón xem bộ phim chiếu rạp đang được chờ đợi này.', 'https://www.youtube.com/embed/eFf0nos163o', 1, NULL, NULL),
(15, 'Phim \"1990\"', 'phim-1990', 'rsz_1990.jpg', 'Nhất Trung', 'Diễm My, Ninh Dương Lan Ngọc, Nhã Phương...', '120 phút', '2021-08-19 00:00:00', 'Việt Nam', 4, 10, 'Bộ phim ‘1990’ là cú bắt tay giữa ba ngọc nữ diễn viên tuổi Ngọ của điện ảnh Việt: Diễm My - Ninh Dương Lan Ngọc và Nhã Phương.\r\n\r\nPhim ‘1990’ thuộc thể loại Hài - Tình cảm, có nội dung xoay quanh một hội bạn thân gồm ba cô gái với ba cá tính khác nhau. Khi ngưỡng tuổi “30 chênh vênh” ập đến với cả ba vào cùng một thời điểm, hàng loạt những vấn đề về hôn nhân, công việc, tình yêu, sự nghiệp,... lần lượt xuất hiện, buộc họ phải giúp đỡ, tương trợ lẫn nhau vượt qua cột mốc đầy sóng gió này.', 'https://www.youtube.com/embed/bDRGW_d-3XI', 1, NULL, NULL),
(16, 'Thám Tử Lừng Danh Conan: Viên Đạn Đỏ', 'tham-tu-lung-danh-conan-vien-dan-do', 'conan.jpg', 'Nagaoka Tomoka', 'Takayama Minami, Yamazaki Wakana, Koyama Rikiya, Yamaguchi Kappei', '110 phút', '2021-08-24 00:00:00', 'Nhật Bản', 4, 6, 'Phim lấy bối cảnh khi thành phố Tokyo (Nhật Bản) đang chuẩn bị đón đợt thế vận hội thể thao lớn nhất thế giới có tên \"WSG: World Sports Games\". Đây cũng là một sự kiện quan trọng để Nhật Bản công bố với thế giới về chuyến tàu \"tuyến tính siêu dẫn chân không\" có 1-0-2.\r\n\r\nNội dung phim kể về hành trình thám tử Conan đi tìm lời giải cho sự mất tích bí ẩn của những nhà tài trợ cho thế vận hội. Bộ phim hứa hẹn mang lại một màn đấu trí vô cùng đặc sắc.', 'https://www.youtube.com/embed/Jrt1aUU2_Xs', 1, NULL, NULL),
(18, 'Bố già', 'Bo-gia', 'bo-gia.jpg', 'Vũ Ngọc Đãng', 'Trấn Thành, NSND Ngọc Giàu, Tuấn Trần, Ngân Chi, Lê Giang,…', '128 phút', '2021-03-12 00:00:00', 'Việt Nam', 4, 5, 'Với nội dung nhân văn, đầy ý nghĩa mà web-drama Bố Già đã gặt hái được những thành công vang dội. Để tiếp nối thành công đó, phim điện ảnh Bố Già ra mắt với mong muốn mang tới cho khán giả Việt Nam một làn gió mới.\r\n\r\nBộ phim xoay quanh về gia đình nhỏ của Ba Sang và Quắn, sống trong một khu xóm lao động nghèo. Ba Sang là một người hay lo chuyện bao đồng, luôn yêu thương con trai nhưng khoảng cách giữa những thế hệ đã khiến cho cả hay xảy ra nhiều mâu thuẫn. Liệu tình cảm của 2 bố con nhà ba Sang có trở nên tốt đẹp hơn và tạo nên gắn kết từ những sự khác biệt? \r\nBố Già mang theo thông điệp nhân văn về gia đình, truyền tải tới khán giả những bài học bằng cách kể rất mới. Theo thông tin ghi nhận được, dàn diễn viên trong phim điện ảnh Bố Già vẫn sẽ giữ nguyên như trong web-drama trước đó. Tuy nhiên, lần này, Bố Già sẽ mang đến 1 ông bố hoàn toàn khác và cả những đứa con với số phận cũng rất khác. Nếu yêu thích Bố Già cũng như dàn diễn viên đầy tài năng này, bạn nhớ ra rạp để ủng hộ phim.', 'https://www.youtube.com/embed/jluSu8Rw6YE', 1, NULL, NULL),
(19, '123', '123', 'bo-gia-abc.jpg', 'đ', 'd', '128 phút', '2021-07-02 00:00:00', 'Việt Nam', 4, 12, 'đasadsdsadsa', 'https://www.youtube.com/embed/jluSu8Rw6YE', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `food_drink`
--

CREATE TABLE `food_drink` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` decimal(65,0) NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `food_drink`
--

INSERT INTO `food_drink` (`ID`, `Name`, `Image`, `Price`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'LINE 3 SINGLE COMBO', 'bap-nuoc.png', '259000', '<p>1 ly Line 3 (kèm nước) + 1 bắp ngọt lớn</p>\r\n<p>* Miễn phí đổi vị bắp Phô mai, Caramel *</p>\r\n<p>**Nhận trong ngày xem phim**</p>', NULL, NULL),
(2, 'CGV SNACK COMBO', 'bap-nuoc.jpg', '109000', '<p>1 Bắp Lớn + 2 Nước Lớn + 1 Snack. Nhận trong ngày xem phim.</p>\r\n<p>* Miễn phí đổi vị bắp Caramel *</p>\r\n<p>**Đổi vị phô mai phụ thu thêm tiền**</p>', NULL, NULL),
(3, 'MY SNACK COMBO', 'bap-nuoc-1.png', '89000', '<p>1 Bắp Vừa + 1 Nước Siêu Lớn + 1 Snack. Nhận trong ngày xem phim.</p>\r\n<p>* Miễn phí đổi vị bắp Caramel *</p>\r\n<p>**Đổi vị phô mai phụ thu thêm tiền**</p>', NULL, NULL),
(4, 'CGV COMBO', 'bap-nuoc.jpg', '99000', '<p>1 bắp lớn + 2 nước lớn. Nhận trong ngày xem phim.</p>\r\n<p>* Miễn phí đổi vị bắp Caramel *</p>\r\n<p>**Đổi vị phô mai phụ thu thêm tiền**</p>', NULL, NULL),
(6, 'sua', 'bo-gia-abc.jpg', '71900', '<p>ngon</p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member`
--

CREATE TABLE `member` (
  `ID` int(11) NOT NULL,
  `Point` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `member`
--

INSERT INTO `member` (`ID`, `Point`, `Name`, `created_at`, `updated_at`, `User_ID`) VALUES
(1, 30, 'Đồng', NULL, NULL, 1),
(2, 10, 'Đồng', NULL, NULL, 2),
(3, 20, 'Đồng', NULL, NULL, 4),
(4, 20, 'Đồng', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(34, '2021_06_25_064045_create_film_table', 2),
(35, '2021_06_25_065234_create_category_table', 2),
(36, '2021_06_25_065413_create_categoryfilm_table', 2),
(37, '2021_06_25_070158_create_comment_table', 2),
(38, '2021_06_25_070411_create_reply_table', 2),
(39, '2021_06_25_070821_create_food_drink_table', 2),
(40, '2021_06_25_071050_create_book_ticket_table', 2),
(41, '2021_06_25_071524_create_book_fd_table', 2),
(42, '2021_06_25_071730_create_member_table', 2),
(43, '2021_06_25_072211_create_room_table', 2),
(44, '2021_06_25_072300_create_room_detail_table', 2),
(45, '2021_06_25_072547_create_book_sit_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reply`
--

CREATE TABLE `reply` (
  `ID` int(11) NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  `Comment_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reply`
--

INSERT INTO `reply` (`ID`, `Content`, `CreatedDate`, `created_at`, `updated_at`, `User_ID`, `Comment_ID`) VALUES
(1, 'def glm', '2021-06-28 10:23:33', NULL, NULL, 2, 1),
(2, 'clgt?????????????????', '2021-06-28 14:17:17', NULL, NULL, 1, 1),
(3, 'Phim đúng chuẩn kinh dị', '2021-06-28 14:21:55', NULL, NULL, 1, 3),
(4, 'Phim hay mà', '2021-06-28 14:26:42', NULL, NULL, 2, 3),
(5, 'Ôi cô cô cũng xem phim này hả?', '2021-07-04 21:07:35', NULL, NULL, 2, 5),
(6, 'Ok babe', '2021-07-05 14:33:20', NULL, NULL, 4, 8),
(7, 'Nhạt như cô cô bình luận vậy', '2021-07-07 09:44:11', NULL, NULL, 5, 9),
(8, 'cam on ban', '2021-07-07 10:08:25', NULL, NULL, 5, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`ID`, `Name`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'Phòng 1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_detail`
--

CREATE TABLE `room_detail` (
  `ID` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `Row` int(11) NOT NULL,
  `Column` int(11) NOT NULL,
  `Price` decimal(8,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Room_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_detail`
--

INSERT INTO `room_detail` (`ID`, `Level`, `Row`, `Column`, `Price`, `created_at`, `updated_at`, `Room_ID`) VALUES
(1, 1, 3, 10, '15', NULL, NULL, 1),
(2, 2, 4, 10, '10', NULL, NULL, 1),
(3, 3, 3, 10, '5', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BirthDay` datetime NOT NULL,
  `Type` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `Account`, `Password`, `Fullname`, `Address`, `Phone`, `Sex`, `BirthDay`, `Type`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'hung5001', '12345', 'Hưng Đỗ Công', 'Hà Nội', '0362243247', 'Nam', '1996-02-15 00:00:00', 1, 1, NULL, NULL),
(2, 'duongqua', '12345', 'Dương Quá', 'Núi Võ Đang', '0849965645', 'Nam', '1990-01-01 00:00:00', 1, 1, NULL, NULL),
(3, 'admin', '123456', 'Administrator', '', '', '', '0000-00-00 00:00:00', 0, 1, NULL, NULL),
(4, 'longcoco', '12345', 'Long Cô Cô', 'Hoàng Quốc Việt - Cầu Giấy-Hà Nội', '0849965645', 'Nữ', '1980-01-01 00:00:00', 1, 1, NULL, NULL),
(5, 'truongtp', '12345', 'Trương Tam Phong', 'Yang hoo', '0978654321', 'Nam', '1988-01-01 00:00:00', 1, 1, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book_fd`
--
ALTER TABLE `book_fd`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `book_fd_bookticket_id_foreign` (`BookTicket_ID`),
  ADD KEY `book_fd_fooddrink_id_foreign` (`FoodDrink_ID`);

--
-- Chỉ mục cho bảng `book_sit`
--
ALTER TABLE `book_sit`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `book_sit_bookticket_id_foreign` (`BookTicket_ID`),
  ADD KEY `book_sit_roomdetail_id_foreign` (`RoomDetail_ID`);

--
-- Chỉ mục cho bảng `book_ticket`
--
ALTER TABLE `book_ticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `book_ticket_user_id_foreign` (`User_ID`),
  ADD KEY `book_ticket_film_id_foreign` (`Film_ID`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `categoryfilm`
--
ALTER TABLE `categoryfilm`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `categoryfilm_category_id_foreign` (`Category_ID`),
  ADD KEY `categoryfilm_film_id_foreign` (`Film_ID`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `comment_user_id_foreign` (`User_ID`),
  ADD KEY `comment_film_id_foreign` (`Film_ID`);

--
-- Chỉ mục cho bảng `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `food_drink`
--
ALTER TABLE `food_drink`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `member_user_id_foreign` (`User_ID`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `reply_user_id_foreign` (`User_ID`),
  ADD KEY `reply_comment_id_foreign` (`Comment_ID`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `room_detail`
--
ALTER TABLE `room_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `room_detail_room_id_foreign` (`Room_ID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `book_fd`
--
ALTER TABLE `book_fd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `book_sit`
--
ALTER TABLE `book_sit`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `book_ticket`
--
ALTER TABLE `book_ticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `categoryfilm`
--
ALTER TABLE `categoryfilm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `film`
--
ALTER TABLE `film`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `food_drink`
--
ALTER TABLE `food_drink`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `reply`
--
ALTER TABLE `reply`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `room_detail`
--
ALTER TABLE `room_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `book_fd`
--
ALTER TABLE `book_fd`
  ADD CONSTRAINT `book_fd_bookticket_id_foreign` FOREIGN KEY (`BookTicket_ID`) REFERENCES `book_ticket` (`ID`),
  ADD CONSTRAINT `book_fd_fooddrink_id_foreign` FOREIGN KEY (`FoodDrink_ID`) REFERENCES `food_drink` (`ID`);

--
-- Các ràng buộc cho bảng `book_sit`
--
ALTER TABLE `book_sit`
  ADD CONSTRAINT `book_sit_bookticket_id_foreign` FOREIGN KEY (`BookTicket_ID`) REFERENCES `book_ticket` (`ID`),
  ADD CONSTRAINT `book_sit_roomdetail_id_foreign` FOREIGN KEY (`RoomDetail_ID`) REFERENCES `room_detail` (`ID`);

--
-- Các ràng buộc cho bảng `book_ticket`
--
ALTER TABLE `book_ticket`
  ADD CONSTRAINT `book_ticket_film_id_foreign` FOREIGN KEY (`Film_ID`) REFERENCES `film` (`ID`),
  ADD CONSTRAINT `book_ticket_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Các ràng buộc cho bảng `categoryfilm`
--
ALTER TABLE `categoryfilm`
  ADD CONSTRAINT `categoryfilm_category_id_foreign` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`ID`),
  ADD CONSTRAINT `categoryfilm_film_id_foreign` FOREIGN KEY (`Film_ID`) REFERENCES `film` (`ID`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_film_id_foreign` FOREIGN KEY (`Film_ID`) REFERENCES `film` (`ID`),
  ADD CONSTRAINT `comment_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Các ràng buộc cho bảng `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Các ràng buộc cho bảng `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_comment_id_foreign` FOREIGN KEY (`Comment_ID`) REFERENCES `comment` (`ID`),
  ADD CONSTRAINT `reply_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Các ràng buộc cho bảng `room_detail`
--
ALTER TABLE `room_detail`
  ADD CONSTRAINT `room_detail_room_id_foreign` FOREIGN KEY (`Room_ID`) REFERENCES `room` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
