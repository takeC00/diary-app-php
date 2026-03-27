<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/app.php';
require_once BASE_PATH . '/databases/db.php';

class DiaryController
{
    public function index(): void
    {
			global $pdo;

			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
			$page = max($page, 1);

			$perPage = PER_PAGE;

			$countSql = "
				SELECT COUNT(*)
				FROM diaries
				WHERE is_public = 1
			";

			$countStmt = $pdo->query($countSql);
			$totalCount = (int)$countStmt->fetchColumn();

			// ページネーションの全体数
			$totalPages = (int)ceil($totalCount/$perPage);

			// クエリパラメータでページネーション外の値が指定され場合は1ページ目を表示
			if($page > $totalPages){
				$page=1;
			}

			// 表示ページに応じて取得するデータスキップ
			$offset = ($page -1) * $perPage;

			$sql = "
					SELECT
							d.*,
							u.name AS user_name
					FROM diaries d
					INNER JOIN users u ON d.user_id = u.id
					WHERE d.is_public = 1
					ORDER BY d.diary_date DESC
					LIMIT :limit
					OFFSET :offset
			";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
			$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
			$stmt->execute();

			$diaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

			require __DIR__ . '/../views/diaries/index.php';
    }
}
