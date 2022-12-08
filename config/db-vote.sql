-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 10:39 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_school`
--

CREATE TABLE `admin_school` (
  `id` int(11) NOT NULL,
  `fullname_admin` varchar(200) NOT NULL,
  `admin_code` varchar(15) NOT NULL,
  `profile_img` varchar(300) NOT NULL,
  `department` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `passwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_school`
--

INSERT INTO `admin_school` (`id`, `fullname_admin`, `admin_code`, `profile_img`, `department`, `position`, `passwd`) VALUES
(2, 'kingadminone', '5678943210', 'img_606af2697ca38.jpg', 'Super Admin', 'Zeroadmin', 'zeroadmin'),
(3, 'bill gate', '6001203345', 'img_6060d1a162818.jpg', 'Electronic', 'teacher', 'billgate123'),
(4, 'stip jobs', '6139010023', 'img_606986924553d.jpg', 'computerbusiness', 'teacher', 'jobs123123');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `candi_id` int(11) NOT NULL,
  `profile_img` varchar(300) NOT NULL,
  `fullname` varchar(240) NOT NULL,
  `title` varchar(300) NOT NULL,
  `subContent` text NOT NULL,
  `department` varchar(150) NOT NULL,
  `number` int(11) NOT NULL,
  `id_type_vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candi_id`, `profile_img`, `fullname`, `title`, `subContent`, `department`, `number`, `id_type_vote`) VALUES
(9, 'img_603011f569cc5.jpg', 'java language', 'Dev ops', ' ecosystem เยอะตั้งแต่ desktop, browser, mobile, IoT ดังนั้นความต้องการยังสูงมาก ๆ', 'Other', 1, 12),
(11, 'img_6031493f2c747.jpg', 'layolio parodis', 'Hunter Physician', 'ฝีมือด้านการต่อสู้จะไม่มากนัก แต่มีความรู้เรื่องต่างๆดีเยี่ยม คอยเป็นที่ปรึกษาให้กลุ่มเสมอ ในทีแรกคิรัวร์คิดว่าเลโอลีโอมีเน็นสายเสริมพลัง แต่แท้จริงแล้วเป็นสายแผ่พุ่ง', 'MedicalElectronics', 4, 13),
(14, 'img_60314b503f1d7.jfif', 'hisoka morrows', 'hunter killer', 'เน็นสายเปลียนแปลง ท่าไม้ตาย : \"บันจี้ กัม\" คือการเปลี่ยนออร่าให้มีคุณสมบัติคล้ายหมากฝรั่ง ยืดหดได้อย่างรวดเร็วและจะเกาะติดกับเป้าหมายจนกว่าฮิโซกะจะปลด และ \"เท็กซ์เจอร์พิสดาร\" เปลี่ยนสภาพผิววัตถุบางๆให้กลายเป็นพื้นผิวของวัตถุอย่างอื่น ไม่ว่าพื้นผิวแบบใดก็สามารถลอกเลียนได้ทั้งสิ้น ตั้งแต่ผิวหนังมนุษย์ กระดาษ ต้นไม้ หิน ฯลฯ', 'ComputerBusiness', 6, 13),
(15, 'img_603295b715fdf.jpg', 'King Meruem', 'chimera ant', 'ราชาคิเมร่าแอ๊น เกิดจากการที่ราชินีคิเมร่าแอ๊นกินเนื้อมนุษย์เข้าไปจำนวนมากเพื่อที่จะสร้างราชาคิเมร่าแอ๊นขึ้นมา โดยตอนเขาเกิดได้ตั้งชื่อว่า \"เมลเอม\" ที่แปลว่า แสงสว่างที่ส่องไปทุกที่ เกิดมาก็มีพลังอันแกร่งกล้า ทั้งยังโปรดปรานมนุษย์ที่มีความสามารถใช้เน็น มีความต้องการปกครองโลกโดยได้ไปยึดครองประเทศกอลโต้ตะวันออกเป็นแห่งแรก\r\n', 'ComputerBusiness', 8, 13),
(16, 'img_603528a028e0b.jpg', 'monky d lufy', 'กลุ่มหมวกฟาง', 'ลูฟี่มีพลังพิเศษจากการกินผลไม้ปีศาจ คือ ผลโกมุ โกมุ (ยาง) บวกกับทักษะการต่อสู้ และใจที่อึดเข้มแข็ง กับวีรกรรมมากมายที่เขาและพวกได้ก่อไว้ ทำให้เขากลายเป็นโจรสลัดรุ่นใหม่ที่มีค่าหัวสูงมากคนหนึ่ง', 'ComputerBusiness', 11, 17),
(17, 'img_603529ce9c595.jpg', 'rorono r solo', 'กลุ่มหมวกฟาง', 'โซโรเป็นผู้เชี่ยวชาญสูงสุดในการต่อสู้โดยใช้ดาบเป็นอาวุธ เขาสามารถสู้ด้วยดาบ 1 ถึง 3 เล่มพร้อมกันได้ แต่จะสู้ได้ดีที่สุดหากใช้ดาบทั้ง 3 เล่มพร้อมกัน', 'CyberSecurity', 4, 17),
(24, 'img_6067fb9acf072.jpg', 'trafranga D warter lows', 'pirate Hard', 'pirate Hard widthfrom nortblue flywanst', 'MedicalElectronics', 2, 17),
(25, 'img_60807d67208a9.jpg', 'node js', 'programming languages', 'nodjs คือ library ตัวหนึงของ javascript', 'อื่นๆที่ไม่ใช้บุคคล', 4, 12),
(26, 'img_608080c04a2bb.jpg', 'python', 'programming languages', 'Python คือชื่อภาษาที่ใช้ในการเขียนโปรแกรมภาษาหนึ่ง ซึ่งถูกพัฒนาขึ้นมาโดยไม่ยึดติดกับแพลตฟอร์ม กล่าวคือสามารถรันภาษา Python ได้ทั้งบนระบบ Unix, Linux , Windows NT, Windows 2000, Windows XP หรือแม้แต่ระบบ FreeBSD อีกอย่างหนึ่งภาษาตัว นี้เป็น OpenSource เหมือนอย่าง PHP ทำให้ทุกคนสามารถที่จะนำ Python มาพัฒนาโปรแกรมของเราได้ฟรีๆโดยไม่ต้องเสียค่าใช้จ่าย', 'อื่นๆที่ไม่ใช้บุคคล', 5, 12),
(27, 'img_6080810d34daa.png', 'php', 'programming languages', 'ความสามารถของ PHP นั้น สามารถที่จะทำงานเกี่ยวกับ Dynamic Web ได้ทุกรูปแบบ เหมือนกับ CGI หรือ ASP ไม่ว่าจะเป็นการดูแลจัดการระบบฐานข้อมูล ระบบรักษาความปลอดภัยของเว็บเพจ การรับ – ส่ง Cookies เป็นต้น', 'อื่นๆที่ไม่ใช้บุคคล', 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `colletion_id`
--

CREATE TABLE `colletion_id` (
  `get_id` int(11) NOT NULL,
  `id_vote` int(11) NOT NULL,
  `id_candidate` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colletion_id`
--

INSERT INTO `colletion_id` (`get_id`, `id_vote`, `id_candidate`, `id_user`) VALUES
(1, 13, 15, 6),
(2, 17, 17, 6),
(3, 17, 17, 10),
(4, 17, 16, 11),
(5, 13, 11, 10),
(6, 13, 14, 11),
(7, 13, 11, 12),
(8, 17, 16, 12),
(9, 12, 25, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_students`
--

CREATE TABLE `user_students` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `student_code` varchar(13) NOT NULL,
  `profile_img` varchar(300) NOT NULL,
  `department` varchar(220) NOT NULL,
  `year_of_study` varchar(7) NOT NULL,
  `passwd` varchar(120) NOT NULL,
  `sex` int(2) NOT NULL,
  `age` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_students`
--

INSERT INTO `user_students` (`user_id`, `fullname`, `student_code`, `profile_img`, `department`, `year_of_study`, `passwd`, `sex`, `age`) VALUES
(10, 'kilua soldic', '6134657780', 'img_60686e8955f8f.jpg', 'accounting', 'ปวช 3', 'kilua123123', 1, 19),
(11, 'tranfarga d warter lows', '6132510033', 'img_6060d0e8723e0.jpg', 'dataSci', 'ปวส 1', 'lows123123', 1, 20),
(12, 'liolayo paradainst', '6132510044', 'img_6060d20561d5c.jpg', 'Medical electronics', 'ปวส 1', 'liolayo123', 1, 19),
(14, 'hisoka morrow', '6139020055', 'img_60761164e2218.jpg', 'Fashion technology and appare', 'ปวส 2', 'hisoka123', 1, 22),
(15, 'bisket kurker', '6139030055', 'img_607685a2c942f.png', 'Business foreign languages', 'ปวส 2', 'bisked123', 2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `vote_all`
--

CREATE TABLE `vote_all` (
  `vote_id` int(11) NOT NULL,
  `subtitle` varchar(150) NOT NULL,
  `detail` text NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `image` varchar(300) NOT NULL,
  `class_key` varchar(100) NOT NULL,
  `id_admin_the_creater_vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vote_all`
--

INSERT INTO `vote_all` (`vote_id`, `subtitle`, `detail`, `open_date`, `close_date`, `open_time`, `close_time`, `image`, `class_key`, `id_admin_the_creater_vote`) VALUES
(12, 'Programming Language', 'The scope of SIGPLAN is the theory, design, implementation, description, and application of computer programming languages', '2021-02-20', '2021-04-23', '00:00:00', '05:00:00', 'img_6080813f28c10.jpg', '2021', 3),
(13, 'hunter x hunter', 'กลุ่มคนที่สอบผ่านการคัดเลือกทางด้านร่างกายและจิตใจ โดยการสอบในแต่ละปีจะเปลี่ยนรูปแบบไปเรื่อยๆขึ้นอยู่กับทางกรรมการผู้คุมสอบ เมื่อสอบผ่านแล้วจะมีการมอบการ์ดฮันเตอร์ เพื่อแสดงตัวว่าเป็นฮันเตอร์ที่แท้จริง สามารถใช้ประโยชน์ได้หลายอย่าง เช่น ใช้เป็นบัตรผ่านสำหรับเข้าประเทศหรือสถานที่ ที่ห้ามคนทั่วไปเข้า หรือแม้แต่ ใช้เป็นหลักประกันในการกู้เงินเป็นจำนวนมากๆได้ และมีการจัดระดับตามความสามารถในการสร้างชื่อเสียงและช่วยเหลือสังคมได้', '2021-02-21', '2021-04-22', '00:00:00', '15:20:00', 'img_603137683bf8c.jpg', 'open', 3),
(17, 'Oneplece 2021', 'ซีรีส์ cartoon มุ่งสนใจมังกี้ ดี. ลูฟี่ ชายหนุ่มผู้ได้รับแรงบันดาลใจจากไอดอลวัยเด็กและโจรสลัดทรงพลัง ', '2021-02-24', '2021-04-22', '00:00:00', '00:00:00', 'img_603525e28ebfe.jpg', '2000', 2),
(20, 'travel of Thailand', 'travel of Thailand new 2021 get vote all number', '2021-04-22', '2021-04-22', '15:23:00', '23:00:00', 'img_608131ac8bccf.jpg', 'open', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_school`
--
ALTER TABLE `admin_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`candi_id`);

--
-- Indexes for table `colletion_id`
--
ALTER TABLE `colletion_id`
  ADD PRIMARY KEY (`get_id`);

--
-- Indexes for table `user_students`
--
ALTER TABLE `user_students`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vote_all`
--
ALTER TABLE `vote_all`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_school`
--
ALTER TABLE `admin_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `colletion_id`
--
ALTER TABLE `colletion_id`
  MODIFY `get_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_students`
--
ALTER TABLE `user_students`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vote_all`
--
ALTER TABLE `vote_all`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
