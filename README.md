## 概要
・Diary App (Pure PHP)
Laravel版からフレームワークを使わずに再実装したプロジェクト
https://github.com/takeC00/diary-app-laravel
(laravel版リポジトリ)

## 機能一覧

### 認証機能
- ユーザー登録
- ログイン
- ログアウト

### 日記機能（ログインユーザー）
- 自分の日記一覧
- 日記作成
- 日記編集
- 日記削除

### 公開機能
- 公開日記一覧
- 公開日記詳細表示

## 技術
- PHP（フレームワークなし）
- MariaDB
- Apache
- Docker / Docker Compose（ローカル開発）

## 目的
- Laravelをはじめフレームワークを使用せず、一つ一つ自らコーディングすることで学習効果を高める。
- フレームワークを使わずに実現する方法を学ぶ。

---

## Dev Container で開発（VS Code）

VS Code の [Dev Containers](https://containers.dev/) 拡張機能を使うと、エディタ内でコンテナ環境を開いて開発できます。コード変更はボリュームマウントで即時反映されます。

### 前提条件

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) をインストール済みであること
- VS Code に **Dev Containers** 拡張機能が入っていること

### 手順

1. リポジトリを clone してフォルダを開く
2. コマンドパレット（`Cmd+Shift+P` / `Ctrl+Shift+P`）で **「Dev Containers: Reopen in Container」** を実行
3. 初回はイメージのビルドに数分かかることがあります
4. コンテナ起動後、ブラウザでアプリにアクセス

| 画面 | URL |
|------|-----|
| 公開日記一覧 | http://localhost:8080/ |
| ログイン | http://localhost:8080/login |
| 新規登録 | http://localhost:8080/register |

※ Dev Container ではコンテナの **80** 番がホストの **8080** に転送されます（`devcontainer.json` の `hostPort: 8080`）。8080 が使えない場合は VS Code の **「ポート」** タブに表示される URL（例: `http://localhost:55576`）でもアクセスできます。

### Dev Container 構成

| 項目 | 内容 |
|------|------|
| 開発用イメージ | `docker/dev/Dockerfile`（git / mariadb-client 付き） |
| Compose | `.devcontainer/docker-compose.yml` |
| 作業ディレクトリ | `/var/www/html`（web コンテナ） |
| DB 接続（コンテナ内） | `mysql -h db -u root -proot diary_app_php` |

### ログイン（テストユーザー）

| メール | パスワード |
|--------|------------|
| `sample@gmail.com` | `pass1234` |

### トラブルシューティング

| 症状 | 対処 |
|------|------|
| `port is already allocated`（3307 / 8080） | 先に `docker compose down` で通常の Compose コンテナを停止してから Dev Container を起動する（**両方同時には使えません**） |
| `ENOENT: scandir` / 起動に失敗する | ① ターミナルで `docker compose -f .devcontainer/docker-compose.yml down -v` ② VS Code で **Rebuild Container** |
| Reopen しても開けない | コマンドパレット → **「Dev Containers: Attach to Running Container」** → `diary-app-php_devcontainer-web-1` を選択 |
| アプリの URL | VS Code の「ポート」タブで `80` の転送先 URL を開く |

---

## ローカル環境構築手順（Docker）

MAMP などは不要です。**Docker Desktop** があれば、誰でも同じ環境を構築できます。

### 前提条件

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) をインストール済みであること
- Docker Desktop が起動していること

### 1. リポジトリを取得

```bash
git clone https://github.com/takeC00/diary-app-php.git
cd diary-app-php
```

既に clone 済みの場合:

```bash
git pull
```

### 2. コンテナを起動

```bash
docker compose up -d --build
```

初回はイメージのダウンロードとビルドに数分かかることがあります。

### 3. 動作確認

ブラウザで以下にアクセスします。

| 画面 | URL |
|------|-----|
| 公開日記一覧 | http://localhost:8080/ |
| ログイン | http://localhost:8080/login |
| 新規登録 | http://localhost:8080/register |

一覧に日記が表示されれば構築成功です。

### 4. ログイン方法

初期データとしてテストユーザーが投入されています（例: `sample@gmail.com`）。

ログインするには、次のいずれかを行ってください。

- **新規登録**（`/register`）でアカウントを作成する（推奨）
- テストユーザーでログインする（パスワードは Laravel 版リポジトリのシードと同じ）

### よく使うコマンド

```bash
# 起動
docker compose up -d

# 停止
docker compose down

# ログ確認
docker compose logs -f

# コード変更後に再ビルドして反映
docker compose up -d --build

# DB を含めて完全リセット（データが消えます）
docker compose down -v
docker compose up -d --build
```

### 構成

| サービス | 説明 | ホスト側ポート |
|----------|------|----------------|
| web | PHP 8.2 + Apache | 8080 |
| db | MariaDB 10.11 | 3307 |

- DB 名: `diary_app_php`
- DB ユーザー / パスワード: `root` / `root`
- 初回起動時に `databases/sql/` の SQL が自動実行され、テーブルとサンプルデータが投入されます

### トラブルシューティング

| 症状 | 対処 |
|------|------|
| ポート 8080 が使えない | `docker-compose.yml` の `8080:80` を別ポート（例: `8888:80`）に変更 |
| DB 接続エラー | `docker compose down -v` のあと `docker compose up -d --build` で再作成 |
| 画像が表示されない | `docker compose up -d --build` で Web コンテナを再ビルド |
| 画像アップロード失敗 | 10MB 以下の画像を使用。変更後は `docker compose up -d --build` |

---

## ER図

<img width="200" height="400" alt="ER図" src="https://github.com/user-attachments/assets/c62e7d7b-090d-4598-957f-854a1875b357" />

---

## 画面遷移図

<img width="200" height="400" alt="Image" src="https://github.com/user-attachments/assets/2eeebd49-4588-41d2-aa0f-6fe3225441bd" />
---
