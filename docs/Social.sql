CREATE DATABASE IF NOT EXISTS Social;
USE Social;

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `role` varchar(20) NOT NULL,
    `name` varchar(100) NOT NULL,
    `surname` varchar(200) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL,
    `created_at` datetime,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `remember_token` varchar(255)
) engine=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `images` (
    `id` int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id` int(255) NOT NULL,
    `image_path` varchar(255),
    `description` text,
    `created_at` datetime,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES users (`id`) ON DELETE CASCADE
) engine=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `comments` (
    `id` int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id` int(255) NOT NULL,
    `image_path` varchar(255),
    `content` varchar(255),
    `created_at` datetime,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES users (`id`) ON DELETE CASCADE
)engine=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `likes` (
`id` int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
`user_id` int(255) NOT NULL,
`image_id` int(255) NOT NULL,
`created_at` datetime,
`updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (`user_id`) REFERENCES users (`id`) ON DELETE CASCADE
)engine=InnoDB DEFAULT CHARSET=utf8;
