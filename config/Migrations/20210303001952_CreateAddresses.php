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
