# データベースの構築

## 事前準備

**データベースに接続(root)**

```sh
[root@localhost AddressBook]# mysql -u root -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 10
Server version: 5.6.51 MySQL Community Server (GPL)

Copyright (c) 2000, 2021, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.
```

**データベースの作成**

```sh
mysql> CREATE DATABASE address_book;
```

**ユーザに権限の付与**

```sh
mysql> GRANT ALL ON address_book.* TO myapp@localhost;
```

**データベースの切断**

```sh
mysql> exit
Bye
```

=====

# CakePHPでのデータベース操作

## マイグレーションファイルの生成

```sh
[root@localhost AddressBook]# bin/cake bake migration CreateAddresses

Creating file /var/www/html/AddressBook/config/Migrations/20210302110221_CreateAddresses.php
Wrote `/var/www/html/AddressBook/config/Migrations/20210302110221_CreateAddresses.php`
```

## マイグレーションファイルの編集

```sh
[root@localhost AddressBook]# vi config/Migrations/20210302110221_CreateAddresses.php
```

> config/Migrations/20210302110221_CreateAddresses.php

```php
<?php
use Migrations\AbstractMigration;

class CreateAddresses extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('addresses');
        $table
            ->addColumn('name', 'string')
            ->addColumn('furigana', 'string')
            ->addColumn('post', 'string', [
                'limit' => 8
            ])
            ->addColumn('address', 'text')
            ->create();
    }
}
```

## マイグレーションの実行

```sh
[root@localhost AddressBook]# bin/cake migrations migrate
using migration paths
 - /var/www/html/AddressBook/config/Migrations
using seed paths
 - /var/www/html/AddressBook/config/Seeds
using environment default
using adapter mysql
using database address_book
ordering by creation time

 == 20210302110221 CreateAddresses: migrating
 == 20210302110221 CreateAddresses: migrated 0.0136s

All Done. Took 0.0149s
using migration paths
 - /var/www/html/AddressBook/config/Migrations
using seed paths
 - /var/www/html/AddressBook/config/Seeds
Writing dump file `/var/www/html/AddressBook/config/Migrations/schema-dump-default.lock`...
Dump file `/var/www/html/AddressBook/config/Migrations/schema-dump-default.lock` was successfully written
```

## マイグレーションの確認

**データベースに接続**

```sh
[root@localhost AddressBook]# mysql -u myapp -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 10
Server version: 5.6.51 MySQL Community Server (GPL)

Copyright (c) 2000, 2021, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.
```

**使用データベースの選択**

```sh
mysql> use address_book;
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Database changed
```

**テーブル一覧の参照**

```sql
mysql> show tables;
+------------------------+
| Tables_in_address_book |
+------------------------+
| addresses              |
| phinxlog               |
+------------------------+
2 rows in set (0.00 sec)
```

**addressesテーブルの確認**

```sql
mysql> desc addresses;
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int(11)      | NO   | PRI | NULL    | auto_increment |
| name     | varchar(255) | NO   |     | NULL    |                |
| furigana | varchar(255) | NO   |     | NULL    |                |
| post     | varchar(8)   | NO   |     | NULL    |                |
| address  | text         | NO   |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
5 rows in set (0.00 sec)
```

**データベースの切断**

```sh
mysql> exit
Bye
```

## seedファイルの生成

```sh
[root@localhost AddressBook]# bin/cake bake seed Addresses

Creating file /var/www/html/AddressBook/config/Seeds/AddressesSeed.php
Wrote `/var/www/html/AddressBook/config/Seeds/AddressesSeed.php`
```

## seedファイルの編集

```sh
[root@localhost AddressBook]# vi config/Seeds/AddressesSeed.php
```

> config/Seeds/AddressesSeed.php

```php
<?php
use Migrations\AbstractSeed;

/**
 * Addresses seed.
 */
class AddressesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => '池田　太郎',
                'furigana' => 'いけだ　たろう',
                'post' => '778‐8501',
                'address' => '徳島県三好市池田町シンマチ1500ｰ2'
            ],
            [
                'name' => '東京　花子',
                'furigana' => 'とうきょう　はなこ',
                'post' => '163‐8001',
                'address' => '東京都新宿区西新宿２丁目８－１'
            ]

        ];

        $table = $this->table('addresses');
        $table->insert($data)->save();
    }
}
```

## seedの実行

```sh
[root@localhost AddressBook]# bin/cake migrations seed
using migration paths
 - /var/www/html/AddressBook/config/Migrations
using seed paths
 - /var/www/html/AddressBook/config/Seeds
using migration paths
 - /var/www/html/AddressBook/config/Migrations
using seed paths
 - /var/www/html/AddressBook/config/Seeds
using environment default
using adapter mysql
using database address_book

 == AddressesSeed: seeding
 == AddressesSeed: seeded 0.0108s

All Done. Took 0.0117s
```

## seedの確認

**ワンライナーで確認**

```sh
[root@localhost AddressBook]# mysql -u myapp -p -D address_book -e "SELECT * FROM addresses;"
Enter password:
+----+-----------------+-----------------------------+------------+-------------------------------------------------+
| id | name            | furigana                    | post       | address                                         |
+----+-----------------+-----------------------------+------------+-------------------------------------------------+
|  1 | 池田　太郎      | いけだ　たろう              | 778‐8501   | 徳島県三好市池田町シンマチ1500ｰ2                |
|  2 | 東京　花子      | とうきょう　はなこ          | 163‐8001   | 東京都新宿区西新宿２丁目８－１                  |
+----+-----------------+-----------------------------+------------+-------------------------------------------------+
```

=====

## マイグレーションのロールバック

- データベースの変更を戻す場合のみ実施

```sh
[root@localhost AddressBook]# bin/cake migrations rollback
using migration paths
 - /var/www/html/AddressBook/config/Migrations
using seed paths
 - /var/www/html/AddressBook/config/Seeds
using environment default
using adapter mysql
using database address_book
ordering by creation time

 == 20210302110221 CreateAddresses: reverting
 == 20210302110221 CreateAddresses: reverted 0.0167s

All Done. Took 0.0176s
using migration paths
 - /var/www/html/AddressBook/config/Migrations
using seed paths
 - /var/www/html/AddressBook/config/Seeds
Writing dump file `/var/www/html/AddressBook/config/Migrations/schema-dump-default.lock`...
Dump file `/var/www/html/AddressBook/config/Migrations/schema-dump-default.lock` was successfully written
```

# まとめ

**雛形の生成**

- bakeコマンド
  - migration
  - seed

**データベースに反映**

- migrations
  - migrate
  - seed
  - rollback
