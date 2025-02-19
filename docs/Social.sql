CREATE DATABASE IF NOT EXISTS Social;
USE Social;

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `role` varchar(20) NOT NULL,
    `name` varchar(100) NOT NULL,
    `surname` varchar(200) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `image` varchar(255) DEFAULT NULL,
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
    `image_id` varchar(255),
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


INSERT INTO `users` (`role`, `name`, `surname`, `email`, `password`, `image`, `created_at`, `updated_at`, `remember_token`) VALUES
('admin', 'Juan', 'Pérez', 'juan.perez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/juan.jpg', '2023-10-01 10:00:00', '2023-10-01 10:00:00', 'token1'),
('user', 'María', 'Gómez', 'maria.gomez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/maria.jpg', '2023-10-02 11:00:00', '2023-10-02 11:00:00', 'token2'),
('user', 'Carlos', 'López', 'carlos.lopez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/carlos.jpg', '2023-10-03 12:00:00', '2023-10-03 12:00:00', 'token3'),
('admin', 'Ana', 'Martínez', 'ana.martinez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/ana.jpg', '2023-10-04 13:00:00', '2023-10-04 13:00:00', 'token4'),
('user', 'Luis', 'Rodríguez', 'luis.rodriguez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/luis.jpg', '2023-10-05 14:00:00', '2023-10-05 14:00:00', 'token5'),
('user', 'Laura', 'Fernández', 'laura.fernandez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/laura.jpg', '2023-10-06 15:00:00', '2023-10-06 15:00:00', 'token6'),
('admin', 'Pedro', 'Sánchez', 'pedro.sanchez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/pedro.jpg', '2023-10-07 16:00:00', '2023-10-07 16:00:00', 'token7'),
('user', 'Sofía', 'Díaz', 'sofia.diaz@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/sofia.jpg', '2023-10-08 17:00:00', '2023-10-08 17:00:00', 'token8'),
('user', 'Miguel', 'Hernández', 'miguel.hernandez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/miguel.jpg', '2023-10-09 18:00:00', '2023-10-09 18:00:00', 'token9'),
('admin', 'Elena', 'Ruiz', 'elena.ruiz@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '/images/elena.jpg', '2023-10-10 19:00:00', '2023-10-10 19:00:00', 'token10');

INSERT INTO `images` (`user_id`, `image_path`, `description`, `created_at`, `updated_at`) VALUES
(1, '/images/juan.jpg', 'Foto de perfil de Juan Pérez', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(2, '/images/maria.jpg', 'Foto de perfil de María Gómez', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(3, '/images/carlos.jpg', 'Foto de perfil de Carlos López', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(4, '/images/ana.jpg', 'Foto de perfil de Ana Martínez', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(5, '/images/luis.jpg', 'Foto de perfil de Luis Rodríguez', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(6, '/images/laura.jpg', 'Foto de perfil de Laura Fernández', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(7, '/images/pedro.jpg', 'Foto de perfil de Pedro Sánchez', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(8, '/images/sofia.jpg', 'Foto de perfil de Sofía Díaz', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(9, '/images/miguel.jpg', 'Foto de perfil de Miguel Hernández', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(10, '/images/elena.jpg', 'Foto de perfil de Elena Ruiz', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `comments` (`user_id`, `image_id`, `content`, `created_at`, `updated_at`)
VALUES
    (1, 1, 'Comentario del usuario 1 para la imagen 1', NOW(), NOW()),
    (2, 2, 'Comentario del usuario 2 para la imagen 2', NOW(), NOW()),
    (3, 3, 'Comentario del usuario 3 para la imagen 3', NOW(), NOW()),
    (4, 4, 'Comentario del usuario 4 para la imagen 4', NOW(), NOW()),
    (5, 5, 'Comentario del usuario 5 para la imagen 5', NOW(), NOW()),
    (6, 6, 'Comentario del usuario 6 para la imagen 6', NOW(), NOW()),
    (7, 7, 'Comentario del usuario 7 para la imagen 7', NOW(), NOW()),
    (8, 8, 'Comentario del usuario 8 para la imagen 8', NOW(), NOW()),
    (9, 9, 'Comentario del usuario 9 para la imagen 9', NOW(), NOW()),
    (10, 10, 'Comentario del usuario 10 para la imagen 10', NOW(), NOW());

INSERT INTO `likes` (`user_id`, `image_id`, `created_at`, `updated_at`)
VALUES
    (1, 1, NOW(), NOW()),
    (2, 2, NOW(), NOW()),
    (3, 3, NOW(), NOW()),
    (4, 4, NOW(), NOW()),
    (5, 5, NOW(), NOW()),
    (6, 6, NOW(), NOW()),
    (7, 8, NOW(), NOW()),
    (8, 8, NOW(), NOW()),
    (9, 9, NOW(), NOW()),
    (10, 10, NOW(), NOW());