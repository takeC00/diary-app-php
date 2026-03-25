<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/app.php';
require_once BASE_PATH . '/databases/db.php';

class DiaryController
{
    public function index(): void
    {
			global $pdo;

			$sql = "
					SELECT
							d.*,
							u.name AS user_name
					FROM diaries d
					INNER JOIN users u ON d.user_id = u.id
					WHERE d.is_public = 1
					ORDER BY d.diary_date DESC
			";

			$stmt = $pdo->query($sql);
			$diaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

			require __DIR__ . '/../views/diaries/index.php';
    }
}
