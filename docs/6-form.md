
# フォームの構築

## 事前準備

## Form

**フォームの生成**

```sh
[root@localhost AddressBook]# bin/cake bake form search

Creating file /var/www/html/AddressBook/src/Form/SearchForm.php
Wrote `/var/www/html/AddressBook/src/Form/SearchForm.php`

Baking test case for App\Form\SearchForm ...

Creating file /var/www/html/AddressBook/tests/TestCase/Form/SearchFormTest.php
Wrote `/var/www/html/AddressBook/tests/TestCase/Form/SearchFormTest.php`
```

> src/Form/SearchForm.php

```php
<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * Search Form.
 */
class SearchForm extends Form
{
    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('search_word', 'string');
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    protected function _buildValidator(Validator $validator)
    {
        return $validator;
    }

    /**
     * Defines what to execute once the Form is processed
     *
     * @param array $data Form data.
     * @return bool
     */
    protected function _execute(array $data)
    {
        return true;
    }
}
```