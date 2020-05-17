# 環境構築手順
- PHP7.4
- Laravel6.8
- Mysql8.0
- phpMyAdmin
- nginx
- Docker

### sshでgit clone

```
git clone git@gitlab.com:re_build-bootcamp/1-term-B.git

cd 1-term-B

// developブランチを作り移動する
git checkout -b develop

// GitLabのdevelopブランチを取り込む
git pull origin develop
```

### developブランチで環境構築する

```
cd infrastructure

make create-project
```
Makefileファイルにdocker-composeコマンドをまとめており、`make create-project`コマンドでコンテナの起動から
Laravelプロジェクト作成、ライブラリのインストールまで行っています。

```
make install-recommend-packages
```
上記で開発に便利なライブラリをインストールして使えるようにしています。(講義で出てきたDebugbarなど)

ここで、ecsiteディレクトリ(Laravelプロジェクト)とinfrastructureディレクトリ(docker関連のフォルダ)になっていればOKです。
- - -
### コンテナ接続
```
PHPを実行しているコンテナ。`php artisan`コマンドなどLaravelプロジェクトに変更を行う時はこのコンテナ内で行う
docker-compose exec app bash
```

- - -
## 認証機能実装
appコンテナ内でコマンドを順に実行していく
```
composer require laravel/ui 1.*

php artisan ui vue --auth

```
次に、package.jsonを開き、sass-loaderのバージョンを変更する。
Laravel Mixのバージョンとの互換性を合わせないと`npm run dev`を実行した際にエラーになる

`"sass-loader": "^8.0.0" => "sass-loader": "^7.3.1"`に変更

npm installでnode_modulesファイルにフロントエンドで使用するパッケージがインストールされます。
```
npm install

npm run dev
```
上記を実行後 [localhost](http://localhost:80)にアクセスすると認証機能ができている

### URL
- [localhost](http://localhost:80)
- [phpMyadmin](http:localhost:8888) user名:root pass:secret
- [mailhog](http://localhost:8025)