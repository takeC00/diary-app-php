<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>写真日記一覧</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 960px;
            margin: 40px auto;
        }

        .page-title {
            margin-bottom: 24px;
        }

        .diary-list {
            display: grid;
            gap: 16px;
        }

        .diary-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .diary-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
            margin-bottom: 12px;
        }

        .diary-title {
            font-size: 20px;
            margin: 0 0 8px;
        }

        .diary-date {
            font-size: 14px;
            color: #777;
            margin-bottom: 12px;
        }

        .diary-body {
            margin: 0;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-title">写真日記一覧</h1>

        <div class="diary-list">
            <?php foreach ($diaries as $diary): ?>
                <article class="diary-card">
                    <img
                        src="<?= htmlspecialchars($diary['image'], ENT_QUOTES, 'UTF-8'); ?>"
                        alt="日記画像"
                        class="diary-image"
                    >

                    <h2 class="diary-title">
                        <?= htmlspecialchars($diary['title'], ENT_QUOTES, 'UTF-8'); ?>
                    </h2>

                    <div class="diary-date">
                        投稿日: <?= htmlspecialchars($diary['created_at'], ENT_QUOTES, 'UTF-8'); ?>
                    </div>

                    <p class="diary-body">
                        <?= nl2br(htmlspecialchars($diary['body'], ENT_QUOTES, 'UTF-8')); ?>
                    </p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
