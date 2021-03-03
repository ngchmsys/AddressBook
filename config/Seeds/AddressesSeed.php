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
