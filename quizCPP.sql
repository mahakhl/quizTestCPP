-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2016 at 07:38 
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizCPP`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE `Answer` (
  `id` int(11) NOT NULL,
  `id_Q` int(11) NOT NULL,
  `variant` text NOT NULL,
  `ans` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Answer`
--

INSERT INTO `Answer` (`id`, `id_Q`, `variant`, `ans`) VALUES
(1, 1, 'programul nu intoarce nici o valoare', 0),
(2, 1, '-1', 0),
(3, 1, '0', 1),
(4, 1, '1', 0),
(5, 2, ', [virgula]', 0),
(6, 2, ': [2 puncte]', 0),
(7, 2, '; [punct si virgula]', 1),
(8, 2, '. [punct]', 0),
(9, 3, '10', 1),
(10, 3, '9', 0),
(11, 3, '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Examene`
--

CREATE TABLE `Examene` (
  `id_student` int(11) NOT NULL,
  `mark` int(1) NOT NULL,
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Examene`
--

INSERT INTO `Examene` (`id_student`, `mark`, `day`) VALUES
(6, 8, '2016-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `grupa`
--

CREATE TABLE `grupa` (
  `id_student` int(11) NOT NULL,
  `name` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupa`
--

INSERT INTO `grupa` (`id_student`, `name`) VALUES
(1, 'MI-131'),
(2, 'MI-131'),
(3, 'MI-131'),
(4, 'MI-131'),
(5, 'MI-131'),
(6, 'MI-131'),
(7, 'MI-131'),
(8, 'MI-131'),
(9, 'MI-131'),
(10, 'MI-131');

-- --------------------------------------------------------

--
-- Table structure for table `People`
--

CREATE TABLE `People` (
  `id` int(11) NOT NULL,
  `nume` varchar(20) NOT NULL,
  `prenume` varchar(20) NOT NULL,
  `paswd` text NOT NULL,
  `grad` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `People`
--

INSERT INTO `People` (`id`, `nume`, `prenume`, `paswd`, `grad`) VALUES
(1, 'Brinzila', 'Irina', 'irina@mi-131', 'student'),
(2, 'Burlacu', 'Vasile', 'vasile@mi-131', 'student'),
(3, 'Cernalevschi', 'Ion', 'ion@mi-131', 'student'),
(4, 'Chiriliuc', 'Silvia', 'silvia@mi-131', 'student'),
(5, 'Focsa', 'Petru', 'petru@mi-131', 'student'),
(6, 'Medinschi', 'Doina', 'doina@mi-131', 'student'),
(7, 'Suleanschi', 'Natalia', 'natalia@mi-131', 'student'),
(8, 'Cernavca', 'Nicoleta', 'nicoleta@mi-131', 'student'),
(9, 'Postica', 'Maria', 'maria@mi-131', 'student'),
(10, 'Bulat', 'Vitalii', 'vitalii@mi-131', 'student'),
(11, 'Perebinos', 'Mihail', 'perebinos@god', 'prof');

-- --------------------------------------------------------

--
-- Table structure for table `practice`
--

CREATE TABLE `practice` (
  `id_student` int(11) NOT NULL,
  `corect` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practice`
--

INSERT INTO `practice` (`id_student`, `corect`, `total`) VALUES
(7, 15, 20);

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE `Question` (
  `id` int(11) NOT NULL,
  `quiz` text NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Question`
--

INSERT INTO `Question` (`id`, `quiz`, `level`) VALUES
(1, 'Ce valoarea returneaza programul in cazul finalizarii cu succes ?', 1),
(2, 'Cu ce semn se termina majoritatea rindurilor in C++ ?', 1),
(3, 'Care este valoarea variabilei "a" la finele acestui cod ?\r\nint a; for(a = 0; a < 10; a++) {}', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answer`
--
ALTER TABLE `Answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Examene`
--
ALTER TABLE `Examene`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `grupa`
--
ALTER TABLE `grupa`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `People`
--
ALTER TABLE `People`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practice`
--
ALTER TABLE `practice`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Answer`
--
ALTER TABLE `Answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `People`
--
ALTER TABLE `People`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Question`
--
ALTER TABLE `Question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
