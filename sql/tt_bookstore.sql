-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 07, 2024 lúc 05:35 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tt_bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` decimal(10,0) NOT NULL,
  `productImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `userId`, `productId`, `qty`, `productName`, `productPrice`, `productImage`) VALUES
(131, 1, 10, 1, 'Tuyển Tập Truyện Hay Cho Bé Tập 2- Giúp Bé Phát Triển Ngôn Ngữ Và Nhận Thức - ndbooks', 78000, '09b14bc9ec.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(1, 'Sách Văn Học', 1),
(2, 'Sách Đời Sống', 1),
(3, 'Truyện Tranh', 1),
(14, 'Sách Ngoại Ngữ', 1),
(15, 'Sách Thiếu Nhi', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `queries` varchar(255) NOT NULL,
  `replies` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chatbot`
--

INSERT INTO `chatbot` (`id`, `queries`, `replies`) VALUES
(1, 'hi|hello|hey|hy', 'Hello');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `receivedDate` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `userId`, `createdDate`, `receivedDate`, `status`, `fullname`, `phoneNumber`, `address`) VALUES
(19, 1, '2024-06-07', NULL, 'Processing', 'Huynh Hoai', '0321597549', ' kkk');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `productPrice` decimal(10,0) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `orderId`, `productId`, `qty`, `productPrice`, `productName`, `productImage`) VALUES
(22, 19, 1, 3, 124000, 'Mèo Pete Tớ Yêu Đôi Giày Trắng', 'meo_pete.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `originalPrice` decimal(10,0) NOT NULL,
  `promotionPrice` decimal(10,0) NOT NULL,
  `image` varchar(50) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `cateId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `soldCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `originalPrice`, `promotionPrice`, `image`, `createdBy`, `createdDate`, `cateId`, `qty`, `des`, `status`, `soldCount`) VALUES
(1, 'Mèo Pete Tớ Yêu Đôi Giày Trắng', 150000, 124000, 'meo_pete.webp', 1, '2024-06-06', 1, 12, '<p>Hiểu thời đại đang sống thông qua sách, song hành với những biến chuyển sâu sắc trong lòng xã hội bằng những hoạt động xuất bản miệt mài và quả cảm, con đường Nhã Nam đã chọn để đi sẽ còn dài. Nhiều khó khăn, thử thách đang ở phía trước. Bước qua thời kỳ sơ khai với những bài học và những kinh nghiệm đầu tiên, Nhã Nam giờ đã sẵn sàng cho một chặng đường phát triển mới. Và chúng tôi muốn hoàn thiện mình trong sự cầu thị và cẩn trọng. Tất cả vì một gia sản sách to lớn, có sức sống dài lâu, có ý nghĩa với nhiều thế hệ bạn đọc.<br>\r\nBởi vì sách là thế giới. </p>', 1, 3),
(2, 'Anne Tóc Đỏ Dưới Mái Nhà Bạch Dương (Tái Bản 2019)', 250000, 180000, 'anne.png', 1, '2024-06-05', 1, 20, '<p>Bạch Dương Lộng Gió, dẫu chỉ là chốn tạm dừng chân của cô cử nhân Anne trong nhiệm kỳ làm hiệu trưởng trường trung học Summerside, nhưng vẫn níu kéo trái tim chẳng khác nào Chái Nhà Xanh yêu dấu. Ba năm nơi thị trấn yên bình ấy chẳng ngờ lại vô cùng sôi động với biết bao nhân vật mới mẻ thú vị (đến mức quái gở) cùng vô số các cuộc phiêu lưu khơi gợi tiếng cười lẫn những giọt nước mắt. Ba năm chứng kiến một Anne Shirley trưởng thành hơn, khôn ngoan hơn, một phụ nữ quyến rũ đích thực, nhưng thẳm sâu trong tim vẫn là cô gái vô tư, rạng ngời, háo hức tận hưởng mọi trải nghiệm trên bước đường phía trước, và nhất là… nhất là… đang yêu.</p>', 1, 5),
(3, 'Hannibal (Tái Bản 2018)', 150000, 89000, 'hannibal.png', 1, '2024-06-02', 1, 18, '<p>Được xem là một trong những sự kiện văn chương được chờ đợi nhất,<i> Hannibal và những ngày run rẩy bắt đầu</i> mang người đọc vào cung điện ký ức của một kẻ ăn thịt người, tạo dựng nên một bức chân dung ớn lạnh của tội ác đang âm thầm sinh sôi – một thành công của thể loại kinh dị tâm lý.<br>\r\nVới Mason Verger, nạn nhân đã bịHannibal biến thành kẻ người không ra người,Hannibal là mối hận thù nhức nhối da thịt.</p>', 1, 9),
(5, 'Mọi Nỗ Lực Và Chờ Đợi Của Bạn Đều Có Ý Nghĩa', 180000, 102000, 'capture-3.png', 1, '2024-06-06', 2, 10, '<p>Bạn đã bao giờ cảm thấy lạc lối chưa?<br>\r\nQuá trình lớn lên - trưởng thành - phát triển hay chính là quá trình chúng ta bắt đầu rời xa bàn tay bảo bọc của bố mẹ là quãng thời gian mà bản thân mối chúng ta dễ trở nên mông lung, lạc lối nhất. Bạn sống đơn giản, thế nào cũng được thì quá trình đó sẽ xuất hiện chậm hơn một chút. Bạn lớn nhanh hơn một chút, biết suy nghĩ nhiều hơn thì quá trình đó cũng xuất hiện sớm hơn.</p>', 1, 0),
(10, 'Tuyển Tập Truyện Hay Cho Bé Tập 2- Giúp Bé Phát Triển Ngôn Ngữ Và Nhận Thức - ndbooks', 90000, 78000, '09b14bc9ec.png', 1, '2024-06-06', 3, 30, '<p>Tuyển tập truyện hay cho bé là tập hợp những câu chuyện thú vị, bổ ích và chứa dựng nhiều bài học giáo dục sâu sắc. Sau khi đọc xong mỗi câu chuyên, bố mẹ hãy cùng bé tìm hiểu thêm về tình huống, các nhân vật qua câu hỏi ở cuối trang. Thông qua câu trả lời, bố mẹ sẽ định hưởng cho bé những điều đúng, điều sai, việc làm nào là tốt, việc làm nào là chưa tốt. Từ đó hình thành phẩm chất đạo đức tốt đẹp ở bé. Đồng thời, giúp cho quá trình giao tiếp giữa bố mẹ và bé trở nên đáng nhớ và đầy ý nghĩa. Bé cũng hình thành kĩ năng lắng nghe, giao tiếp và phát triển trí tưởng tượng, sáng tạo, vốn từ vựng phong phú.<br>\r\nGiờ bé hãy lật mở từng trang sách, lắng nghe những câu chuyện. Cả một thế giới diệu kì, bất ngờ và thú vị đang chờ đợi các bé ở phía trước. Và rất có thể bé sẽ gặp chính minh trong các câu chuyện đó đấy!</p>', 1, 0),
(114, 'Tự Học Tiếng Anh Cấp Tốc - Instant Self-study English', 250000, 250000, 'df8e8517d8.png', 1, '2024-06-07', 14, 15, '<p><b>Hoang mang không biết bắt đầu từ đâu?</b><br>\r\n– Câu này thì phải đến 90% người học đưa ra và nó thể hiện sự bế tắc khi các bạn đâm đầu vào “biển” tiếng Anh. Để đi đến cái tâm lý “hoang mang” này là hàng nghìn câu chuyện khác nhau của người học, trong đó nổi bật lên là những lý do đã kể trên. Trước đây thì người ta sẽ hỏi bạn rằng học tiếng Anh để làm gì? Câu hỏi để bạn biết mục tiêu của mình. Còn bây giờ tôi lại hỏi bạn một câu: Tại sao bạn lại không biết bắt đầu từ đâu nhỉ? Tiếng Anh có nhiều tài liệu đủ kỹ năng và chia đủ các trình độ nhưng bạn vẫn hoang mang lo lắng về việc bắt đầu của mình. Bạn hãy đặt một câu hỏi khác: Mình học thế nào khiến mình tập trung nhất? Ở đây vấn đề là cách học chứ không phải kiến thức bắt đầu.<br>\r\n– Bạn hãy thay đổi suy nghĩ tích cực trước khi bắt đầu làm việc gì đó. Học ngoại ngữ là cả một chặng đường nên bạn không cần phải đi tìm vạch xuất phát mà nên tìm hiểu cách đi trên con đường dài ấy như thế nào. Bạn là người biết rõ nhất mình muốn gì, cầ', 1, 0),
(115, 'Cambridge IELTS 5 With Answers', 450000, 399000, 'fc31dc4572.webp', 1, '2024-06-07', 14, 5, '<p></p>', 1, 0),
(116, '5000 Từ Vựng Tiếng Trung Bỏ Túi - Bí Kíp Chinh Phục Từ Vựng Kỳ Thi Hsk 1 - 6', 380000, 350000, 'd6e363e0bc.png', 1, '2024-06-07', 14, 8, '<p>Nhằm đáp ứng nhu cầu học từ vựng của bạn đọc, chúng tôi xin giới thiệu cuốn sách <b>5000 từ vựng tiếng Trung bỏ túi – Bí kíp chinh phục từ vựng kỳ thi HSK 1 – 6</b> tổng hợp những từ vựng tếng Trung được sử dụng với tần suất nhiều nhất trong các kỳ thi HSK. Ngoài việc liệt kê những từ vựng thông dụng, chúng tôi còn đưa ra cách phát âm, âm Hán Việt, nghĩa cũng như ví dụ minh họa để các bạn có thể hiểu rõ và sử dụng đúng từ vựng vừa học, từ đó giúp các bạn nâng cao vốn từ vựng và nâng cao khả năng tiếng Trung, đặc biệt là đạt kết quả tốt trong các kỳ thi HSK.<br>\r\nChúng tôi hy vọng cuốn sách sẽ là tài liệu bổ ích giúp các bạn hoàn thiện vốn từ vựng của mình và học tiếng Trung một cách thật hiệu quả.</p>', 1, 0),
(117, '5000 Từ Vựng Tiếng Nhật Thông Dụng', 350000, 320000, 'b904f69c48.png', 1, '2024-06-07', 14, 30, '<p>Để giao tiếp thành thạo một ngôn ngữ thì từ vựng là một trong những yếu tố then chốt hàng đầu. Nếu xây dựng được cho mình một vốn từ vựng đủ lớn thì quá trình giao tiếp của bạn sẽ trở nên trơn tru và đơn giản hơn rất nhiều. Bởi vậy một cuốn sách tổng hợp từ vựng tiếng Nhật thông dụng là cực kỳ cần thiết, giúp bạn dễ dàng nắm bắt, theo dõi, mở rộng và nâng cao kho từ vựng của mình trong quá trình học tiếng Nhật.</p>', 1, 0),
(118, 'Mukang từ vựng tiếng Hàn 2', 350000, 320000, 'e9f354d88c.webp', 1, '2024-06-07', 14, 17, '<p>Người đang học tiếng Hàn nhưng gặp khó khăn trong việc ghi nhớ từ vựng (học trước quên sau, đã từng thử nhiều phương pháp học từ vựng nhưng vẫn không hiệu quả, khả năng ghi nhớ kém)Học sinh, sinh viên mới bắt đầu học tiếng Hàn.<br>\r\nNgười đi làm không có nhiều thời gian rảnh và cần nâng cao vốn từ để giao tiếp.</p>', 1, 0),
(119, 'STICKER BÓC DÁN THÔNG MINH ( 2-6 TUỔI ) TẬP 3', 60000, 35000, '9ace75409c.png', 1, '2024-06-07', 15, 60, '<p></p>', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Normal'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `statistical`
--

CREATE TABLE `statistical` (
  `id` int(11) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `sales` varchar(200) NOT NULL,
  `profit` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address` varchar(500) NOT NULL,
  `isConfirmed` tinyint(4) NOT NULL DEFAULT 0,
  `captcha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `dob`, `password`, `role_id`, `status`, `address`, `isConfirmed`, `captcha`) VALUES
(1, 'admin@gmail.com', 'Admin', '0000-00-00', '0cc175b9c0f1b6a831c399e269772661', 1, 1, '', 1, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `product_id` (`productId`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`orderId`),
  ADD KEY `product_id` (`productId`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_id` (`cateId`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `statistical`
--
ALTER TABLE `statistical`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `statistical`
--
ALTER TABLE `statistical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cateId`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
