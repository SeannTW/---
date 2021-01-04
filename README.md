## 簡介

這是一套使用 Laravel 框架所製作的留言板，提供了簡單的留言功能、回覆留言功能。
- 語言 PHP 7.4
- 框架 Laravel 6.0

## 如何使用？

1. 下載這份專案至您的環境中。
2. 複製 `.env.example` 這個檔案，並更改檔名為 `.env` 。
3. 打開 `.env` 將資料庫 (DB_DATABASE..等) 依環境設定完畢。
4. 進入 `database` 建立對應的資料庫名。
4. 打開 `終端機` 進入該專案位置底下
5. 執行 `composer install`。
6. 執行 `php artisan key:generate`。
7. 執行 `php artisan migrate`。
8. 進入該專案 public 入口，開始使用留言板 !
