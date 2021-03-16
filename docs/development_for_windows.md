# 環境構築 for Windows

## 環境変数でPATH設定

```txt
C:\php73
C:\mysql56\bin
C:\Apache24\bin
C:\Composer\bin
```

## Apche2.4

- [Download](https://www.apachelounge.com/download/)
  - [Apache 2.4.46 Win64](https://home.apache.org/~steffenal/VC15/binaries/httpd-2.4.46-win64-VC15.zip)

> httpd.conf

**rewriteモジュールを有効化**

```txt
LoadModule rewrite_module modules/mod_rewrite.so
```

**ドキュメントルートの設定**

```txt
<Directory "${SRVROOT}/htdocs">
    Options FollowSymLinks

    AllowOverride All

    Require all granted
</Directory>
```

**php7モジュールを有効化**

```txt
LoadModule php7_module C:/php73/php7apache2_4.dll

# Configure php7_module
<IfModule php7_module>
Include conf/extra/httpd-php.conf
</IfModule>
```

**index.phpを省略してアクセスしたい場合**

```txt
<IfModule dir_module>
    DirectoryIndex index.html index.php
</IfModule>
```

> extra/httpd-php.conf

```txt
AddHandler application/x-httpd-php .php
PHPIniDir "C:/php73"
```


## PHP7.3

- [Dpwnlpad](https://windows.php.net/download#php-7.3)
  - [VC15 x64 Thread Safe](https://windows.php.net/downloads/releases/php-7.3.27-Win32-VC15-x64.zip)

**php.ini-developmentをコピー**

> php.ini

**拡張モジュールを有効化**

```ini
extension_dir = "ext"
extension=intl
extension=mbstring
extension=openssl
extension=pdo_mysql
```

## MySQL5.7

- [Dpwnlpad](https://downloads.mysql.com/archives/community/)
  - [Windows (x86, 64-bit), ZIP Archive](https://downloads.mysql.com/archives/get/p/23/file/mysql-5.7.32-winx64.zip)


**my-default.iniをコピー**

> my.ini

```ini
[client]
default-character-set = utf8

[mysqld]
character-set-server = utf8
default-time-zone=Asia/Tokyo
basedir = c:\mysql56
datadir = c:\mysql56\data

sql_mode=NO_ENGINE_SUBSTITUTION,STRICT_TRANS_TABLES 
```

**MySQLのdata\mysqlフォルダに展開したファイルを保存**

- [TimeZone](https://dev.mysql.com/downloads/timezones.html)
  - [POSIX standard](https://downloads.mysql.com/general/timezone_2021a_posix.zip)
  
## Composer

### インストーラー

- [Dpwnlpad](https://getcomposer.org/Composer-Setup.exe)
  - %USERPROFILE%\AppData\Roaming\Composer\vendor\bin
  - C:\ProgramData\ComposerSetup\bin\composer
  - C:\ProgramData\ComposerSetup\bin\composer.bat


### 手動でインストール

```sh
mkdir C:\Composer\bin
cd C:\Composer\bin
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --filename=composer
php -r "unlink('composer-setup.php');"
```

**バッチファイルの作成**

- composerで実行させるためには...

  - 環境変数のPATHを検索
  - C:\Composer\bin\composer.batを実行
    - %~dp0で、C:\Composer\bin\
    - %*で、全引数

> composer.bat

```bat
@echo OFF
:: in case DelayedExpansion is on and a path contains ! 
setlocal DISABLEDELAYEDEXPANSION
php "%~dp0composer" %*
```

## CakePHP3.8

```txt
composer create-project --prefer-dist cakephp:app=3.8.* myapp
```


## Windows評価版(有効期限:90日) or IOS焼き

- [評価版](https://www.microsoft.com/ja-jp/evalcenter/evaluate-windows-10-enterprise)
- [IOS焼き](https://www.microsoft.com/ja-jp/software-download/windows10)
- [Windows 10 Enterprise 仮想マシン](https://developer.microsoft.com/ja-jp/windows/downloads/virtual-machines/)

## Tips

- php動かない
  - [Visual Studio 2019 の Microsoft Visual C++ 再頒布可能パッケージ](https://visualstudio.microsoft.com/ja/downloads/)をインストール

- 「MSVCR100.dllが見つからない」エラーでmysqld動かない
  - [Microsoft Visual C++ 2010 SP1 再頒布可能パッケージ (x64)](https://www.microsoft.com/ja-jp/download/details.aspx?id=13523)
