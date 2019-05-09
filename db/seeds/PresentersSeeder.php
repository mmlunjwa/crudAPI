<?php


use Phinx\Seed\AbstractSeed;

class PresentersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        {
            $data = [
                [
                    'name'    => 'Bongani Bingwa',
                    'created' => date('Y-m-d H:i:s'),
                ],[
                    'name'    => 'Eusebius McKaiser',
                    'created' => date('Y-m-d H:i:s'),
                ]
            ];

            $posts = $this->table('presenters');
            $posts->insert($data)
                ->save();
        }

    }
}