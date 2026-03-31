<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/app.php';
require_once BASE_PATH . '/databases/db.php';

class LoginController
{
    public function showLogin(): void
    {
        require BASE_PATH . '/app/views/auth/login.php';
    }

    public function login(): void
    {
				global $pdo;
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $email = trim($email);
        $password = trim($password);

        if ($email === '') {
            $_SESSION['error']['email'] = 'メールアドレスを入力してください。';
        }
				if ($password === '') {
					$_SESSION['error']['password'] = 'パスワードを入力してください。';
				}
				if(!empty($_SESSION['error'])){
					header('Location: /login');
					exit;
				}

        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'][] = 'メールアドレスまたはパスワードが違います。';
						$_SESSION['old']['email'] = $email;
            header('Location: /login');
            exit;
        }

        $_SESSION['user'] = [
            'id' => (int)$user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ];

				unset($_SESSION['old']);
        header('Location: /');
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        header('Location: /login');
        exit;
    }

		public function showRegister(): void
    {
			require BASE_PATH . '/app/views/auth/register.php';
		}

		public function register(): void
    {
			$_SESSION['error'] = [];

			global $pdo;
			$name = $_POST['name'] ?? '';
			$email = $_POST['email'] ?? '';
			$password = $_POST['password'] ?? '';
			$rePassword = $_POST['rePassword'] ?? '';

			$name = trim($name);
			$email = trim($email);
			$password = trim($password);
			$rePassword = trim($rePassword);

			//入力値保持
			$_SESSION['old']['name'] = $name;
			$_SESSION['old']['email'] = $email;

			// バリデーション
			if ($name === '') {
				$_SESSION['error']['name'] = '名前は必須です。';
			}
			if ($email === '') {
				$_SESSION['error']['email'] = 'メールアドレスは必須です。';
			}
			if ($password === '') {
				$_SESSION['error']['password'] = 'パスワードは必須です。';
			}
			if ($rePassword === '') {
				$_SESSION['error']['rePassword'] = 'パスワード(確認)は必須です。';
			}

			// メアド重複
			$sql = "SELECT email FROM users Where email = :email";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':email', $email, PDO::PARAM_STR);
			$stmt->execute();
			$dbEmail = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!empty($dbEmail)){
				$_SESSION['error']['email'] = '入力のメアドは既に使用されています';
			}


			// パスワード不一致


			if(!empty($_SESSION['error'])){
				header('Location: /register');
				exit;
			}

			unset($_SESSION['old']);
		}
}
