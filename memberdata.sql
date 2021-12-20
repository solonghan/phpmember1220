-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-13 04:50:42
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `phpmember`
--

-- --------------------------------------------------------

--
-- 資料表結構 `memberdata`
--

CREATE TABLE `memberdata` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `m_sex` enum('男','女') COLLATE utf8_unicode_ci NOT NULL,
  `m_birthday` date DEFAULT NULL,
  `m_level` enum('admin','member') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'member',
  `m_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_login` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `m_logintime` datetime DEFAULT NULL,
  `m_jointime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `memberdata`
--

INSERT INTO `memberdata` (`m_id`, `m_name`, `m_username`, `m_passwd`, `m_sex`, `m_birthday`, `m_level`, `m_email`, `m_url`, `m_phone`, `m_address`, `m_login`, `m_logintime`, `m_jointime`) VALUES
(1, '系統管理員', 'admin', '$2y$10$FO70lc.3/vTeE0Vaf7O3Jes.UArylzLnnxfZffTF7410vndnvhScm', '男', '0000-00-00', 'admin', '', '', '', '', 43, '2021-12-13 11:38:57', '2008-10-20 16:36:15'),
(2, '張惠玲', 'elven', '$2y$10$YdUhOvUTvwK5oWp/i3LafOd2ImwsE/85YmmoY2konsxdmMSsvczFO', '女', '1987-04-05', 'member', 'elven@superstar.com', '', '0966765556', '台北市濟洲北路12號2樓', 12, '2016-08-29 11:44:33', '2008-10-21 12:03:12'),
(3, '彭建志', 'jinglun', '$2y$10$WqB2bnMSO/wgBiHSOBV2iuLbrUCsp8VmNJdK2AyIW6IANUL9jeFjC', '男', '1987-07-01', 'member', 'jinglun@superstar.com', '', '0918181111', '台北市敦化南路93號5樓', 0, NULL, '2008-10-21 12:06:08'),
(4, '謝耿鴻', 'sugie', '$2y$10$6uWtdYATI3b/wMRk.AaqIei852PLf.WjeKm8X.Asl0VTmpxCkqbW6', '男', '1987-08-11', 'member', 'edreamer@gmail.com', '', '0914530768', '台北市中央路201號7樓', 2, '2016-08-29 14:03:53', '2008-10-21 12:06:08'),
(5, '蔣志明', 'shane', '$2y$10$pWefN9xkeXOKCx59GF6ZJuSGNnIFBY4q/DCmCvAwOFtnoTCujb3Te', '男', '1984-06-20', 'member', 'shane@superstar.com', NULL, '0946820035', '台北市建國路177號6樓', 0, NULL, '2008-10-21 12:06:08'),
(6, '王佩珊', 'ivy', '$2y$10$RPrt3YfaSs0d82inYIK6he.JaPqOrisWMqASuxN5g62EyRio.lyEa', '女', '1988-02-15', 'member', 'ivy@superstar.com', NULL, '0920981230', '台北市忠孝東路520號6樓', 0, NULL, '2008-10-21 12:06:08'),
(7, '林志宇', 'zhong', '$2y$10$pee.jvO6f4sSKahlc4cLLO9RUMyx8aphyqkSUdwHTNSy4Ax7YPdpq', '男', '1987-05-05', 'member', 'zhong@superstar.com', NULL, '0951983366', '台北市三民路1巷10號', 0, NULL, '2008-10-21 12:06:08'),
(8, '李曉薇', 'lala', '$2y$10$oiC9CaGiOdWu.6w5b3.b/Ora6fSuh8Lrbj8Kg5BUPT15O3QptksQS', '女', '1985-08-30', 'member', 'lala@superstar.com', NULL, '0918123456', '台北市仁愛路100號', 0, NULL, '2008-10-21 12:06:08'),
(9, '賴秀英', 'crystal', '$2y$10$8Q0.JEGILRM91qAlMmWnB.wpcY.rJEbgNgV5ntIlqZmdGaHPwikji', '女', '1986-12-10', 'member', 'crystal@superstar.com', NULL, '0907408965', '台北市民族路204號', 0, NULL, '2008-10-21 12:06:08'),
(10, '張雅琪', 'peggy', '$2y$10$RNqnXDNHkcTI2Zh2bkTKnOesz0FLXhihhT8ZL8OHoMeYSq7jsILMi', '女', '1988-12-01', 'member', 'peggy@superstar.com', NULL, '0916456723', '台北市建國北路10號', 0, NULL, '2008-10-21 12:06:08'),
(11, '陳燕博', 'albert', '$2y$10$seMLwqcQRQiWa0jMBAcMMertjLbrPLRGNZoKc0NZ5FxTwWha7W3lm', '男', '1993-08-10', 'member', 'albert@superstar.com', NULL, '0918976588', '台北市北環路2巷80號', 0, NULL, '2008-10-21 12:06:08'),
(13, '黃信溢', 'dkdreamer', '$2y$10$Fx0rLJtV5mVtJzAJ52B/hup1AmviTe7Ciu0mtWBCZAkYC0qmg6OJy', '女', '1987-04-05', 'member', 'edreamer@gmail.com', '', '955648889', '愛蘭里梅村路213巷8號', 1, '2016-08-29 17:42:24', '2016-08-29 17:41:46'),
(14, '韓修文', 'sss9611300', '314028', '男', '1988-12-09', 'member', 'sss9611300@yahoo.com.tw', '', '', '', 1, '2021-11-16 18:16:13', '2021-11-16 18:14:53'),
(15, '王小明', 'aaa9611300', '$2y$10$2NEk9Zy3cYh2NKXKItHd6u8LdR8sGYYT2YucssbwjNBlupjytLK7C', '男', '1988-12-09', 'member', 'sss9611300@yahoo.com.tw', '', '', '', 12, '2021-12-13 11:27:34', '2021-11-17 16:42:27'),
(16, '羅一郎', 'bbb9611300', '314028', '男', '0000-00-00', 'member', '', '', '', '', 0, '2021-11-18 19:54:29', '2021-12-01 22:20:49'),
(17, '吳靜寧', 'zzz9611300', '$2y$10$WWWgWtSFK84dDDvmnF8cve2jEXx3WSuT1OXMKWAANi7G3T.97XfgG', '男', '2011-11-11', 'member', '', '', '', '', 0, '2021-11-18 19:57:08', '2021-11-04 22:20:38'),
(23, 'sss', 'sss', '$2y$10$J3yizqQpATePyoz0ryCgmeNdxivOT161LFwM6wX6Dv42yvE2883KK', '男', '0000-00-00', 'member', 'sss', '', '', '', 0, '2021-11-18 20:14:53', '2021-11-02 22:20:22'),
(24, 'Mary', 'aaaaa', '', '女', '0000-00-00', 'member', '', '', '', '', 0, NULL, '2021-11-18 20:22:23'),
(27, '陳雷', 'ccc9611300', '$2y$10$hwxr8iWGGcajMulgjBUGRubt0eU7eC1Yq/r02attXzNN5fKSbyix.', '男', '1988-12-09', 'member', 'sss9611300@yahoo.com.tw', '', '', '', 0, '2021-11-30 13:56:54', '2021-12-03 22:20:12'),
(86, '陳奕', 'aaassss', '$2y$10$3pZqnMnWKsDyCbNZ9uJbl.Z8bNnxGqgLB0qLEF9Nq5PCKQldNHdPy', '男', '0000-00-00', 'member', '', '', '', '', 0, '2021-11-30 15:41:07', '2021-12-02 22:20:06'),
(104, '許文志', 'dsdsdsd', '$2y$10$rMlwopQYk.6RA7b/0hrFgel0ApNe0T9mTScV2TtwEwYgI8qa69bNi', '男', '0000-00-00', 'member', 'dsds@yahoo.com', '', '', '', 0, '2021-11-30 16:27:33', '2021-12-01 22:19:56'),
(108, '曾立亥', 'nonono', '$2y$10$sskS0.i7jVms5LBjXb7LaOFBtzw6UZ68X10W6ysW3jZiLMSZpPdfm', '男', '1988-12-09', 'member', 'sss9611300@yahoo.com.tw', '', '', '', 1, '2021-11-30 21:39:45', '2021-11-30 21:39:08'),
(120, '陳奕白', 'sss314028', '$2y$10$yQDNZSzC1qa2HZbauV9D3Ovd81koU3/va0TfkRDthWrukz42yGnly', '男', '0000-00-00', 'member', 'sss9611300@yahoo.com.tw', '', '0987987987', '地球村', 0, NULL, '2021-12-08 11:16:30'),
(123, '王小明', 'ggg9611300', '$2y$10$eWkzChI4ys/6ycDgxKaWW./Zj61t0byRItG2PWvzjcsZLGlleP2FC', '男', '1988-12-09', 'member', 'sss9611300@yahoo.com.tw', '', '', '', 2, '2021-12-09 22:48:38', '2021-12-09 15:50:58');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `memberdata`
--
ALTER TABLE `memberdata`
  ADD PRIMARY KEY (`m_id`),
  ADD UNIQUE KEY `m_username` (`m_username`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `memberdata`
--
ALTER TABLE `memberdata`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
