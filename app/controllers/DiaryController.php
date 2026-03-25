<?php

declare(strict_types=1);

class DiaryController
{
    public function index(): void
    {
        $diaries = [
            [
                'id' => 1,
                'title' => 'はじめての投稿',
                'body' => '今日は写真日記アプリの一覧画面を作成した。',
                'image' => 'https://via.placeholder.com/150',
                'created_at' => '2026-03-25',
            ],
            [
                'id' => 2,
                'title' => 'MAMPで動作確認',
                'body' => 'MAMP上でPHPアプリが動いた。',
                'image' => 'https://via.placeholder.com/150',
                'created_at' => '2026-03-24',
            ],
        ];

        require_once __DIR__ . '/../views/diaries/index.php';
    }
}
