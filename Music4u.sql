-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 08:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music4u`
--

-- --------------------------------------------------------

--
-- Table structure for table `asadmins`
--

CREATE TABLE `asadmins` (
  `Admin_Id` int(11) NOT NULL,
  `AdminUserName` varchar(255) NOT NULL,
  `AdminEmail` varchar(255) NOT NULL,
  `AdminPass` varchar(255) NOT NULL,
  `AdminProfilePic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asadmins`
--

INSERT INTO `asadmins` (`Admin_Id`, `AdminUserName`, `AdminEmail`, `AdminPass`, `AdminProfilePic`) VALUES
(1, 'Meet@412', 'meet41204@gmail.com', 'Meet@412', 'Admins/Mit@2004.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `asartist`
--

CREATE TABLE `asartist` (
  `Artist_Id` int(11) NOT NULL,
  `AName` varchar(255) NOT NULL,
  `AEmail` varchar(255) NOT NULL,
  `AImage` varchar(255) NOT NULL,
  `currenttimestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asartist`
--

INSERT INTO `asartist` (`Artist_Id`, `AName`, `AEmail`, `AImage`, `currenttimestamp`) VALUES
(1, 'A.R Rahman', 'arrahman001@gmail.com', 'AImages/A.R Rahman.jpg', '2025-02-22 09:42:48'),
(2, 'Aditi Singh Sharma', 'aditisinghsharma002@gmail.com', 'AImages/Aditi Singh Sharma.jpg', '2025-02-22 09:43:36'),
(3, 'Arijit Singh', 'arijitsingh003@gmail.com', 'AImages/Arijit Singh.jpg', '2025-02-22 09:44:15'),
(4, 'Ajay-Atul', 'ajayatul004@gmail.com', 'AImages/Ajay-Atul.jpg', '2025-02-22 09:45:11'),
(5, 'Alka Yagnik', 'alkayagnik005@gmail.com', 'AImages/Alka Yagnik.jpg', '2025-02-22 09:45:58'),
(6, 'Amaal-Mallik', 'amaalmallik006@gmail.com', 'AImages/Amaal-Mallik.jpg', '2025-02-22 09:46:45'),
(7, 'Pritam', 'Pritam007@gmai.com', 'AImages/Pritam.jpg', '2025-02-22 09:50:15'),
(8, 'Atif Aslam', 'Atifaslam008@gmail.com', 'AImages/Atif Aslam.jpg', '2025-02-22 10:02:27'),
(9, 'Amit Trivedi', 'amittrivedi009@gmail.com', 'AImages/Amit Trivedi.jpg', '2025-02-22 11:21:39'),
(11, 'Anirudh', 'anirudh011@gmail.com', 'AImages/Anirudh.jpg', '2025-02-22 11:23:40'),
(12, 'Arko', 'arko012gmail.com', 'AImages/Arko.jpeg', '2025-02-22 11:24:26'),
(13, 'Armaan-malik', 'armaanmalik013@gmail.com', 'AImages/Armaan-malik.jpg', '2025-02-22 11:25:20'),
(14, 'Asees Kaur', 'aseeskaur014@gmail.com', 'AImages/Asees Kaur.jpg', '2025-02-22 11:25:55'),
(15, 'Badshah', 'badshah015@gmail.com', 'AImages/Badshah.jpg', '2025-02-22 11:26:28'),
(16, 'Diljit Dosanjh', 'diljitdosanjh016@gmail.com', 'AImages/Diljit Dosanjh.jpg', '2025-02-22 11:27:04'),
(18, 'Jasleen Royal', 'jasleenroyal018@gmail.com', 'AImages/Jasleen Royal.jpeg', '2025-02-22 11:28:18'),
(19, 'Javed Ali', 'javedali019@gmail.com', 'AImages/Javed Ali.jpg', '2025-02-22 11:28:52'),
(20, 'Jonita Gandhi', 'jonitagandhi020@gmail.com', 'AImages/Jonita Gandhi.jpg', '2025-02-22 11:29:57'),
(21, 'Kailash Kher', 'kailashkher021@gmail.com', 'AImages/Kailash Kher.jpg', '2025-02-22 11:30:26'),
(22, 'Kanika Kapoor', 'kanikakapoor022@gmail.com', 'AImages/Kanika Kapoor.jpg', '2025-02-22 11:31:00'),
(23, 'Meet Bros', 'meetbros023@gmail.com', 'AImages/Meet Bros.jpg', '2025-02-22 11:31:51'),
(24, 'Mika Singh', 'mikasingh024@gmail.com', 'AImages/Mika Singh.jpg', '2025-02-22 11:32:25'),
(25, 'Nakash Aziz', 'nakashaziz025@gmail.com', 'AImages/Nakash Aziz.jpg', '2025-02-22 11:32:57'),
(26, 'Neeti Mohan', 'neetimohan026@gmail.com', 'AImages/Neeti Mohan.jpg', '2025-02-22 11:33:26'),
(27, 'Neha Kakkar', 'nehakakkar027@gmail.com', 'AImages/Neha Kakkar.jpg', '2025-02-22 11:34:02'),
(28, 'Raftaar', 'raftaar028@gmail.com', 'AImages/Raftaar.jpeg', '2025-02-22 11:34:28'),
(29, 'Sachet Tandon', 'sachettandon029@gmail.com', 'AImages/Sachet Tandon.jpg', '2025-02-22 11:34:58'),
(30, 'Sachin Jigar', 'sachinjigar030@gmail.com', 'AImages/Sachin Jigar.jpg', '2025-02-22 11:35:27'),
(31, 'Shaner-Esaan-Loy', 'shaneresaanloy031@gmail.com', 'AImages/Shaner-Esaan-Loy.jpg', '2025-02-22 11:36:02'),
(32, 'Shila Rao', 'shilparao032@gmail.com', 'AImages/Shila Rao.jpg', '2025-02-22 11:36:28'),
(33, 'Shreya Ghoshal', 'shreyaghoshal033@gmail.com', 'AImages/Shreya Ghoshal.jpg', '2025-02-22 11:37:03'),
(34, 'Sonu Nigam', 'sonunigam034@gmail.com', 'AImages/Sonu Nigam.jpg', '2025-02-22 11:37:32'),
(35, 'Sunidhi Chauhan', 'sunidhichauhan035@gmail.com', 'AImages/Sunidhi Chauhan.jpg', '2025-02-22 11:38:33'),
(37, 'Tulsi Kumar', 'tulsikumar037@gmail.com', 'AImages/Tulsi Kumar.jpg', '2025-02-22 11:39:54'),
(38, 'Udit Narayan', 'uditnarayan038@gmail.com', 'AImages/Udit Narayan.jpg', '2025-02-22 11:40:20'),
(39, 'Vishal Mishra', 'vishalmishra039@gmail.com', 'AImages/Vishal Mishra.jpg', '2025-02-22 11:41:12'),
(40, 'Vishal-Shekhar', 'vishalshekhar040@gmail.com', 'AImages/Vishal-Shekhar.jpg', '2025-02-22 11:41:42'),
(41, 'Yo Yo Honey Singh', 'yoyohoneysingh041@gmail.com', 'AImages/Yo Yo Honey Singh.jpg', '2025-02-22 11:42:16'),
(42, 'Guru Randhawa', 'gururandhawa042@gmail.com', 'AImages/Guru Randhawa.jpg', '2025-02-22 12:10:26'),
(43, 'Shaan', 'shaan043@gmail.com', 'AImages/Shaan.jpg', '2025-02-22 12:12:08'),
(44, 'MellowD', 'mellowd044@gmail.com', 'AImages/MellowD.jpg', '2025-02-22 12:14:45'),
(45, 'Ikson', 'ikson045@gmail.com', 'AImages/Ikson.jpg', '2025-02-22 12:17:06'),
(46, 'Arivu', 'arivu046@gmail.com', 'AImages/Arivu.jpg', '2025-02-22 12:18:53'),
(47, 'Siddharth B', 'siddharthb047@gmail.com', 'AImages/Siddharth B.jpg', '2025-02-22 12:21:17'),
(48, 'Kumaar', 'kumaar048@gmail.com', 'AImages/Kumaar.jpg', '2025-02-22 12:24:29'),
(49, 'Lothika', 'lothika049@gmail.com', 'AImages/Lothika.jpg', '2025-02-22 12:49:16'),
(50, 'Amitabh B', 'amitabhb050@gmail.com', 'AImages/Amitabh B.jpg', '2025-02-22 12:53:03'),
(51, 'D.S.P', 'dsp051@gmail.com', 'AImages/DSP.jpeg', '2025-02-22 12:59:02'),
(52, 'Neeraj Shridhar', 'neerajshridhar052@gmail.com', 'AImages/Neeraj Shridhar.jpg', '2025-02-22 13:07:29'),
(53, 'Amit Mishra', 'amitmishra053@gmail.com', 'AImages/Amit Mishra.jpg', '2025-02-22 13:31:56'),
(54, 'Vishal Dadlani', 'vishaldadlani054@gmail.com', 'AImages/Vishal Dadlani.jpg', '2025-02-22 13:51:05'),
(55, 'Jubin Nautiyal', 'jubinnautiyaal055@gmail.com', 'AImages/Jubin Nautiyal.jpg', '2025-02-22 14:10:48'),
(56, 'Tanishk Bagchi', 'tanishkbagchi056@gmail.com', 'AImages/Tanishk Bagchi.jpeg', '2025-02-22 14:14:39'),
(57, 'Kumar Sanu', 'kumarsanu057@gmail.com', 'AImages/Kumar Sanu.jpg', '2025-02-22 14:24:14'),
(58, 'Aditya Gadhvi', 'adityagadhvi058@gmail.com', 'AImages/Aditya Gadhvi.jpg', '2025-02-22 14:26:52'),
(59, 'Himesh Reshamiya', 'himeshreshamiya059@gmail.com', 'AImages/Himesh Reshamiya.jpg', '2025-02-23 14:44:26'),
(60, 'Mohit Chauhan', 'mohitchauhan060@gmail.com', 'AImages/Mohit Chauhan.jpg', '2025-02-24 17:27:17'),
(61, 'Thaman S', 'thamans061@gmail.com', 'AImages/Thaman S.jpg', '2025-02-27 13:52:45'),
(62, 'Rahat Fateh Ali Khan', 'rahatfatehalikhan062@gmail.com', 'AImages/Raat Fateh Ali Khan.jpg', '2025-02-27 13:56:54'),
(63, 'Rajesh Roshan', 'rajeshroshan063@gmail.com', 'AImages/Rajesh Roshan.jpg', '2025-03-02 17:38:17'),
(64, 'Dev Negi', 'devnegi064@gmail.com', 'AImages/Dev Negi.jpg', '2025-03-02 17:38:51'),
(65, 'Darshan Raval', 'darshanraval065@gmail.com', 'AImages/Darshan Raval.jpg', '2025-03-02 17:40:50'),
(66, 'Nikhita Gandhi', 'nikhitagandhi066@gmail.com', 'AImages/Nikhita Gandhi.jpg', '2025-03-02 17:42:52'),
(67, 'Param Singh', 'paramsingh067@gmail.com', 'AImages/Param Singh.jpeg', '2025-03-03 18:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `asusers`
--

CREATE TABLE `asusers` (
  `User_Id` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` double NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `ProfilePic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asusers`
--

INSERT INTO `asusers` (`User_Id`, `FullName`, `UserName`, `Email`, `Phone`, `Pass`, `ProfilePic`) VALUES
(1, 'Mit', 'Mit@2004', 'mitprajapati765@gmail.com', 9638527410, 'Mit@2004', 'Users/Meet-2.jpeg'),
(2, 'Darshan', 'Darshan@2004', 'darshan2004@gmail.com', 9638524100, 'Darshan@2004', 'Users/darshan.jpg'),
(3, 'Rahul', 'Rahul@2004', 'Rahul24@gmail.com', 9638527410, 'Rahul@2004', 'Users/person.jpg'),
(10, 'Kishan', 'Kishan@245', 'kishanyadav245@gmail.com', 9685741230, 'Kishan@245', 'Users/Kishan@23.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE `liked` (
  `liked_id` int(11) NOT NULL,
  `Liked_User_Id` int(11) NOT NULL,
  `Liked_Music_Id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`liked_id`, `Liked_User_Id`, `Liked_Music_Id`, `created_at`) VALUES
(19, 1, 113, '2025-03-25 19:04:35'),
(22, 1, 63, '2025-03-25 19:07:40'),
(24, 1, 163, '2025-03-25 19:10:51'),
(35, 1, 91, '2025-03-25 19:46:49'),
(36, 1, 2, '2025-03-25 19:46:53'),
(37, 1, 34, '2025-03-25 19:46:59'),
(38, 1, 61, '2025-03-25 19:47:03'),
(39, 1, 88, '2025-03-25 19:47:08'),
(40, 1, 37, '2025-03-25 19:47:13'),
(41, 1, 70, '2025-03-25 19:47:18'),
(42, 1, 47, '2025-03-25 19:47:23'),
(44, 1, 57, '2025-03-25 19:47:47'),
(45, 1, 112, '2025-03-25 19:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `Playlist_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `PlaylistName` varchar(255) NOT NULL,
  `Created_By_Type` enum('User','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`Playlist_Id`, `User_Id`, `PlaylistName`, `Created_By_Type`) VALUES
(1, 1, 'BCA', 'User'),
(11, 1, 'Adarsh', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `Play_Id` int(11) NOT NULL,
  `List_Id` int(11) DEFAULT NULL,
  `Song_Id` int(11) NOT NULL,
  `ListName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`Play_Id`, `List_Id`, `Song_Id`, `ListName`) VALUES
(10, 1, 2, 'BCA'),
(11, 1, 170, 'BCA'),
(12, 1, 112, 'BCA'),
(13, 1, 47, 'BCA'),
(14, 1, 88, 'BCA'),
(15, 1, 91, 'BCA'),
(16, 1, 34, 'BCA'),
(17, 1, 61, 'BCA'),
(18, 11, 70, 'Adarsh'),
(19, 11, 34, 'Adarsh'),
(20, 11, 91, 'Adarsh');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `Music_Id` int(11) NOT NULL,
  `SongPath` varchar(255) NOT NULL,
  `CoverPath` varchar(255) NOT NULL,
  `ArtistName` varchar(255) NOT NULL,
  `AlbumName` varchar(255) NOT NULL,
  `Lang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`Music_Id`, `SongPath`, `CoverPath`, `ArtistName`, `AlbumName`, `Lang`) VALUES
(1, 'Upload/Aaj Ki Raat (From Stree 2).mp3', 'Images/Aaj-Ki-Raat-From-Stree-2-Hindi-2024.jpg', 'Sachin Jigar, Madhubanti B, Amitabh B, Divya K', 'Stree 2 (2024)', 'Hindi'),
(2, 'Upload/Aayi Nai (From Stree 2).mp3', 'Images/Aayi-Nai-From-Stree-2.jpeg', 'Sachin Jigar, Pawan S, Simran C, Divya K, Amitabh B', 'Stree 2 (2024)', 'Hindi'),
(3, 'Upload/Aithey Aa (From Bharat).mp3', 'Images/Aithey-Aa-From-Bharat--Hindi-2019.jpg', ' Akasa Singh, Kamaal Khan, Neeti Mohan', 'Bharat (2019)', 'Hindi'),
(4, 'Upload/Akhiyaan Gulaab (From Teri Baaton Mein Aisa Uljha Jiya).mp3', 'Images/Akhiyaan-Gulaab-From-Teri-Baaton-Mein-Aisa-Uljha-Jiya.jpeg', 'Mitraz', 'Teri Baaton Mein Aisa Uljha Jiya (2024)', 'Hindi'),
(5, 'Upload/Amber Se Toda (From RRR).mp3', 'Images/AMBAR_SE_TODA_Song__RRR_2022.jpeg', 'M.M Keervani ,Raag Patel', 'RRR (2022)', 'Hindi'),
(6, 'Upload/Angaaron (From Pushpa 2 The Rule).mp3', 'Images/Angaaron__Song_Pushpa_2_The_Rule.jpeg', 'D.S.P , Shreya Ghoshal', 'Pushpa 2 : The Rule (2024)', 'Hindi'),
(7, 'Upload/Abrar’s Entry Jamal Kudu (From ANIMAL).mp3', 'Images/Abrar-s-Entry-Jamal-Kudu-From-ANIMAL.jpeg', 'Harshawardhan R', 'Animal (2023)', 'Hindi'),
(8, 'Upload/Animals - Martin Garrix.m4a', 'Images/Animals_Martin_Garrix.jpg', 'Martin Garrix', 'MNM Party', 'English'),
(9, 'Upload/Apna Bana Le (From  Bhediya).m4a', 'Images/Apna Bana Le (From  Bhediya ) - Arijit Singh.png', 'Sachin Jigar , Arijit Singh, Amitabh B', 'Bhediya (2023)', 'Hindi'),
(10, 'Upload/Arabic Kuthu(From Beast).mp3', 'Images/Arabic_Kuthu_-_Halamithi_Habibo__From__Beast.png', 'Anirudh ,Jonita G', 'Beast (2022)', 'Hindi'),
(11, 'Upload/Bade Miyan Chote Miyan - Title Track  (From  BMCM 2024).mp3', 'Images/Bade-Miyan-Chote-Miyan-Hindi-2024.jpeg', 'Anirudh , Irshad K, Vishal M', 'Bade Miyan Chote Miyan (2024)', 'Hindi'),
(12, 'Upload/Badri Ki Dulhania Title Track (From Badrinath Ki Dulhania).mp3', 'Images/Badrinath_Ki_Dulhania_Title_Track.jpeg', 'Neha Kakkar, Monali T, Ikka S, Dev Negi , Rajnigandha S', 'Badrinath Ki Dulhania (2017)', 'Hindi'),
(13, 'Upload/Beast Mode (From  Beast).m4a', 'Images/Beast-Mode-From-Beast.jpeg', 'Anirudh ', 'Beast (2022)', 'Hindi'),
(14, 'Upload/Bloody Sweet (From Leo).m4a', 'Images/Bloody_Sweet_From_Leo.png', 'Anirudh ,Siddharth B', 'Leo (2023)', 'English'),
(15, 'Upload/Burjkhalifa (From Laxmii).mp3', 'Images/BurjKhalifa-2021.jpeg', 'Madhubanti B, DJ K, Nikhita G, Shashi S', 'Laxmii (2020)', 'Hindi'),
(16, 'Upload/Chalti Hai Kya 9 Se 12 (From Judwaa 2).mp3', 'Images/Judwaa 2.jpg', 'Meet Bros, Dev N, Neha K', 'Judwaa 2 (2017)', 'Hindi'),
(17, 'Upload/Cham Cham (From BAAGHI).mp3', 'Images/Baaghi-Hindi-2016.jpeg', 'Meet Bros , Monali Thakur ', 'Baaghi (2016)', 'Hindi'),
(18, 'Upload/Chandigarh Mein (From Good Newwz).mp3', 'Images/Good-Newwz-Hindi-2019.jpg', 'Badshah, Lisa M, Harrdy S , Asees K', 'Good Newwz (2019)', 'Hindi'),
(19, 'Upload/Character Dheela 2.0 (From Shehzada).mp3', 'Images/Character_Dheela_2_0__From__Shehzada_.jpeg', 'Neeraj S, Style B', 'Shehzada (2023)', 'Hindi'),
(20, 'Upload/Chashni (From Bharat).mp3', 'Images/Bharat-Hindi-2019.jpeg', 'Vishal Shekhar, Abhijeet S', 'Bharat (2019)', 'Hindi'),
(21, 'Upload/Chaleya (From Jawan).mp3', 'Images/Chaleya-From-Jawan-Hindi-2023.jpeg', 'Anirudh , Shilpa Rao ,Arijit Singh', 'Jawan (2023)', 'Hindi'),
(22, 'Upload/Cradles (SubUrban).mp3', 'Images/Suburban_Cradles.jpeg', 'SubUrban', 'Cradles', 'English'),
(23, 'Upload/Deva Deva (From  Brahmastra Part 1).m4a', 'Images/Deva Deva (From  Brahmastra ) - Pritam.png', 'Pritam , Arijit Singh ', 'Brahmastra Part -1 : Shiva (2022)', 'Hindi'),
(24, 'Upload/Dheere Dheere Se Meri Zindagi.mp3', 'Images/Dheere-Dheere-Hindi-2015.jpeg', 'Yo Yo Honey Singh', 'T-Series ', 'Hindi'),
(25, 'Upload/Dil Jhoom (From Gadar 2).mp3', 'Images/Dil-Jhoom-Vishal-Mishra-From-Gadar-2-Hindi-2023.jpeg', 'Mithoon , Arijit S, Sayeed Q , Vishal M', 'Gadar 2 (2023)', 'Hindi'),
(26, 'Upload/Dilbar (From Satyamev Jayte).mp3', 'Images/Dilbar_From_Satyamev_Jayte.jpg', 'Neha Kakkar ', 'Satyamev_Jayte 2020 ', 'Hindi'),
(27, 'Upload/Dhinka Chika (From Ready).mp3', 'Images/Dhinka Chika (From Ready).jpg', ' Amrita Kak, Mika Singh', 'Ready (2011)', 'Hindi'),
(28, 'Upload/Dosti (From RRR).mp3', 'Images/Dosti_Song__RRR_2022.jpg', 'M.M.Keervani , Amit Trivedi', 'RRR (2022)', 'Hindi'),
(29, 'Upload/Dhoom Again (From Dhoom).mp3', 'Images/Dhoom Again (From Dhoom 2).jpg', ' Dominique Cerejo, Vishal Dadlani', 'Dhoom 2 (2006)', 'Hindi'),
(30, 'Upload/Eyy Bidda Ye Mera Adda (From  Pushpa The Rise).m4a', 'Images/Pushpa - The Rise (2021).jpg', 'D.S.P , Nakash Aziz', 'Pushpa - The Rise (2021)', 'Hindi'),
(31, 'Upload/Galat Baat Hai (From  Main Tera Hero).mp3', 'Images/Main-Tera-Hero-2014.jpg', ' Javed Ali, Neeti Mohan, Wajid Ali', 'Main Tera Hero (2014)', 'Hindi'),
(32, 'Upload/Gali Gali (From KGF Chapter-1).mp3', 'Images/Gali-Gali-From-Kgf-Chapter-1--Hindi-2018.jpg', ' Tanishk Bagchi, Neha Kakkar', 'K.G.F Chapter 1', 'Hindi'),
(33, 'Upload/Get Low - DJ Snake.mp3', 'Images/Get Low.png', 'DJ Snake , Dillon Francis', 'Money Sucks , Friends Rule (2014)', 'English'),
(34, 'Upload/Girl I Need You(From BAAGHI).mp3', 'Images/Baaghi-Hindi-2016.jpeg', 'Arijit Singh , Meet Bros, Roach Killa , Khushboo Grewal', 'Baaghi (2016)', 'Hindi'),
(35, 'Upload/Galti Se Mistake (From Jagga Jasoos).mp3', 'Images/Galti Se Mistake (From Jagga Jasoos).jpeg', ' Arijit Singh, Amit Mishra', ' Jagga Jasoos (2017)', 'Hindi'),
(36, 'Upload/Garmi (From Street Dancer 3D).mp3', 'Images/Garmi-From-Street-Dancer-3D--Hindi-2020.jpeg', 'Sachin Jigar , Badshah , Neha Kakkar , Remo Desouza', 'Steet Dancer 3D (2020)', 'Hindi'),
(37, 'Upload/Halaji Tara Hath Vakhanu - Aditya Gadhvi.mp3', 'Images/Halaji tara Haath Vakhanu - Aditya Gadhvi.jpg', ' Aditya Gadhvi, Jigardan Gadhavi, Abhita P, Pamela J', 'Ramzat 2 - Non Stop Trantaali Garba', 'Gujrati'),
(38, 'Upload/Har Har Mahadev (From OMG 2).mp3', 'Images/Har-Har-Mahadev-From-OMG-2-Hindi-2023.jpg', 'Vikram Montrose, Shekhar Astitwa', 'OMG 2 (2023)', 'Hindi'),
(39, 'Upload/Har Har Shambhu Shiv Mahadeva.mp3', 'Images/Har-Har-Shambhu.jpeg', ' Jeetu Sharma ,  Abhilipsa Panda', ' Har Har Shambhu Shiv Mahadeva (2022)', 'Hindi'),
(40, 'Upload/Hawayein (From Jab Harry Met Sejal).mp3', 'Images/Hawayein-From-Jab-Harry-Met-Sejal--Hindi-2017.jpeg', 'Pritam , Arijit Singh', 'Jab Harry Met Sejal (2017)', 'Hindi'),
(41, 'Upload/Heeriye -Arijit Singh.mp3', 'Images/Heeriye (feat Arijit Singh , Jasleen Royal).jpg', 'Jasleen Royal , Arijit Singh', ' Heeriye (2023)', 'Hindi'),
(42, 'Upload/Hookah Bar (From Khiladi 786).mp3', 'Images/Khiladi-786-Hindi-2012.jpeg', 'Vinit Singh, Aaman Trikha, Himesh Reshamiya', 'Khiladi 786 (2012)', 'Hindi'),
(43, 'Upload/Hua Hain Aaj Pehli Baar (From SANAM RE).mp3', 'Images/Hua Hain Aaj Pehli Baar (From Sanam Re).jpg', ' Armaan Malik  ,Amaal Mallik, Palak M, Manoj y', ' Sanam Re (2015)', 'Hindi'),
(44, 'Upload/Hukum (From Rajini - The Jailer).m4a', 'Images/Hukum (From Jailer) 2023.png', ' Anirudh , Dinker K, Bhaskarabhatla R.K', 'Jailer (2023)', 'Hindi'),
(45, 'Upload/Hum Aaye Hain(From Ganapath).mp3', 'Images/Hum-Aaye-Hain-From-Ganapath-Hindi-2023.jpeg', 'WhiteNoise Studios, Siddharth B, Prakriti K', 'Ganapath (2023)', 'Hindi'),
(46, 'Upload/Bhool Bhulaiyaa 3 Title Track (From Bhool Bhulaiyaa 3).mp3', 'Images/Bhool-Bhulaiyaa-3-Title-Track-Hindi-2024.jpg', 'Neeraj S, Dhrruv Y, Diljit D, Pitbull, Tanishk Bagchi, Pritam , Sameer Anjaan', ' Bhool Bhulaiyaa 3 (2024)', 'Hindi'),
(47, 'Upload/Hunter Vantaar (From  Vettaiyan).mp3', 'Images/Hunter-Vantaar_From(Vettaiyan).jpeg', ' Anirudh ,Arivu , Siddharth B ', 'Vettaiyan (2024)', 'Tamil'),
(48, 'Upload/HANUMAN CHALISA (From HanuMan).mp3', 'Images/Hanuman-Chalisa-From-HanuMan-Hindi-Hindi-2023.jpg', 'GowraHari, Sai Charan', 'HanuMan (2023)', 'Hindi'),
(49, 'Upload/Har Ghoont Mein Swag.mp3', 'Images/Har-Ghoont-Mein-Swag-Hindi-2019.jpeg', 'Badshah', 'Her Ghoont Mein Swag (2019)', 'Hindi'),
(50, 'Upload/Haan Main Galat (From Love Aaj Kal 2020).mp3', 'Images/Haan-Main-Galat-From-Love-Aaj-Kal--Hindi-2020.jpg', ' Shashwat Singh, Arijit Singh, Pritam', 'Love Aaj Kal (2019)', 'Hindi'),
(51, 'Upload/High Rated Gabru (From Nawabzaade).mp3', 'Images/High_Rated_Gabru (From Nawabzaade).jpeg', 'Guru Randhawa', 'Nawabzaade (2017)', 'Hindi'),
(52, 'Upload/Humsafar (From Badrinath Ki Dulhania.mp3', 'Images/Humsafar_Badrinath-Ki-Dulhania-Full-Hindi-2017.jpeg', ' Akhil Sachdeva, Mansheel Gujral', 'Badrinath Ki Dulhania (2017)', 'Hindi'),
(53, 'Upload/Ik Vaari Aa (From Raabta).mp3', 'Images/Ik_Vaari_AA__From_Raabta.jpeg', 'Arijit Singh', 'Raabta (2017)', 'Hindi'),
(54, 'Upload/Island - Ikson.mp3', 'Images/Ikson_island.jpg', 'Ikson', 'Island (2018)', 'English'),
(55, 'Upload/Island Jaricho.mp3', 'Images/Island -Jarico.jpg', 'Jarico', 'Island (2022)', 'English'),
(56, 'Upload/Ishq Jaisa Kuch (From Fighter).mp3', 'Images/Ishq Jaisa Kuch From Fighter).jpeg', 'MellowD, Vishal–Shekhar, Shilpa Rao', 'Fighter (2024)', 'Hindi'),
(57, 'Upload/Illegal Weapon 2.0 (From Street Dancer 3D).mp3', 'Images/Illegal-Weapon-2-0-From-Street-Dancer-3D--Hindi-2020.jpeg', ' Jasmine Sandlas, Garry Sandhu', 'Street Dancer 3D (2020)', 'Hindi'),
(58, 'Upload/Illuminati (From Aavesham).mp3', 'Images/Illuminati (From Aavesham).jpg', 'Sushin Shyam, Dabzee, Vinayak Sasikumar', 'Aavesham (From 2024)', 'Tamil'),
(59, 'Upload/Daru Badnaam - Param Singh.mp3', 'Images/Daru Badnaam.jpg', ' Kamal Kahlon , Param Singh ', 'Daru Badnaam (2016)', 'Hindi'),
(60, 'Upload/Jadoo Jadoo (From Koi Mil Gaya).mp3', 'Images/Koi Mil Gaya.jpg', 'Alka Yagnik, Adnan Sami', 'Koi Mil Gaya (2003)', 'Hindi'),
(61, 'Upload/Jag Ghoomeya (From SULTAN).mp3', 'Images/Sultan.jpg', ' Rahat Fateh Ali Khan', 'Sultan (2016)', 'Hindi'),
(62, 'Upload/Jai Jai Shivshankar (From WAR).mp3', 'Images/War.jpg', ' Benny Dayal, Vishal Dadlani', 'War (2019)', 'Hindi'),
(63, 'Upload/Jhoome Jo Pathaan (From Pathaan).mp3', 'Images/Jhoome Jo Pathaan (From Pathaan).jpg', ' Sukriti Kakar, Arijit Singh, Vishal Dadlani, Shekhar Ravjiani', ' Pathaan (2022)', 'Hindi'),
(64, 'Upload/Jawan Prevue Theme (From Jawan).m4a', 'Images/Jawan Prevue Theme (From Jawan).jpeg', 'Anirudh , Raja Kumari', 'Jawan (2023)', 'Hindi'),
(65, 'Upload/Jawan Title Track - Sped Up SV Rendition.mp3', 'Images/Jawan Title Track - Suraj Verma.jpg', 'Suraj Verma', ' Jawan Title Track -SV Rendition (2022)', 'Hindi'),
(66, 'Upload/Jay-Jaykara (From Baahubali 2 - The Conclusion).mp3', 'Images/Bahubali-The-Conclusion-Hindi-2017.jpg', 'Kailash Kher', 'Baahubali 2: The Conclusion (2017)', 'Hindi'),
(67, 'Upload/Jimikki Aate Jaate (From Varisu).mp3', 'Images/Jimikki-Song-From-Varisu-2022.jpg', 'Anirudh , Jonita Gandhi', 'Varisu (2022)', 'Hindi'),
(68, 'Upload/Jiyo Re Baahubali (From Baahubali 2 - The Conclusion).mp3', 'Images/Bahubali-The-Conclusion-Hindi-2017.jpg', 'Sanjeev C, Daler M, Ramya B', 'Baahubali 2: The Conclusion (2017)', 'Hindi'),
(69, 'Upload/Jugnu - Badshah.mp3', 'Images/Jugnu-Badshah-Hindi-2021.jpeg', ' Nikhita Gandhi, Badshah', 'Badshah - HitList', 'Hindi'),
(70, 'Upload/Jaana Samjho Na (From Bhool Bhulaiyaa 3).mp3', 'Images/Jaana-Samjho-Na-From-Bhool-Bhulaiyaa-3.jpg', ' Aditya Rikhari, Tulsi Kumar', ' Bhool Bhulaiyaa 3 (2024)', 'Hindi'),
(71, 'Upload/Kala Chashma (From Baar Baar Dekho).mp3', 'Images/Baar Baar Dekho.jpg', ' Amar Arshi', 'Baar Baar Dekho (2018)', 'Hindi'),
(72, 'Upload/Raanjhan (From Do Patti).mp3', 'Images/Raanjhan (From Do Patti).jpg', 'Sachet ,Parampara', 'Do Patti (2024)', 'Hindi'),
(73, 'Upload/Kasturi Ek Jaisa Haal - Arijit Singh.mp3', 'Images/Kasturi-From-Amar-Prem-Ki-Prem-Kahani.jpg', ' Prasad S, Arijit Singh, Kunaal Vermaa', 'Amar Prem Ki Prem Kahani (2024)', 'Hindi'),
(74, 'Upload/Kaun Hain Voh (From Baahubali -The Beginning).mp3', 'Images/Baahubali-The-Beginning-Hindi-2018.jpg', ' Kailash Kher, Rajakumari', 'Baahubali: The Beginning (2015)', 'Hindi'),
(75, 'Upload/Kesariya (From  Brahmastra Part 1).m4a', 'Images/Kesariya (From  Brahmastra ) - Pritam.png', ' Arijit Singh', ' Brahmāstra: Part 1  – Shiva (2022)', 'Hindi'),
(76, 'Upload/Khairiyat (From Chhichhore).mp3', 'Images/Chhichhore.jpeg', 'Arijit Singh', 'Chhichhore (2019)', 'Hindi'),
(77, 'Upload/Khalasi (From Coke Studio Feat Aditya_Gadhvi_x_Achint).mp3', 'Images/Khalasi-Coke-Studio-Bharat-Gujarati-2024.jpeg', 'Aditya Gadhvi , Achint  ,Kedrock , Sd Style', 'Khalasi (2024)', 'Gujrati'),
(78, 'Upload/Khoobsurat (From Stree 2).mp3', 'Images/Khoobsurat (From Stree 2).jpeg', 'Sachin Jigar, Vishal Mishra, Amitabh B', 'Stree 2 (2024)', 'Hindi'),
(79, 'Upload/Khoya Hain (From Baahubali - The Beginning).mp3', 'Images/Baahubali-The-Beginning-Hindi-2018.jpg', ' Neeti Mohan, Kaala Bhairava', 'Baahubali - The Beginning (2015)', 'Hindi'),
(80, 'Upload/Sooraj Dooba Hain (From Roy).mp3', 'Images/Roy.jpg', 'Arijit Singh', 'Roy (2015)', 'Hindi'),
(81, 'Upload/KISSIK (From Pushpa 2 - The Rule).mp3', 'Images/Kissik (From Pushpa 2 The Rule).jpg', ' Sublahshini, Lothika', 'Pushpa 2 : The Rule (2024)', 'Hindi'),
(82, 'Upload/Koi Mil Gaya (From Kuch Kuch Hota Hai).mp3', 'Images/Koi Mil Gaya (From Kuch Kuch Hota Hai).jpg', ' Jatin , Lalit', 'Kuch Kuch Hota Hai (1998)', 'Hindi'),
(83, 'Upload/KGF Chapter 2 Title Track - Sped Up SV Rendition.mp3', 'Images/K.G.F Chapter-2 Theme (SV Rendition).jpg', 'Suraj Verma', 'K.G.F Title Track -SV Rendition (2022)', 'Hindi'),
(84, 'Upload/Komuram Bheemudo (From RRR).mp3', 'Images/Komuram Bheemudo (From RRR).jpg', 'Kaala Bhairava', 'RRR (2022)', 'Hindi'),
(85, 'Upload/Krishna Theme Flute (From OMG).mp3', 'Images/O.M.G - Oh My God.jpg', 'Paras Nath', ' OMG – Oh My God! (2012)', 'Hindi'),
(86, 'Upload/Dil Na Diya (From Krrish).mp3', 'Images/Krrish.jpg', 'Rajesh Roshan,Kunal Ganjawala, Vijay Akela', 'Krrish (2006)', 'Hindi'),
(87, 'Upload/Kusu Kusu (From Satyameva Jayate 2).mp3', 'Images/Kusu Kusu (From Satyamev Jayate 2).jpg', ' Zara Khan, Dev Negi', ' Satyameva Jayate 2 (2021)', 'Hindi'),
(88, 'Upload/440 Volt (From Sultan).mp3', 'Images/Sultan.jpg', 'Mika Singh', 'Sultan (2019)', 'Hindi'),
(89, 'Upload/Kashmir Main Tu Kanyakumari (From Chennai Express).mp3', 'Images/Chennai Express.jpg', 'Vishal-Shekhar, Arijit Singh, Neeti Mohan, Sunidhi Chauhan', ' Chennai Express (2013)', 'Hindi'),
(90, 'Upload/Aa Toh Sahi (From Judwaa 2).mp3', 'Images/Judwaa 2.jpg', ' Roach Killa, Neha Kakkar, Meet Bros', 'Judwaa 2 (2018)', 'Hindi'),
(91, 'Upload/Aaj Ki Party (From Bajrangi Bhaijan).mp3', 'Images/Bajrangi Bhaijaan.jpg', ' Mika Singh, Shabbir Ahmed, Shankar–Ehsaan–Loy', ' Bajrangi Bhaijaan (2015)', 'Hindi'),
(92, 'Upload/Aaj Se Teri (From Padman).mp3', 'Images/Padman.jpg', ' Arijit Singh, Amit Trivedi', 'Padman (2018)', 'Hindi'),
(93, 'Upload/Aal Izz Well (From 3 Idiots).mp3', 'Images/All Izz Well (From 3 Idiots).jpg', 'Sonu Nigam, Swanand Kirkire, Shaan', '3 Idiots', 'Hindi'),
(94, 'Upload/Aankh Marey (From SIMMBA).mp3', 'Images/Simmba.jpg', 'Kumar Sanu, Neha Kakkar, Mika Singh, Tanishk Bagchi', 'Simmba (2018)', 'Hindi'),
(95, 'Upload/Abhi Toh Party Shuru Hui Hai  (From Khoobsurat).mp3', 'Images/Khoobsurat.jpg', ' Aastha Gill, Badshah', ' Khoobsurat (2014)', 'Hindi'),
(96, 'Upload/Agar Tum Saath Ho (From Tamasha).mp3', 'Images/Tamasha.jpg', ' Arijit Singh, Alka Yagnik', ' Tamasha (2015)', 'Hindi'),
(97, 'Upload/Akh Lad Jaave (From Loveyatri).mp3', 'Images/Loveyatri-A-Journey-Of-Love-Hindi-2018.jpeg', 'Badshah, Jubin Nautiyal, Asees Kaur, Tanishk Bagchi', 'Loveyatri (2018)', 'Hindi'),
(98, 'Upload/Alcoholia (From Vikram Vedha).mp3', 'Images/Alcoholia (From Vikram Vedha).jpg', 'Vishal Shekhar,  Snigdhajit B, Ananya C', 'Vikram Vedha (2022)', 'Hindi'),
(99, 'Upload/Ale (From Golmaal 3).mp3', 'Images/Golmaal 3.jpg', ' Kumaar, Antara Mitra, Neeraj Shridhar', 'Golmaal 3 (2010)', 'Hindi'),
(100, 'Upload/Alone - Marshmello.mp3', 'Images/Alone - Marshmello.jpg', ' Marshmello', 'Alone (2016)', 'Hindi'),
(101, 'Upload/Apna Har Din (From Golmaal 3).mp3', 'Images/Golmaal 3.jpg', 'Kumaar, Dj Amyth, Neeraj Shridhar , Shaan, Anushka M', 'Golmaal 3 (2010)', 'Hindi'),
(102, 'Upload/Arjan Vailly (From ANIMAL).mp3', 'Images/Arjan Vailly (From ANIMAL).jpg', ' Bhupinder Babbal', 'ANIMAL (2023)', 'Punjabi'),
(103, 'Upload/Astronaut In The Ocean - Masked Wolf.mp3', 'Images/Astronaut of Ocean  - Masked Wolf.jpg', ' Masked Wolf', ' Astronomical (2021)', 'English'),
(104, 'Upload/Azeem-O-Shaan Shahenshah (From Jodha Akbar).mp3', 'Images/Azeem-O-Shaan Shahenshah (From Jodha Akbar).jpg', ' A.R Rahman, Mohammed A, Bonnie C', 'Jodhaa Akbar (2007)', 'Hindi'),
(105, 'Upload/Beast Mode (From  Baby John).mp3', 'Images/Beast-Mode-From-Beast.jpg', 'Thaman S, Raja Kumari , Adviteeya Vojjala , Ritesh G Rao', 'Baby John (2024)', 'Hindi'),
(106, 'Upload/Baby Ko Bass Pasand Hai (From Sultan).mp3', 'Images/Sultan.jpg', ' Badshah, Shalmali Kholgade, Vishal Dadlani, Ishita', 'Sultan (2019)', 'Hindi'),
(107, 'Upload/Badtameez Dil  (From Yeh Jawani Hai Diwani).mp3', 'Images/Yeh Jawani Hai Diwani.jpg', ' Benny Dayal, Shefali Alvares', ' Yeh Jawaani Hai Deewani (2013)', 'Hindi'),
(108, 'Upload/Balma (From Khiladi 786).mp3', 'Images/Khiladi-786-Hindi-2012.jpg', ' Sreerama Chandra, Himesh Reshamiya ,Shreya Ghoshal, Shriram Iyer', 'Khiladi 786 (2012)', 'Hindi'),
(109, 'Upload/Barso Re (From Guru).mp3', 'Images/Barso Re (From Guru).jpg', 'A.R Rahman, Uday Mazumdar, Shreya Ghoshal', 'Guru (2007', 'Hindi'),
(110, 'Upload/Behti Hawa Sa Tha Woh (From 3 Idiots).mp3', 'Images/3 Idiots.jpg', ' Shantanu Moitra, Shaan', '3 Idiots (2009)', 'Hindi'),
(111, 'Upload/Balam Pichkari (From Yeh Jawani Hai Diwani).mp3', 'Images/Yeh Jawani Hai Diwani.jpg', ' Pritam , Vishal Dadlani, Shalmali K, Amitabh B', ' Yeh Jawaani Hai Deewani (2013)', 'Hindi'),
(112, 'Upload/Besabriyaan (From M.S DHoni).mp3', 'Images/M.S Dhoni.jpg', ' Armaan Malik, Amaal Mallik', ' M.S. Dhoni: The Untold Story (2016)', 'Hindi'),
(113, 'Upload/Bhool Bhulaiyaa 2 Title Track (From Bhool Bhulaiyaa 2).mp3', 'Images/Bhool-Bhulaiyaa-2-Title-Track-Hindi-2022.jpg', 'Pritam, Neeraj Shridhar, MellowD, Bob, Tanishk Bagchi, Sameer Anjaan', ' Bhool Bhulaiyaa 2 (2022)', 'Hindi'),
(114, 'Upload/Big Dawgs - Hanumankind.mp3', 'Images/Big Dawgs - Hanumankind.jpg', ' Hanumankind, Kalmi', ' Big Dawgs (2024)', 'English'),
(115, 'Upload/Bones - Imagine Dragons.mp3', 'Images/Bones - Imagine Dragons.jpg', ' Imagine Dragons', 'Mercury – Acts 1 & 2 (2022)', 'English'),
(116, 'Upload/Chittiyaan Kalaiyaan (From Roy).mp3', 'Images/Roy.jpg', 'Kanika Kapoor, Meet Bros, Kumaar', 'ROY (2015)', 'Hindi'),
(117, 'Upload/Dum Masala (From Guntur Kaaram).mp3', 'Images/Guntur Kaaram.jpg', 'Thaman S, Sanjith Hegde', 'Guntur Kaaram (2024)', 'Telugu'),
(118, 'Upload/COCA COLA (From Luka Chuppi).mp3', 'Images/Luka Chuppi.jpg', 'Neha Kakkar, Tony Kakkar', 'Luka Chuppi (2019)', 'Hindi'),
(119, 'Upload/Dil Diyan Gallan  (From Tiger Zinda hain).mp3', 'Images/Tiger Zinda hain.jpg', 'Atif Aslam', 'Tiger Zinda Hain (2017)', 'Hindi'),
(120, 'Upload/Chale Chalo (From Lagaan).mp3', 'Images/Lagaan.jpg', ' A.R Rahman', 'Lagaan (2012)', 'Hindi'),
(121, 'Upload/Deewangi Deewangi (From Om Shanti Om).mp3', 'Images/Om Shanti Om.jpg', ' Rahul Saxena, Shaan, Sunidhi Chauhan, Shreya Ghoshal, Udit Narayan', ' Om Shanti Om (2007)', 'Hindi'),
(122, 'Upload/Rang (From Sky Force).mp3', 'Images/Rang (From Sky Force).jpg', ' Shloke Lal, Tanishk Bagchi, Satinder Sartaaj, Zahrah S Khan', 'Sky Force (2025)', 'Hindi'),
(123, 'Upload/Deva Shree Ganesha (From Agneepath).mp3', 'Images/AganiPath.jpg', ' Ajay-Atul, Ajay Gogavale', ' Agneepath (2012)', 'Hindi'),
(124, 'Upload/Golmaal Title Track (From Golmaal Again).mp3', 'Images/Golmaal Again.jpg', '  Aditi Singh Sharma, Brijesh Shandilya', 'Golmaal Again (2017)', 'Hindi'),
(125, 'Upload/Manma Emotion Jaage (From Dilwale).mp3', 'Images/Dilwale (2015).jpg', 'Pritam, Anushka Manchanda, Antara Mitra, Amit Mishra', 'Dilwale (2015)', 'Hindi'),
(126, 'Upload/Lagdi Lahore Di (From Street Dancer 3D).mp3', 'Images/Lagdi_Lahore_di (From Street_Dancer_3D).jpg', ' Guru Randhawa, Tulsi Kumar', ' Street Dancer 3D (2020)', 'Hindi'),
(127, 'Upload/Tera Hone Laga Hoon (From  Ajab Prem Ki Ghazab Kahani).mp3', 'Images/Ajab Prem Ki Ghazab Kahani.jpg', 'Pritam, Atif Aslam, Joi Barua, Alisha Chinai', ' Ajab Prem Ki Ghazab Kahani (2009)', 'Hindi'),
(128, 'Upload/Beech Beech Mein (From Jab Harry Met Sejal).mp3', 'Images/Beech Beech Mein (From Jab Harry Met Sejal).jpg', 'Pritam, Arijit Singh, Shalmali Kholgade, Lady Bee', ' Jab Harry Met Sejal (2017)', 'Hindi'),
(129, 'Upload/Bijlee Bijlee - Harrdy Sandhu.mp3', 'Images/Bijlee Bijlee - Harrdy Sandhu.jpg', 'Harrdy Sandhu', 'Bijlee Bijlee (2021)', 'Hindi,Punjabi'),
(130, 'Upload/Buddhu Sa Mann (From Kapoor & Sons).mp3', 'Images/Kapoor & Sons (Since 1921).jpg', ' Abhiruchi Chand, Armaan Malik, Amaal Mallik', ' Kapoor & Sons (2016)', 'Hindi'),
(131, 'Upload/Chogada (From  Loveyatri).m4a', 'Images/Chogada (From Loveyatri).jpg', ' Darshan Raval, Asees Kaur', ' Loveyatri (2018)', 'Hindi,Gujarati'),
(132, 'Upload/Ding Dang (From Munna Michel).mp3', 'Images/Munna Michel.jpg', ' Amit Mishra, Antara Mitra', 'Munna Michel (2017)', 'Hindi'),
(133, 'Upload/DJ Waley Babu - Badshah.mp3', 'Images/DJ Waley Babu - Badshah.jpg', ' Aastha Gill, Badshah, Nilesh P', 'ONE (2018)', 'Hindi'),
(134, 'Upload/Empathy - Crystal Castles.mp3', 'Images/Empathy - Crystal Castles.jpg', ' Crystal Castles', ' Crystal Castles - III (2010)', 'English'),
(135, 'Upload/ENOUGH! - Eternxlkz.mp3', 'Images/ENOUGH! - Eternxlkz.jpg', ' Eternxlkz', ' ENOUGH! (2023)', 'Portuguese'),
(136, 'Upload/Eu Sento Gabu - PXLWYSE.mp3', 'Images/Eu Sento Gabu! - PXLWYSE.jpg', ' PXLWYSE', ' EU SENTO GABU GABU (2024)', 'Portuguese'),
(137, 'Upload/Fear Song (From Devara Part -1).mp3', 'Images/Fear Song (From Devara Part 1).jpg', 'Anirudh Ravichander', ' Devara Part - 1 (2024)', 'Hindi'),
(138, 'Upload/First Class (From Kalank).mp3', 'Images/Kalank.jpg', 'Pritam, Arijit Singh, Neeti Mohan', ' Kalank (2019)', 'Hindi'),
(139, 'Upload/Gerua (From Dilwale).mp3', 'Images/Dilwale (2015).jpg', 'Pritam , Arijit Singh , Antara Mitra', 'Dilwale (2015)', 'Hindi'),
(140, 'Upload/Get Ready To Fight Reloaded (From Baaghi 3).mp3', 'Images/Baaghi 3.jpg', 'Pranaay', 'Baaghi 3 (2020)', 'Hindi'),
(141, 'Upload/Ghungroo (From  War).mp3', 'Images/War.jpg', 'Vishal-Shekhar, Arijit Singh, Shilpa Rao, Kumaar', 'War (2019)', 'Hindi'),
(142, 'Upload/GigaChad Theme -  g3ox_em.mp3', 'Images/GigaChad Theme -  g3ox_em.jpg', 'g3ox_em', ' GigaChad Theme (Phonk House Version) (2022)', 'English'),
(143, 'Upload/Gimme Gimme  (A man after midnight) - Syzz.mp3', 'Images/Gimme Gimme (A Man aafter Midnight).jpg', 'Syzz', 'Gimme Gimme Gimme (a man after midnight) (2020)', 'English'),
(144, 'Upload/Give Me Some Sunshine (From 3 Idiots).mp3', 'Images/3 Idiots.jpg', ' Suraj Jagan, Sharman Joshi', ' 3 Idiots (2009)', 'Hindi'),
(145, 'Upload/Go Go Govinda (From Omg).mp3', 'Images/O.M.G - Oh My God.jpg', ' Shreya Ghoshal, Mika Singh', 'OMG – Oh My God! (2012)', 'Hindi'),
(146, 'Upload/Gori Tame Manda Lidha Mohi Raj (From Saiyar Mori Re).mp3', 'Images/Gori Tame Manda Lidha Mohi Raj (From Saiyar Mori Re).jpeg', ' Umesh Barot', 'Saiyar Mori Re (2022)', 'Gujarati'),
(147, 'Upload/GulabiSadi.mp3', 'Images/GulabiSadi.jpg', 'Sanju Rathod, G - SPXRK', 'Gulabi Sadi', 'Marathi'),
(148, 'Upload/Haanikaarak Bapu (From DANGAL).mp3', 'Images/Dangal.jpg', 'Pritam , Sartaz Khan Barna, Sarwar Khan ', 'DANGAL (2016) ', 'Hindi'),
(149, 'Upload/High - JPB.mp3', 'Images/High - JPB.jpg', ' JPB', 'HIgh (2015)', 'English'),
(150, 'Upload/Hornn Blow - Harrdy Sandhu.mp3', 'Images/Horn Blow - Harrdy Sandhu.jpg', ' Harrdy Sandhu, B Praak, Jaani', ' HORNN BLOW (2016)', 'Punjabi'),
(151, 'Upload/Hua Main (From ANIMAL).mp3', 'Images/Hua main (From ANIMAL).jpg', ' Raghav Chaitanya, Pritam', 'ANIMAL (2023)', 'Hindi'),
(152, 'Upload/Hum Nahi Sudhrenge (From Golmaal Again).mp3', 'Images/Golmaal Again.jpg', ' Armaan Malik', 'Golmaal Again! (2017)', 'Hindi'),
(153, 'Upload/Ilahi (From Yeh Jawaani Hai Deewani).mp3', 'Images/Yeh Jawani Hai Diwani.jpeg', 'Arijit Singh', 'Yeh Jawaani Hai Deewani (2013)', 'Hindi'),
(154, 'Upload/Ishq Hai (From Mismatched S3).mp3', 'Images/Ishq hai (From Mismatched S3).jpg', ' Anurag Saikia, Varun Jain, Amarabha Banerjee, Raj Shekhar, Madhubanti Bagchi', 'Mismatched: Season 3 (2024)', 'Hindi'),
(155, 'Upload/Laal Peeli Akhiyaan (From Teri Baaton Mein Aisa Uljha Jiya).mp3', 'Images/Laal Peeli Akhiyaan (From Teri Baaton Mein Aisa Uljha Jiya).jpg', ' Tanishk Bagchi, Romy', 'Teri Baaton Mein Aisa Uljha Jiya (2024)', 'Hindi'),
(156, 'Upload/Laila Main Laila (From Raees).mp3', 'Images/Raees.jpg', ' Pawni A Pandey', 'Raees (2017)', 'Hindi'),
(157, 'Upload/Landscape - Jarico.mp3', 'Images/Landscape - Jaricho.jpg', ' Jarico, Slap Mage', 'Landscape (2021)', 'English'),
(158, 'Upload/Last Summer - Ikson.mp3', 'Images/Last Summer - Ikson.jpg', ' Ikson', 'Last Summer (2018)', 'English'),
(159, 'Upload/Lehra Do (From  EightyThree).mp3', 'Images/Lehra Do (From EightyThree).jpg', ' Arijit Singh, Pritam Chakraborty', 'EightyThree (2021)', 'Hindi'),
(160, 'Upload/Leke Prabhu Ka Naam (From Tiger 3).mp3', 'Images/Leke Prabhu Ka Naam (From Tiger 3).jpg', ' Arijit Singh, Nikhita Gandhi', 'Tiger 3 (2023)', 'Hindi'),
(161, 'Upload/Lets Talk About Love (From Baaghi).mp3', 'Images/Baaghi-Hindi-2016.jpg', ' Manj Musik, Neha Kakkar, Raftaar', 'Baaghi (2016)', 'Hindi'),
(162, 'Upload/Link - Jim Yosef.mp3', 'Images/Link - Jim Yosef.jpg', ' Anna Yvette, Jim Yosef', 'Linked (2017)', 'Swedish'),
(163, 'Upload/Long Drive (From Khiladi 786).mp3', 'Images/Khiladi-786-Hindi-2012.jpg', 'Mika Singh', 'Khiladi 786 (2012)', 'Hindi'),
(164, 'Upload/Love You Zindagi (From Dear Zindagi).mp3', 'Images/Dear Zindagi.jpg', ' Amit Trivedi', ' Dear Zindagi (2016)', 'Hindi'),
(165, 'Upload/Lungi Dance (From Chennai Express).mp3', 'Images/Chennai Express.jpg', ' Yo Yo Honey Singh', 'Chennai Express (2013)', 'Hindi'),
(166, 'Upload/Main Hoon (From Munna Michael).mp3', 'Images/Munna Michel.jpg', 'Siddharth Mahadevan', 'Munna Michael (2017)p', 'Hindi'),
(167, 'Upload/New Day - Ikson.mp3', 'Images/Ikson_NewDay.jpg', 'Ikson', 'New Day (2019)', 'English'),
(168, 'Upload/Not Ramaiya Vastavaiya (From Jawan).mp3', 'Images/Not Ramaiya Vastavaiya (From Jawan).jpg', 'Anirudh Ravichander, Vishal Dadlani, Shilpa Rao', 'Jawan (2023)', 'Hindi'),
(169, 'Upload/Once Upon a Time (From Vikram).mp3', 'Images/Once Upon A Time (From Vikram).jpg', 'Anirudh Ravichander', 'Vikram (2022)', 'English'),
(170, 'Upload/Peelings (From Pushpa 2 -The Rule).mp3', 'Images/Peelings (From Pushpa 2 - The Rule).jpg', 'Shankarr Babu Kandukoori, Laxmi Dasa', 'Pushpa 2 : The Rule (2024)', 'Hindi'),
(171, 'Upload/Pirate - Liu & Genx.mp3', 'Images/Pirate - Liu & Genx.jpg', 'Liu & Genx', 'Pirate (2017)', 'English,Brazilian'),
(172, 'Upload/QissonMein (From Salaar Part 1 - Casefire).mp3', 'Images/QissonMein (From Salaar Part 1 - Casefire).jpg', 'Ravi Basrur , Riya Mukherjee', 'Salaar : Part 1 – Ceasefire (2023)', 'Hindi'),
(173, 'Upload/Raghupati Raghav (From Krish 3).mp3', 'Images/Krrish 3.jpg', 'Monali Thakur, Neeraj Shridhar, Bob', 'Krrish 3 (2013)', 'Hindi'),
(174, 'Upload/Red Sea (From Devara Part 1).mp3', 'Images/Red Sea (From Devara Part 1).jpg', 'Anirudh Ravichander', ' Devara Part - 1 (2024)', 'English'),
(175, 'Upload/She Move It Like - Badshah.mp3', 'Images/She Move It Like - Badshah.jpg', 'Badshah', 'ONE (Original Never Ends) (2018)', 'Hindi');

-- --------------------------------------------------------

--
-- Table structure for table `trend`
--

CREATE TABLE `trend` (
  `Trend_Id` int(11) NOT NULL,
  `TSong_Id` int(11) NOT NULL,
  `TUser_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trend`
--

INSERT INTO `trend` (`Trend_Id`, `TSong_Id`, `TUser_Id`) VALUES
(1, 36, 1),
(2, 51, 1),
(3, 6, 1),
(4, 93, 1),
(5, 69, 1),
(6, 170, 1),
(7, 62, 1),
(8, 28, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asadmins`
--
ALTER TABLE `asadmins`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `asartist`
--
ALTER TABLE `asartist`
  ADD PRIMARY KEY (`Artist_Id`);

--
-- Indexes for table `asusers`
--
ALTER TABLE `asusers`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`liked_id`),
  ADD UNIQUE KEY `Liked_User_Id` (`Liked_User_Id`,`Liked_Music_Id`),
  ADD UNIQUE KEY `unique_liked` (`Liked_User_Id`,`Liked_Music_Id`),
  ADD KEY `liked_ibfk_2` (`Liked_Music_Id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`Playlist_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD PRIMARY KEY (`Play_Id`,`Song_Id`),
  ADD KEY `Song_Id` (`Song_Id`),
  ADD KEY `fk_Playlist` (`List_Id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`Music_Id`);

--
-- Indexes for table `trend`
--
ALTER TABLE `trend`
  ADD PRIMARY KEY (`Trend_Id`),
  ADD KEY `TSong_Id` (`TSong_Id`),
  ADD KEY `TUser_Id` (`TUser_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asadmins`
--
ALTER TABLE `asadmins`
  MODIFY `Admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asartist`
--
ALTER TABLE `asartist`
  MODIFY `Artist_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `asusers`
--
ALTER TABLE `asusers`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `liked_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `Playlist_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  MODIFY `Play_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `Music_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `trend`
--
ALTER TABLE `trend`
  MODIFY `Trend_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `liked`
--
ALTER TABLE `liked`
  ADD CONSTRAINT `liked_ibfk_1` FOREIGN KEY (`Liked_User_Id`) REFERENCES `asusers` (`User_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `liked_ibfk_2` FOREIGN KEY (`Liked_Music_Id`) REFERENCES `songs` (`Music_Id`) ON DELETE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `asusers` (`User_Id`) ON DELETE CASCADE;

--
-- Constraints for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD CONSTRAINT `fk_Playlist` FOREIGN KEY (`List_Id`) REFERENCES `playlist` (`Playlist_Id`),
  ADD CONSTRAINT `playlistsongs_ibfk_2` FOREIGN KEY (`Song_Id`) REFERENCES `songs` (`Music_Id`);

--
-- Constraints for table `trend`
--
ALTER TABLE `trend`
  ADD CONSTRAINT `trend_ibfk_1` FOREIGN KEY (`TSong_Id`) REFERENCES `songs` (`Music_Id`),
  ADD CONSTRAINT `trend_ibfk_2` FOREIGN KEY (`TUser_Id`) REFERENCES `asusers` (`User_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
