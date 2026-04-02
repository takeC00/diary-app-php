<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/app.php';
require_once BASE_PATH . '/databases/db.php';
require_once BASE_PATH . '/app/helpers/auth.php';

class DiaryController
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

		public function show($id): void
    {
			requireLogin();
			global $pdo;

			$sql = "
				SELECT
					d.*,
					u.name AS user_name,
					u.id AS user_id
				FROM diaries d
				INNER JOIN users u ON d.user_id = u.id
				WHERE d.id = :id
			";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			$diary = $stmt->fetch(PDO::FETCH_ASSOC);

			require __DIR__ . '/../views/diaries/show.php';
    }
		public function editPage($id): void
    {
			requireLogin();
			global $pdo;

			$sql = "
				SELECT
					d.*,
					u.name AS user_name,
					u.id AS user_id
				FROM diaries d
				INNER JOIN users u ON d.user_id = u.id
				WHERE d.id = :id
			";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			$diary = $stmt->fetch(PDO::FETCH_ASSOC);

			require __DIR__ . '/../views/diaries/edit.php';
    }

		public function edit($id): void
    {
			requireLogin();
			global $pdo;

			// 更新SQL
			$title = $_POST['title'] ?? '';
			$diary_date = $_POST['diary_date'] ?? '';
			$diary_image = $_POST['diary_image'] ?? '';

			$sql = "
				UPDATE diaries d
				SET
					title = :title,
					diary_date = :diary_date,
					image = :diary_image
				WHERE d.id = :id
			";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->bindValue(':title', $title, PDO::PARAM_STR_CHAR);
			$stmt->bindValue(':diary_date', $diary_date, PDO::PARAM_STR_CHAR);
			$stmt->bindValue(':diary_image', $diary_image, PDO::PARAM_STR_CHAR);
			$stmt->execute();

			// 画面表示SQL
			$sql = "
				SELECT
					d.*,
					u.name AS user_name,
					u.id AS user_id
				FROM diaries d
				INNER JOIN users u ON d.user_id = u.id
				WHERE d.id = :id
			";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			$diary = $stmt->fetch(PDO::FETCH_ASSOC);

			$_SESSION['success'] = "更新しました";
			require __DIR__ . '/../views/diaries/show.php';
    }
}
