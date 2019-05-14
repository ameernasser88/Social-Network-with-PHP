

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `birthdate` date NOT NULL,
  `profilePicture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `homeTown` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `maritalStatus` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `about` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;



INSERT INTO `users` VALUES (12, 'sansa', 'stark', 'Lady Sansa', '$2y$10$d52fVkTHKo6mwSq1m2KcF.v6AK7qpbIGAy0CfDcafirCN1Kr5zM2.', '1610453', 'sansastark@hbo.com', 'female', '1995-05-12', '12sansa.jpg', 'winterfell', 'Single', 'I am the true power in the north !');
INSERT INTO `users` VALUES (13, 'arya', 'stark', 'No one', '$2y$10$JAJ/UzfsIbXNql34Um6kN.IGomrh8sJZZpsGDfAkn5TPPYJHcog2i', '748258963', 'aryastark@hbo.com', 'female', '1997-06-20', '13arya.jpg', 'winterfell', 'Single', 'I am arya stark');
INSERT INTO `users` VALUES (15, 'jon', 'snow', 'Aegon Targaryen', '$2y$10$wiDxR7ZpYgdEBC44T2h3EuSJYui6sNcJSVDvKBnu5NaWhmp5dkiiK', '112233445566', 'jonsnow@hbo.com', 'male', '1992-01-01', NULL, 'winterfell', 'Single', 'I am the true heir to the iron throne');
INSERT INTO `users` VALUES (17, 'daenerys', 'targaryen', 'Daenerys Stormborn', '$2y$10$Ucp4BwHooxfl6r/fsUp7puOM66.ds.PffbwvQZtaWW20uMnC0C9rK', '999999999', 'queendany@hbo.com', 'female', '1995-12-12', '17dany.jpg', 'kingslanding', 'Single', 'breaker of chains protector of the realm !');
INSERT INTO `users` VALUES (18, 'theon', 'greyjoy', 'Theon', '$2y$10$ALfivMJdZitacacyxfZBxu2ezd/iLw9zLF5bRsNruCIKUnG8bWR6a', '00000000', 'theongreygoy@hbo.com', 'male', '1995-07-07', NULL, 'pyke', 'Single', 'I am a stark and a greyjoy');

SET FOREIGN_KEY_CHECKS = 1;
