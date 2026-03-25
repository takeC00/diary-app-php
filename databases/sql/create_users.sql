DROP TABLE users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (id,name,email,icon,introduction,remember_token,password,created_at,updated_at) VALUES
(1,'田中テスト','sample@gmail.com','/images/icon.png', '', '', '', now(),now()),
(2,'鈴木テスト','sample@+1gmail.com','/images/icon.png', '', '', '', now(),now()),
(3,'山田テスト','sample@+2gmail.com','/images/icon.png', '', '', '', now(),now()),
(4,'服部テスト','sample@+3gmail.com','/images/icon.png', '', '', '', now(),now()),
(5,'金子テスト','sample@+4gmail.com','/images/icon.png', '', '', '', now(),now());
