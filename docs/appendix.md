# PHP7.3

- [PHP公式サイト](https://www.php.net/manual/ja/install.unix.apache2.php)

**httpd-develのインストール**

```sh
yum install -y httpd-devel
```

**ソースファイルのダウンロード**

```sh
curl -OL https://www.php.net/distributions/php-7.3.27.tar.xz
```

**ソースファイルの展開**

```sh
tar Jxfv php-7.3.27.tar.xz
```

**configureの実行**

```sh
cd php-7.3.27
./configure --with-apxs2=/usr/bin/apxs
```

**makeの実行**

```sh
make
```

**make testの実行**

```sh
make test
```

**make installの実行**

```sh
make install
```


# for windows

- [Windows](https://wiki.php.net/internals/windows/stepbystepbuild_sdk_2)
