
CREATE TABLE `accounts` (
  `id_acc` int(11) NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `display_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` text CHARACTER SET utf8 NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `facebook` text CHARACTER SET utf8 NOT NULL,
  `google` text CHARACTER SET utf8 NOT NULL,
  `twitter` text CHARACTER SET utf8 NOT NULL,
  `phone` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `url_avatar` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

ALTER TABLE `accounts`
  MODIFY `id_acc` int(11) NOT NULL AUTO_INCREMENT

ALTER TABLE `categories`
  MODIFY `id_cate` int(11) NOT NULL AUTO_INCREMENT

CREATE TABLE `images` (
  `id_img` int(11) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `date_uploaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_img`);
ALTER TABLE `images`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `images`
  ADD PRIMARY KEY (`id_img`);
ALTER TABLE `images`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `descr` text COLLATE utf8_unicode_ci NOT NULL,
  `url_thumb` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cate_1_id` int(11) NOT NULL,
  `cate_2_id` int(11) NOT NULL,
  `cate_3_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `date_posted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `website` (`title`, `descr`, `keywords`, `status`) VALUES
('Newspage', '', '', 0)

INSERT INTO `accounts`(`id_acc`, `username`, `password`, `display_name`, `email`, `position`, `status`, `date_created`, `facebook`, `google`, `twitter`, `phone`, `description`, `url_avatar`) VALUES ("","admin","123456","","dattran0318@gmail.com","1","1","","","","","0123456789","","content")

INSERT INTO `accounts`(`id_acc`, `username`, `password`, `display_name`, `email`, `position`, `status`, `date_created`, `facebook`, `google`, `twitter`, `phone`, `description`, `url_avatar`) VALUES 
("","admin1","123456","","dattran0318@gmail.com","1","1","","","","","0123456789","","content"),
("","admin2","123456","","dattran0318@gmail.com","0","1","","","","","0123456789","","content"),
("","admin3","123456","","dattran0318@gmail.com","1","0","","","","","0123456789","","content"),
("","admin4","123456","","dattran0318@gmail.com","0","1","","","","","0123456789","","content"),
("","admin5","123456","","dattran0318@gmail.com","1","0","","","","","0123456789","","content")

INSERT INTO `categories`(`id_cate`, `label`, `url`, `type`, `sort`, `parent_id`, `date_created`) VALUES 
													("","label_1","url1","thu thuat","sap xep","","")

INSERT INTO `categories`(`id_cate`, `label`, `url`, `type`, `sort`, `parent_id`, `date_created`) VALUES 
													("","label_1","url1","thu thuat","sap xep","1",""),
													("","label_1","url1","thu thuat","sap xep","1",""),
													("","label_1","url1","thu thuat","sap xep","2",""),
													("","label_1","url1","thu thuat","sap xep","2",""),
													("","label_1","url1","thu thuat","sap xep","3",""),
													("","label_1","url1","thu thuat","sap xep","4","")

INSERT INTO `posts`(`id_post`, `title`, `descr`, `url_thumb`, `slug`, `keywords`, `body`, `cate_1_id`, `cate_2_id`, `cate_3_id`, `author_id`, `status`, `view`, `date_posted`) VALUES 
("","Hom nay an gi","","","content for you","","","1","2","3","1","0","0",""),
("","Hom nay an gi","","","content for you","","","1","2","2","1","0","0",""),
("","Hom nay an gi","","","content for you","","","2","2","2","1","0","0",""),
("","Hom nay an gi","","","content for you","","","2","2","3","1","0","0",""),
("","Hom nay an gi","","","content for you","","","2","2","3","1","0","0",""),
("","Hom nay an gi","","","content for you","","","2","4","3","1","0","0",""),
("","Hom nay an gi","","","content for you","","","2","3","3","1","0","0",""),
("","Hom nay an gi","","","content for you","","","2","5","3","1","0","0",""),
("","Hom nay an gi","","","content for you","","","3","2","3","1","0","0",""),
("","Hom nay an gi","","","content for you","","","3","1","3","1","0","0",""),
("","Hom nay an gi","","","content for you","","","3","3","4","1","0","0",""),
("","Hom nay an gi","","","content for you","","","3","4","6","1","0","0",""),
("","Hom nay an gi","","","content for you","","","3","5","7","1","0","0",""),
("","Hom nay an gi","","","content for you","","","3","2","2","1","0","0","")