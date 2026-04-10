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
(1,'田中テスト','sample@gmail.com',  '/images/defaults/icon_1.jpeg','都内で働く会社員です。休日はカフェ巡りや写真撮影を楽しんでいます。日々の出来事や感じたことを気ままに記録しています。よろしくお願いします。','', '$2y$10$.ZNZZCdLRUikOO/UCeYMK.fJEK5YuxGWmbBUO.Gbw9HadbmRlTlGu', now(),now()),
(2,'鈴木テスト','sample@+1gmail.com','/images/defaults/icon_1.jpeg','趣味は映画鑑賞とランニングです。新しいことに挑戦するのが好きで、最近は料理にもハマっています。日常のちょっとした出来事を書いていきます。','', '$2y$10$.ZNZZCdLRUikOO/UCeYMK.fJEK5YuxGWmbBUO.Gbw9HadbmRlTlGu', now(),now()),
(3,'山田テスト','sample@+2gmail.com','/images/defaults/icon_1.jpeg','アウトドアが好きで、キャンプや登山によく出かけています。自然の中で感じたことや、日々の生活での気づきを日記として残しています。','', '$2y$10$.ZNZZCdLRUikOO/UCeYMK.fJEK5YuxGWmbBUO.Gbw9HadbmRlTlGu', now(),now()),
(4,'服部テスト','sample@+3gmail.com','/images/defaults/icon_1.jpeg','エンジニアとして働いています。プログラミングや新しい技術に触れるのが好きで、日々の学びや出来事を記録しています。気軽に読んでください。','', '$2y$10$.ZNZZCdLRUikOO/UCeYMK.fJEK5YuxGWmbBUO.Gbw9HadbmRlTlGu', now(),now()),
(5,'金子テスト','sample@+4gmail.com','/images/defaults/icon_1.jpeg','旅行とグルメが大好きです。各地で出会った美味しいものや景色を日記に残しています。ゆるく更新していくので、気軽に見てもらえると嬉しいです。','', '$2y$10$.ZNZZCdLRUikOO/UCeYMK.fJEK5YuxGWmbBUO.Gbw9HadbmRlTlGu', now(),now());
