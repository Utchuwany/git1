-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 07:53 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(127) NOT NULL,
  `surname` varchar(127) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Pracownik','Kierownik','Administrator') NOT NULL DEFAULT 'Pracownik',
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `role`, `active`) VALUES
(1, 'Jannoweeee', 'Kowalski', 'jan@o2.pl', '$argon2id$v=19$m=65536,t=4,p=1$ekJoMy5GS0hnaVZ6UWR3UA$ggFwh1FV5TJrOnzKOa0rJaZJVo69UY11VnNHJDrwglg', 'Administrator', 0),
(2, 'Tom', 'Tomas', 'tom@o2.pl', '$2y$10$Q8/ckn4FCp2dk0GRn3f9gu3Uf6jD23eeHhi9Q/N9m0Kcvi//SMTAq', 'Kierownik', 0),
(3, 'Piotr', 'Piotrowicz', 'piotr@o2.pl', '$2y$10$GCbZdhRL9z.tZmyw02QCWe.276gdK.giR.WlLt7saBtnIwabBTtUO', 'Pracownik', 0),
(6, 'Testowicz', 'Testowiak', 'testowy@o2.pl', '$argon2id$v=19$m=65536,t=4,p=1$WTQzaC9CamFvRmVLQnpKMg$e7MKeHVoR6fgJOWPv/WAAdGSkkqfFv/b+qR171O9ECk', 'Kierownik', 0),
(7, 'testo', 'Wironik', 'testowiak@o2.pl', '$argon2id$v=19$m=65536,t=4,p=1$RTlQeWNLWXNkd0QzYmRUOA$ubQsTw+cxNIQcZ64i3gu1wZVClacC50/WBLM2/ClU5Q', 'Pracownik', 0),
(8, 'Test', 'test', 'test@o2.pl', '$argon2id$v=19$m=65536,t=4,p=1$TzNBT0lvQmFjZXVCRS5tVg$0qS5xlF5m4wFIVs+/Jsoa/bL4XgV51kCtoeigMbXYcA', 'Administrator', 0),
(9, 'Test', 'test', 'test@o2.pl', '$argon2id$v=19$m=65536,t=4,p=1$OHlDQnpUaXNwRG9TQS5ocQ$cnrMeBHIbSS6X8R9xu4nKB9anjwgkZ+kNrOoyG8pEvs', 'Administrator', 0),
(10, 'nowyuzy', 'nowyizz', 'testowiak@o2.pl', '$argon2id$v=19$m=65536,t=4,p=1$Vm0zTmNsa2dUcWUyM3FuVQ$OR5LTPhV19JahYE5IHcJCKmf/imLeAHmvyXDjivq+zw', 'Kierownik', 0),
(11, 'Testpracownik', 'Prrrrrrrrr', 'Testpracownik@o2.pl', '$argon2id$v=19$m=65536,t=4,p=1$a0dVYWxoSUdZTXZWMkhnZg$d0dxuNclxzgU5vzZe7MgAo3WhZIQMT7yPeYJ7jOTihM', 'Pracownik', 0),
(12, 'Testkierownik', 'Kierownik', 'Testkierownik@o2.pl', '$argon2id$v=19$m=65536,t=4,p=1$UkhkY1dzTHIzeDIxWU5vSA$Wcg9v95VVoI+zTDDlDpxdEdpBKPNVoUc2Zi6agthmQQ', 'Kierownik', 0),
(13, 'TestAdmin', 'Adminiski', 'Testadmin@02.pl', '$argon2id$v=19$m=65536,t=4,p=1$Lnk5RnJPaHpRYzBrMm9pNQ$mhRIppK4wNWqOTH2VYJtdEzSXxnfPmLj4p3/gsJESwM', 'Administrator', 0);

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `calendar` date NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` smallint(6) NOT NULL,
  `day` smallint(6) NOT NULL,
  `id_worker` int(11) NOT NULL,
  `hours` tinyint(4) NOT NULL,
  `comment_user` text DEFAULT NULL,
  `comment_superviser` text DEFAULT NULL,
  `comment_admin` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `calendar`, `year`, `month`, `day`, `id_worker`, `hours`, `comment_user`, `comment_superviser`, `comment_admin`) VALUES
(1, '2024-06-04', 2024, 6, 0, 5, 21, '', 'yyyyyyyyyyyyyyyyy', ''),
(2, '2024-06-06', 2024, 6, 6, 4, 7, 'komentarz usera', 'komentarz kirasa', 'komentarz admina'),
(3, '2024-06-11', 2024, 6, 0, 1, 22, '', 'aaaaaaaaaaaaaaaaaaaaaa', 'adadadadada'),
(5, '2024-06-27', 2024, 6, 7, 0, 0, '', 'jjjjjjjjjjjjjjjkkjkjkjjk', ''),
(6, '2024-06-27', 2024, 6, 27, 1, 8, '', 'njinijnibubuivyv', ''),
(7, '2024-06-27', 2024, 6, 0, 2, 2, '', 'ttttttttttttttttttttttttttttttttt', ''),
(8, '2024-06-29', 2024, 6, 29, 1, 12, '', '', ''),
(9, '2024-11-28', 2024, 11, 28, 2, 2, '', 'afafafafafaf', ''),
(10, '2024-12-12', 2024, 2, 12, 3, 9, '', 'ibibbuuguuyuy', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`calendar`,`id_worker`),
  ADD UNIQUE KEY `nibyglowny` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
