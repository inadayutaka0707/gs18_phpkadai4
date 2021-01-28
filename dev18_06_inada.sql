-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_php4_kadai`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_question_table`
--

CREATE TABLE `gs_question_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `quiz` varchar(256) NOT NULL,
  `answer` text NOT NULL,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_question_table`
--

INSERT INTO `gs_question_table` (`id`, `name`, `quiz`, `answer`, `level`) VALUES
(1, '', '食べれないパン', 'answer1', 'level4'),
(2, 'test', 'you are pc', 'YES', 'level2'),
(3, 'test', 'やま', 'YES', 'level4'),
(4, 'test', 'うみ', 'YES', 'level5'),
(5, 'test', 'かわ', 'YES', 'level3'),
(6, 'test', 'そら', 'YES', 'level2'),
(7, 'test', 'あほ', 'YES', 'level1'),
(8, 'test', '裕は毛深いですか。', 'YES', 'level1'),
(9, 'test', 'test', 'NO', 'level5');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_total_table`
--

CREATE TABLE `gs_total_table` (
  `userID` int(12) NOT NULL,
  `level1` int(11) NOT NULL,
  `level2` int(11) NOT NULL,
  `level3` int(11) NOT NULL,
  `level4` int(11) NOT NULL,
  `level5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_total_table`
--

INSERT INTO `gs_total_table` (`userID`, `level1`, `level2`, `level3`, `level4`, `level5`) VALUES
(1, 3, 4, 3, 4, 4);

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `age` int(3) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `email`, `age`, `password`) VALUES
(1, 'test', 'test@test.com', 26, 'test');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_question_table`
--
ALTER TABLE `gs_question_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_total_table`
--
ALTER TABLE `gs_total_table`
  ADD PRIMARY KEY (`userID`);

--
-- テーブルのインデックス `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_question_table`
--
ALTER TABLE `gs_question_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルのAUTO_INCREMENT `gs_total_table`
--
ALTER TABLE `gs_total_table`
  MODIFY `userID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
