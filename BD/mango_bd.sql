SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

create schema if not exists `mango` default character set utf8;
use `mango`;

create table if not exists `mango`.`root`(
	`root_ID` int unsigned not null auto_increment,
    `user` VARCHAR(10) not null,
    `password` VARCHAR(45) not null,
    `permission` tinyint(1) not null,
    primary key (`root_ID`),
    unique index `user_UNIQUE` (`user` asc)
);
create table if not exists `mango`.`user`(
	`user_ID` int unsigned not null auto_increment,
    `nickname` VARCHAR(15) not null,
    `password` VARCHAR(45) not null,
    `email` VARCHAR(80) default null,
    `status` ENUM('active', 'not active', 'verified' ,'deleted') default 'not active',
    `description` VARCHAR(100) default null,
    primary key (`user_ID`),
    unique index `nickname_UNIQUE` (`nickname` asc)
);
create table if not exists `mango`.`email_verification`(
    `email_verification_ID` int unsigned not null auto_increment,
    `user_ID` int not null,
    `token` VARCHAR(100) not null,
    primary key (`email_verification_ID`)
);
create table if not exists `mango`.`type_post`(
    `type_post_ID` int unsigned not null auto_increment,
    `type_name` VARCHAR(20) not null,
    `alternative_name` VARCHAR(20) not null,
    `icon` VARCHAR(70) default null,
    primary key (`type_post_ID`)
);

create table if not exists `mango`.`post`(
	`post_ID` int unsigned not null auto_increment,
    `title` VARCHAR(50) not null,
    `body` VARCHAR(280) not null,
    `like` mediumint(5) default 0,
    `unlike` mediumint(5) default 0,
    `date` date not null,
    `time` time not null,
    `type` int unsigned not null,
    `user_ID` int unsigned not null,
    primary key (`post_ID`),
    index `fk_post_user_idx` (`user_ID` asc),
    index `fk_post_type` (`type` asc),
    constraint `fk_post_user`
		foreign key (`user_ID`)
        references `mango`.`user` (`user_ID`)
        on delete cascade
        on update no action,
    constraint `fk_post_type`
        foreign key (`type`)
        references `mango`.`type_post` (`type_post_ID`)
        on delete no action
        on update no action
);

create table `mango`.`comment`(
	`comment_ID` int unsigned not null auto_increment,
    `user_ID` int unsigned not null,
	`post_ID` int unsigned not null,
    `body` VARCHAR(280) not null,
    `like` mediumint(5) default 0,
    `unlike` mediumint(5) default 0,
    primary key (`comment_ID`),
    index `fk_comment_post_idx` (`post_ID` asc),
    index `fk_comment_user_idx` (`user_ID` asc),
    constraint `fk_comment_post`
		foreign key (`post_ID`)
        references `mango`.`post` (`post_ID`)
        on delete cascade
        on update no action,
	constraint `fk_comment_user`
		foreign key (`user_ID`)
        references `mango`.`user` (`user_ID`)
        on delete cascade
        on update no action
);
create table `mango`.`post_interaction`(
    `interaction_ID` int unsigned not null auto_increment,
    `user_ID` int unsigned not null,
    `post_ID` int unsigned not null,
    `like_unlike` ENUM ('like', 'unlike', 'nothing') default 'nothing',
    `comment` TINYINT(1) default 0,
    primary key(`interaction_ID`),
    index `fk_post_interaction_user_idx` (`user_ID` asc),
    index `fk_post_interaction_post_idx` (`post_ID` asc),
    unique index `post_interaction_UNIQUE` (`user_ID`,`post_ID`),
    constraint `fk_post_intercation_user`
        foreign key (`user_ID`)
        references `mango`.`user` (`user_ID`)
        on delete cascade
        on update no action,
    constraint `fk_post_intercation_post`
        foreign key (`post_ID`)
        references `mango`.`post` (`post_ID`)
        on delete cascade
        on update no action
);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

insert into root (user, password, permission) values ('vyN', md5('@MyMango157'), 0);
insert into user (nickname, password) values ('Kevin', md5('@KevinTheCreator'));
insert into type_post (type_post_ID, type_name, alternative_name, icon) values 
(0, 'light', 'Postshit', '<i class="fas fa-location-arrow text-dark"></i>'),
(1, 'warning', 'Aviso', '<i class="fas fa-exclamation text-dark"></i>'),
(2, 'info', 'Informativo', '<i class="fas fa-info-circle text-dark"></i>'),
(3, 'primary', 'AD', '<i class="fas fa-audio-description text-dark"></i></i>'),
(4, 'danger', 'Perigo', '<i class="fas fa-exclamation-triangle text-dark"></i>')
;
insert into post (title, body, type, user_ID, date, time) values 
('este é 1', 'este é o corpo do 1 warning',1, 1, '2020-03-12', '08:12:00'),
('este é 2', 'este é o corpo do 2 info',3, 1, '2020-03-12', '08:13:00'),
('este é 3', 'este é o corpo do 3 normal',2, 1, '2020-03-12', '08:12:00');