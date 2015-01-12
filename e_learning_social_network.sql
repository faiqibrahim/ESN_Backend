-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2015 at 07:28 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e_learning_social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `announcement` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_announcements_class1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `announcement`, `created`, `modified`, `group_id`) VALUES
(1, 'This is the first announcement', 'From today the work has started People..... Let the fun begin', '2015-01-09 17:06:32', '2015-01-09 17:06:32', 11);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_answers_questions1_idx` (`question_id`),
  KEY `fk_answers_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `question_id`, `user_id`, `created`, `modified`) VALUES
(18, 'AngularJS is a structural framework for dynamic web apps. It lets you use HTML as your template language and lets you extend HTML''s syntax to express your application''s components clearly and succinctly. Angular''s data binding and dependency injection eliminate much of the code you would otherwise have to write.', 4, 52, '2015-01-08 12:40:24', '2015-01-08 12:40:24'),
(19, 'SEO stands for Search Engine Optimization', 6, 54, '2015-01-08 19:42:42', '2015-01-08 19:42:42'),
(20, 'I''ll upload a link in posts to tutorials for that', 5, 53, '2015-01-09 14:50:45', '2015-01-09 14:50:45'),
(21, 'I am Awesome', 7, 52, '2015-01-12 14:19:48', '2015-01-12 14:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `boardmessage`
--

CREATE TABLE IF NOT EXISTS `boardmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(45) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `generated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messageboard_class1_idx` (`group_id`),
  KEY `fk_messageboard_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contactroles`
--

CREATE TABLE IF NOT EXISTS `contactroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contactroles`
--

INSERT INTO `contactroles` (`id`, `role`) VALUES
(1, 'follower');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_id1` int(11) NOT NULL,
  `contactrole_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contacts_users_idx` (`user_id`),
  KEY `fk_contacts_users1_idx` (`user_id1`),
  KEY `fk_contacts_contacts_roles1_idx` (`contactrole_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `user_id1`, `contactrole_id`) VALUES
(11, 53, 52, 1),
(12, 53, 54, 1),
(13, 54, 52, 1),
(15, 52, 53, 1),
(17, 54, 53, 1),
(19, 55, 52, 1),
(22, 52, 54, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contentprivacies`
--

CREATE TABLE IF NOT EXISTS `contentprivacies` (
  `id` int(11) NOT NULL,
  `privacy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `contenttype_id` int(11) NOT NULL,
  `contentprivacy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contents_content_types1_idx` (`contenttype_id`),
  KEY `fk_contents_contentprivacy1_idx` (`contentprivacy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `contenttypes`
--

CREATE TABLE IF NOT EXISTS `contenttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contenttypes`
--

INSERT INTO `contenttypes` (`id`, `type`) VALUES
(1, 'image'),
(2, 'video'),
(3, 'file');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE IF NOT EXISTS `educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institute` varchar(100) NOT NULL,
  `major` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groupcontent`
--

CREATE TABLE IF NOT EXISTS `groupcontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_classcontent_class1_idx` (`group_id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `groupprivacies`
--

CREATE TABLE IF NOT EXISTS `groupprivacies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privacy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groupprivacies`
--

INSERT INTO `groupprivacies` (`id`, `privacy`) VALUES
(1, 'public'),
(2, 'private');

-- --------------------------------------------------------

--
-- Table structure for table `grouproles`
--

CREATE TABLE IF NOT EXISTS `grouproles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `grouproles`
--

INSERT INTO `grouproles` (`id`, `role`) VALUES
(1, 'CR'),
(2, 'student'),
(3, 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `created` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `groupprivacy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_class_users1_idx` (`user_id`),
  KEY `fk_class_class_privacy1_idx` (`groupprivacy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `description`, `startdate`, `created`, `user_id`, `groupprivacy_id`) VALUES
(11, 'Learn AngularJS', 'Join to Learn AngularJS Straight from the IMA', NULL, '1420716837', 52, 1),
(12, 'Wordpress Development', 'Join My group to learn new things each day ab', NULL, '1420716988', 53, 1),
(13, 'SEO', 'Raise your ranks in Search Engines', NULL, '1420720163', 54, 1),
(14, 'Testing Group', 'Blah blah', NULL, '1421068889', 52, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups_interests`
--

CREATE TABLE IF NOT EXISTS `groups_interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `interest_id` (`interest_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `groups_interests`
--

INSERT INTO `groups_interests` (`id`, `group_id`, `interest_id`) VALUES
(6, 11, 7),
(7, 11, 6),
(8, 12, 6),
(9, 14, 7),
(10, 14, 6);

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE IF NOT EXISTS `group_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grouprole_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_class_users_class1_idx` (`group_id`),
  KEY `fk_class_users_users1_idx` (`user_id`),
  KEY `fk_class_users_classRoles1_idx` (`grouprole_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `group_users`
--

INSERT INTO `group_users` (`id`, `group_id`, `user_id`, `grouprole_id`) VALUES
(15, 11, 54, 2),
(16, 13, 52, 2),
(17, 13, 53, 2),
(26, 11, 53, 2),
(28, 11, 55, 2),
(29, 12, 52, 2);

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE IF NOT EXISTS `interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interest` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `interest`) VALUES
(5, 'jQuery'),
(6, 'PHP'),
(7, 'AngularJS'),
(8, 'Blah Blah'),
(9, 'JAVA'),
(10, 'C++');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_id1` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users1_idx` (`user_id`),
  KEY `fk_messages_users2_idx` (`user_id1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `post` text,
  `user_id` int(11) NOT NULL,
  `privacy_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_users1_idx` (`user_id`),
  KEY `fk_posts_privacies1_idx` (`privacy_id`),
  KEY `fk_posts_groups1_idx` (`group_id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `created`, `modified`, `post`, `user_id`, `privacy_id`, `group_id`, `content_id`) VALUES
(75, '2015-01-08 12:33:08', '2015-01-09 07:41:08', 'Your comrades are there to make up for what you cannot do and to prevent you from ignoring things that you actually might have been able to do.', 52, 1, NULL, NULL),
(76, '2015-01-08 12:41:36', '2015-01-12 19:19:04', 'Itachi Uchiha (ã†ã¡ã¯ã‚¤ã‚¿ãƒ, Uchiha Itachi) was a prodigy of Konohagakure''s Uchiha clan. He became an international criminal after murdering his entire clan, sparing only his younger brother, Sasuke. He joined Akatsuki, where he came into frequent conflict with Konoha and its ninja, including Sasuke, who sought to avenge their family. After dying during a battle with Sasuke, Itachi''s motivations were revealed to be more complicated than they seemed and that he only wanted to protect his brother and village, remaining a loyal shinobi of Konohagakure to the very end.', 52, 1, 11, NULL),
(82, '2015-01-09 15:08:36', '2015-01-09 15:08:41', 'ok', 53, 1, NULL, NULL),
(84, '2015-01-12 16:23:29', '2015-01-12 16:23:29', 'Hello Dear All', 54, 1, NULL, NULL),
(85, '2015-01-12 16:24:52', '2015-01-12 16:24:52', 'Testing POsts Brop', 53, 1, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privacies`
--

CREATE TABLE IF NOT EXISTS `privacies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privacy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `privacies`
--

INSERT INTO `privacies` (`id`, `privacy`) VALUES
(1, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questions_users1_idx` (`user_id`),
  KEY `fk_questions_class1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `user_id`, `group_id`, `created`, `modified`) VALUES
(4, 'What is Angular JS?', 53, 11, '2015-01-08 12:38:16', '2015-01-08 12:38:16'),
(5, 'How to develop custom themes for wordpress si', 52, 12, '2015-01-08 15:35:07', '2015-01-08 15:35:07'),
(6, 'What is SEO ?', 52, 13, '2015-01-08 19:42:01', '2015-01-08 19:42:01'),
(7, 'Who are youi', 53, 11, '2015-01-12 14:18:41', '2015-01-12 14:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL,
  `request` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `requesttype_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_requests_users1_idx` (`user_id`),
  KEY `fk_requests_request_types1_idx` (`requesttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `requesttypes`
--

CREATE TABLE IF NOT EXISTS `requesttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `requesttypes_roles`
--

CREATE TABLE IF NOT EXISTS `requesttypes_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requesttype_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_requests_roles_request_types1_idx` (`requesttype_id`),
  KEY `fk_requests_roles_roles1_idx` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'basic_user');

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE IF NOT EXISTS `solutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solution` varchar(45) DEFAULT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_solutions_tasks1_idx` (`task_id`),
  KEY `fk_solutions_users1_idx` (`user_id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` text,
  `enddate` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tasks_class1_idx` (`group_id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `coverphoto` varchar(253) DEFAULT NULL,
  `coverphoto_thumb` varchar(300) DEFAULT NULL,
  `profilephoto` varchar(253) DEFAULT NULL,
  `profilephoto_thumb` varchar(255) DEFAULT NULL,
  `tagline` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `contact`, `address`, `city`, `country`, `coverphoto`, `coverphoto_thumb`, `profilephoto`, `profilephoto_thumb`, `tagline`) VALUES
(52, 'admin', '$2a$10$teDXHsBMuTCtn.sUSk56NeouJU3WfCYrD4qZYzZmCn//nUeTFiJ.G', 'admin@esn.com', 'Ibraheem', 'Faiq', '+92-345-468-272', '235-A DHA Lahore EME Sector', 'Lahore', 'Pakistan', 'http://esnback.com/app/webroot/img/10561689_10152703616213523_3766028529544431607_n.jpg', 'http://esnback.com/app/webroot/img/thumbs/10561689_10152703616213523_3766028529544431607_n.jpg', 'http://esnback.com/app/webroot/img/10600629_396618757158007_5918061917535494890_n.jpg', 'http://esnback.com/app/webroot/img/thumbs/10600629_396618757158007_5918061917535494890_n.jpg', 'Let it snow let it snow let it snow2'),
(53, 'mak', '$2a$10$3/q12m5gikrfmjCq3.nKtOUhJzEMb8j/zgAXcs4x3YFjQBQvL8GMa', 'mak@mak.com', 'Moeez', 'Ali Khan', NULL, NULL, NULL, NULL, 'http://esnback.com/app/webroot/img/10561689_10152703616213523_3766028529544431607_n.jpg', 'http://esnback.com/app/webroot/img/thumbs/10561689_10152703616213523_3766028529544431607_n.jpg', 'http://esnback.com/app/webroot/img/1669858_10202739433516172_6400968328137658840_o.jpg', 'http://esnback.com/app/webroot/img/thumbs/1669858_10202739433516172_6400968328137658840_o.jpg', 'I am the best CR of CIIT LHR'),
(54, 'thealiahmedawan', '$2a$10$COJcQmPTDfjZ/ixQftATT.AHmEwscHO9xzFGBCuRO1FgcboVb.PQ2', 'the@ali.com', 'Ali Ahmed', 'Awan', NULL, NULL, NULL, NULL, 'http://esnback.com/app/webroot/img/10561689_10152703616213523_3766028529544431607_n.jpg', 'http://esnback.com/app/webroot/img/thumbs/10561689_10152703616213523_3766028529544431607_n.jpg', 'http://esnback.com/app/webroot/img/640px-Aristotle_Altemps_Inv8575.jpg', 'http://esnback.com/app/webroot/img/thumbs/640px-Aristotle_Altemps_Inv8575.jpg', 'I am THE ALI AHMED AWAN'),
(55, 'haleema', '$2a$10$ZY3UY34i9kewLwTuUekEM.qpO2SIec1lvbL5F7XcMnib1UiQrauZ6', 'a@a.com', 'Idrees', 'Faiq', NULL, NULL, NULL, NULL, 'http://esnback.com/app/webroot/img/10620806_383498795146870_6822728508225793905_n.jpg', 'http://esnback.com/app/webroot/img/thumbs/10620806_383498795146870_6822728508225793905_n.jpg', 'http://esnback.com/app/webroot/img/MTIwNjA4NjMzNTM4NTEyMzk2.jpg', 'http://esnback.com/app/webroot/img/thumbs/MTIwNjA4NjMzNTM4NTEyMzk2.jpg', 'I am idrees Faiq');

-- --------------------------------------------------------

--
-- Table structure for table `users_educations`
--

CREATE TABLE IF NOT EXISTS `users_educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `education_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_interests`
--

CREATE TABLE IF NOT EXISTS `users_interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_interests_users1_idx` (`user_id`),
  KEY `fk_users_interests_interests1_idx` (`interest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `users_interests`
--

INSERT INTO `users_interests` (`id`, `user_id`, `interest_id`) VALUES
(33, 52, 6),
(34, 52, 5),
(37, 53, 7),
(38, 53, 9),
(39, 55, 7),
(40, 55, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE IF NOT EXISTS `users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_roles_users1_idx` (`user_id`),
  KEY `fk_users_roles_roles1_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `user_id`, `role_id`) VALUES
(27, 52, 1),
(28, 53, 2),
(29, 54, 2),
(30, 55, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `fk_announcements_class1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answers_questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_answers_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `boardmessage`
--
ALTER TABLE `boardmessage`
  ADD CONSTRAINT `fk_messageboard_class1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messageboard_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_contacts_roles1` FOREIGN KEY (`contactrole_id`) REFERENCES `contactroles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contacts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contacts_users1` FOREIGN KEY (`user_id1`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `fk_contents_contentprivacy1` FOREIGN KEY (`contentprivacy_id`) REFERENCES `contentprivacies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_content_types1` FOREIGN KEY (`contenttype_id`) REFERENCES `contenttypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `groupcontent`
--
ALTER TABLE `groupcontent`
  ADD CONSTRAINT `fk_classcontent_class1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `groupcontent_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `fk_class_class_privacy1` FOREIGN KEY (`groupprivacy_id`) REFERENCES `groupprivacies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_class_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `groups_interests`
--
ALTER TABLE `groups_interests`
  ADD CONSTRAINT `groups_interests_ibfk_1` FOREIGN KEY (`interest_id`) REFERENCES `interests` (`id`),
  ADD CONSTRAINT `groups_interests_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `group_users`
--
ALTER TABLE `group_users`
  ADD CONSTRAINT `fk_class_users_class1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_class_users_classRoles1` FOREIGN KEY (`grouprole_id`) REFERENCES `grouproles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_class_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_users2` FOREIGN KEY (`user_id1`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_privacies1` FOREIGN KEY (`privacy_id`) REFERENCES `privacies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_class1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questions_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_requests_request_types1` FOREIGN KEY (`requesttype_id`) REFERENCES `requesttypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requests_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `requesttypes_roles`
--
ALTER TABLE `requesttypes_roles`
  ADD CONSTRAINT `fk_requests_roles_request_types1` FOREIGN KEY (`requesttype_id`) REFERENCES `requesttypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requests_roles_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `solutions`
--
ALTER TABLE `solutions`
  ADD CONSTRAINT `fk_solutions_tasks1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solutions_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `solutions_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_class1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`);

--
-- Constraints for table `users_interests`
--
ALTER TABLE `users_interests`
  ADD CONSTRAINT `fk_users_interests_interests1` FOREIGN KEY (`interest_id`) REFERENCES `interests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_interests_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `fk_users_roles_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_roles_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
