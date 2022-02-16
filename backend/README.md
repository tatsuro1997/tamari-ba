## Tamari-Ba

## ダウンロード方法

git clone
cd /Applications/MAMP/htdocs
git clone git@github.com:tatsuro1997/tamari-ba.git

git clone ブランチを指定してダウンロードする場合
git clone ブランチ名 git@github.com:tatsuro1997/tamari-ba.git


## インストール方法

```php
cd tamari-ba/backend
# php artisan コマンドろ使えるようにする
composer install

##インターベンションイメージを使えるようにする
composer require intervention/image

##シンボリックリンクを張り、public/storageから画像にアクセス
php artisan storage:link

## Swiperをインストール
npm install swiper@6.7.0
npm run dev

cp .env.example .env
php artisan key:generate
cd ..  # tamari-baに移動

docker-compose up -d --build
```


.envファイルの中身は下記をご利用の環境に合わせて変更してください。


MAMPまたは他の開発環境でDBを起動した後に

docker-compose exec app bash
php artisan migrate:fresh --seed

と実行してください。（データベーステーブルとダミーデータが追加されえばOK）

docker-compose up -d --build
で簡易サーバーを立ち上げ、表示確認してください。

## コマンド
  本番用DB
db:
  docker-compose exec db /bin/bash

## テスト環境
テストDBように.envをコピーし、.env.testingを作成してください

テストDBでコマンドを実行する場合は、--env=testingのオプションを選択してください。

  テスト用DB
test_db:
  docker-compose exec db-test /bin/bash

mysql:
  mysql -u root -p

### テスト実行方法
キャッシュのクリア
  php artisan config:clear
  php artisan migrate:fresh --seed --env=testing

すべてのテストを実行
  vendor/bin/phpunit
  php artisan test

ファイルを指定してテストを実行する
  vendor/bin/phpunit tests/Feature/UserTest.php

## 本番環境（Heroku）

### DB確認
mysql -u DB_USERNAME -h DB_HOSTNAME -pDB_PASSWORD


## ブランチ
mainブランチからdevelopブランチを切り、開発したものはdevelopにマージする。
各Issueはdevelopブランチから切ることとする。
ブランチ名は、feature/{issue/number} で統一する。


## 参考
[ドキュメント](https://qiita.com/hiroto_husqy/items/f87ca0bdb4b23f0449e9)
[GitHub](https://github.com/Hiroto-Iizuka/Tamari-Ba)
