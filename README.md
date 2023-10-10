# Atte

【概要】ある企業の勤怠管理システム

【イメージ】

<img width="747" alt="打刻画面" src="https://github.com/magmag6240/project-atte/assets/139316621/47acea01-ac65-45ea-b04d-b795c95cdd7e">


## 作成した目的
【背景と目的】人事評価のため

## 機能一覧

| 項目 | 注意点 |
| ---- | ---- |
| 会員登録 | Laravelの認証機能を利用 |
| ログイン | Laravelの認証機能を利用 |
| ログアウト | Laravelの認証機能を利用 |
| 勤務開始 | 日を跨いだ時点で翌日の出勤操作に切り替える |
| 勤務終了 | 日を跨いだ時点で翌日の出勤操作に切り替える |
| 休憩開始 | 1日で何度も休憩が可能 |
| 休憩終了 | 1日で何度も休憩が可能 |
| 日付別勤怠情報取得 | 検索機能付き |
| ページネーション | 5件ずつ取得 |
| メールアドレス認証 | 会員登録時にメールアドレス認証を行う |
| ユーザー一覧 | 管理者としてログインした場合のみ表示 |
| ユーザー検索 | 管理者としてログインした場合のみ表示 |
| ユーザー削除 | 管理者としてログインした場合、退職時などのユーザー管理が行える |
| ユーザーへの役職付与 | 管理者としてログインした場合、ユーザー一覧からroleの更新が可能 |

## 使用技術
* PHP v7.4.9-fpm
* Laravel v8.83.27
* Docker Desktop v4.22.1
* docker-compose v3.8
* nginx 1.21.1
* mySQL 8.0.26

## テーブル設計

<img width="686" alt="テーブル設計" src="https://github.com/magmag6240/project-atte/assets/139316621/f36a408b-538f-4a89-94ac-18c19c891dbd">


## ER図

<img width="558" alt="project-atte ER" src="https://github.com/magmag6240/project-atte/assets/139316621/fae7b845-2523-48a1-9ca6-c11551d4c1ce">


# 環境構築

## git clone

先にコピーを保存したいディレクトリに移動してから以下のコマンドを実行します。

`$ git clone git@github.com:magmag6240/project-atte.git`

これでLaravelプロジェクトがローカル環境にクローンされました。

## vendorディレクトリを作る
以下のコマンドを実行してください。

`$ composer install`

composer.lock, composer.jsonに書かれた情報を基にパッケージやライブラリがまとめてインストールされ、vendorディレクトリに配置されます。

## .envファイルを作る
git cloneしてきたプロジェクトに入っている.env.exampleというファイルを基に以下のコマンド実行で.envファイルを作成します。

`$ cp .env.example .env`

## アプリケーションキーを初期化する
以下のコマンドで初期化を行います。

`$ php artisan key:generate`

## 動作確認
ブラウザに表示する準備は整いました。
以下のコマンド実行で、動作確認を行ってください。

`$ php artisan serve`

## テストユーザー
* ダミーユーザー：98人
* 使用ユーザー：2人

| id | name | role | email | password |
| ---- | ---- | ---- | ---- | ---- |
| 99 | 五条 悟 | admin | satoru.gojyo@example.com | 1qaz2wsx |
| 100 | 夏油 傑 | general | suguru.geto@example.com | 1qaz2wsx |
