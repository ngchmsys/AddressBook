# モデルの構築

## 事前準備


## Model

**モデルの生成**

```sh
[root@localhost AddressBook]# bin/cake bake model addresses
One moment while associations are detected.

Baking table class for Addresses...

Creating file /var/www/html/AddressBook/src/Model/Table/AddressesTable.php
Wrote `/var/www/html/AddressBook/src/Model/Table/AddressesTable.php`
Deleted `/var/www/html/AddressBook/src/Model/Table/empty`

Baking entity class for Address...

Creating file /var/www/html/AddressBook/src/Model/Entity/Address.php
Wrote `/var/www/html/AddressBook/src/Model/Entity/Address.php`
Deleted `/var/www/html/AddressBook/src/Model/Entity/empty`

Baking test fixture for Addresses...

Creating file /var/www/html/AddressBook/tests/Fixture/AddressesFixture.php
Wrote `/var/www/html/AddressBook/tests/Fixture/AddressesFixture.php`
Deleted `/var/www/html/AddressBook/tests/Fixture/empty`
Bake is detecting possible fixtures...

Baking test case for App\Model\Table\AddressesTable ...

Creating file /var/www/html/AddressBook/tests/TestCase/Model/Table/AddressesTableTest.php
Wrote `/var/www/html/AddressBook/tests/TestCase/Model/Table/AddressesTableTest.php`
```

> src/Model/Entity/Address.php

```php
<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Address Entity
 *
 * @property int $id
 * @property string $name
 * @property string $furigana
 * @property string $post
 * @property string $address
 */
class Address extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'furigana' => true,
        'post' => true,
        'address' => true,
    ];
}
```

> src/Model/Table/AddressesTable.php

```php
<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Addresses Model
 *
 * @method \App\Model\Entity\Address get($primaryKey, $options = [])
 * @method \App\Model\Entity\Address newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Address[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Address|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Address saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Address patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Address[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Address findOrCreate($search, callable $callback = null, $options = [])
 */
class AddressesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('addresses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('furigana')
            ->maxLength('furigana', 255)
            ->requirePresence('furigana', 'create')
            ->notEmptyString('furigana');

        $validator
            ->scalar('post')
            ->maxLength('post', 8)
            ->requirePresence('post', 'create')
            ->notEmptyString('post');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        return $validator;
    }
}
```