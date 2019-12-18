

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `friends` (
  `userA` int(11) NOT NULL,
  `userB` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `state` enum('public','private','self','') CHARACTER SET utf8 NOT NULL,
  `caption` varchar(30) CHARACTER SET utf8 NOT NULL,
  `image` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `time` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `posts` (`id`, `authorId`, `state`, `caption`, `image`, `time`) VALUES
(2, 36, 'public', 'lmao', '', '2019-05-20 21:16:20.6670'),
(4, 36, 'public', 'sdsdsds', '', '2019-05-20 21:17:06.3471'),
(6, 36, 'self', 'private', '', '2019-05-20 21:18:38.3534'),
(7, 36, 'private', 'xd', '', '2019-05-20 21:18:56.1783'),
(8, 36, 'self', 'test', '', '2019-05-20 22:50:03.2986'),
(10, 12, 'private', 'Friends\r\n', '', '2019-05-20 23:01:16.2348'),
(11, 12, 'self', 'Only me', '', '2019-05-20 23:01:24.2820');


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `nickName` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `homeTown` varchar(255) DEFAULT NULL,
  `maritalStatus` varchar(255) DEFAULT NULL,
  `about` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;


ALTER TABLE `friends`
  ADD UNIQUE KEY `UQ_userA_userB` (`userA`,`userB`),
  ADD KEY `userB` (`userB`);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorId` (`authorId`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;


ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;


ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`userA`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`userB`) REFERENCES `users` (`id`) ON UPDATE CASCADE;


ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `users` (`id`);
COMMIT;
