<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/app.php';
require_once BASE_PATH . '/databases/db.php';
require_once BASE_PATH . '/app/helpers/auth.php';

class MyDiaryController
{
    public function index(): void
    {
			requireLogin();
			global $pdo;

			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
			$page = max($page, 1);

			$perPage = PER_PAGE;

			$countSql = "
				SELECT COUNT(*)
				FROM diaries d
				WHERE user_id = :id
			";

			$id = $_SESSION['user']['id'];

			$countStmt = $pdo->prepare($countSql);
			$countStmt->bindValue(':id', $id, PDO::PARAM_INT);
			$countStmt->execute();
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
					WHERE user_id = :id
					ORDER BY d.diary_date DESC
					LIMIT :limit
					OFFSET :offset
			";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
			$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
			$stmt->execute();

			$diaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
			require __DIR__ . '/../views/myDiaries/index.php';
    }
}
