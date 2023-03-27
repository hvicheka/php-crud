/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `useremail` varchar(128) NOT NULL,
  `userphone` varchar(24) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `useremail`, `userphone`, `dt`) VALUES
(1, 'Kazal Chandra barman', 'kcb.brurcs42@gmail.com', '01740489442', '2020-07-08 01:44:20');
INSERT INTO `users` (`id`, `username`, `useremail`, `userphone`, `dt`) VALUES
(4, 'Karim', 'karim42@gmail.com', '324323432', '2020-07-08 02:02:24');
INSERT INTO `users` (`id`, `username`, `useremail`, `userphone`, `dt`) VALUES
(5, 'Samy', 'samy42@gmail.com', '3223423423', '2020-07-08 02:02:40');
INSERT INTO `users` (`id`, `username`, `useremail`, `userphone`, `dt`) VALUES
(6, 'Ram', 'ram42@gmail.com', '1321231231', '2020-07-08 02:03:08'),
(7, 'jadav', 'jadav42@gmail.com', '242342342', '2020-07-08 02:03:32'),
(8, 'Mahadi', 'mehadi42@gmail.com', '5345334', '2020-07-08 02:03:56'),
(9, 'Nasrin', 'nasrin42@gmail.com', '31312312312', '2020-07-08 02:04:20'),
(10, 'Rumpa', 'rumpa42@gmail.com', '12121212', '2020-07-08 02:04:39'),
(11, 'Shampa', 'shampa42@gmail.com', '422342342', '2020-07-08 02:05:01'),
(12, 'nowrose amin', 'nowrose42@gmail.com', '01740489442', '2020-07-08 23:21:28'),
(13, 'Vagyalata', 'vagya@gmail.com', '7686234234', '2020-07-08 23:47:58'),
(15, 'Asad asif', 'asadasif42@gmail.com', '34243423', '2020-07-09 00:26:43'),
(16, 'Hemayet', 'heyamet42@gmail.com', '78423462', '2020-07-09 01:19:46'),
(17, 'New User', 'user@gmail.com', '09924222', '2023-03-25 09:03:25');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;