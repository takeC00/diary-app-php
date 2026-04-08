<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/app.php';
require_once BASE_PATH . '/databases/db.php';
require_once BASE_PATH . '/app/helpers/auth.php';

class MyPageController
{
	public function show($id): void
	{
		requireLogin();
		global $pdo;

		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
		$page = max($page, 1);

		$perPage = PER_PAGE;

		if($id !== $_SESSION['user']['id']){
			$countSql = "
				SELECT COUNT(*)
				FROM diaries
				WHERE is_public = 1
				AND user_id = :id
			";
		}else{
			$countSql = "
				SELECT COUNT(*)
				FROM diaries
				WHERE user_id = :id
			";
		}

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

		if($id !== $_SESSION['user']['id']){
			$sql = "
				SELECT
						d.*,
						u.name,
						u.icon,
						u.introduction
				FROM diaries d
				INNER JOIN users u ON d.user_id = u.id
				WHERE d.is_public = 1
				AND u.id = :id
				ORDER BY d.diary_date DESC
				LIMIT :limit
				OFFSET :offset
			";
		}else{
			$sql = "
				SELECT
						d.*,
						u.name,
						u.icon,
						u.introduction
				FROM diaries d
				INNER JOIN users u ON d.user_id = u.id
				WHERE u.id = :id
				ORDER BY d.diary_date DESC
				LIMIT :limit
				OFFSET :offset
			";
		}

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();

		$diaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($id !== $_SESSION['user']['id']){
			require __DIR__ . '/../views/myPage/show.php';
		}else{
			require __DIR__ . '/../views/myPage/edit.php';
		}

	}

	public function edit($id): void
	{
		requireLogin();
		global $pdo;

		$introduction = trim($_POST['introduction'] ?? '');

		// 既存ユーザー取得
		$sql = "
			SELECT *
			FROM users
			WHERE id = :id
		";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!$user) {
			header('Location: /myPage');
			exit;
		}

		// アイコン画像アップロード
		if (!empty($_FILES['icon']['name'])) {
			$file = $_FILES['icon'];

			if ($file['error'] !== UPLOAD_ERR_OK) {
				$_SESSION['error']['common'] = 'アイコン画像のアップロードに失敗しました。';
				header('Location: /myPage');
				exit;
			}

			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$fileName = uniqid() . '.' . $ext;

			$uploadDir = BASE_PATH . '/public/images/uploads/';
			$savePath = $uploadDir . $fileName;

			if (!move_uploaded_file($file['tmp_name'], $savePath)) {
				$_SESSION['error']['common'] = 'アイコン画像の保存に失敗しました。';
				header('Location: /myPage');
				exit;
			}

			$iconPath = '/images/uploads/' . $fileName;
		} else {
			$iconPath = $user['icon'];
		}

		$sql = "
			UPDATE users
			SET
				introduction = :introduction,
				icon = :icon
			WHERE id = :id
		";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->bindValue(':introduction', $introduction, PDO::PARAM_STR);
		$stmt->bindValue(':icon', $iconPath, PDO::PARAM_STR);
		$stmt->execute();

		$_SESSION['success'] = "更新しました";
		header("Location: /myPage/" . $_SESSION['user']['id']);
		exit;
	}
}
