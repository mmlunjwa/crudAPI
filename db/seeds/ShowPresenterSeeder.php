<?php


use Phinx\Seed\AbstractSeed;

class ShowPresenterSeeder extends AbstractSeed
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
                    'show_id'    => 1,
                    'presenter_id'    => 1,
                    'created' => date('Y-m-d H:i:s'),
                ],[
                    'show_id'    => 1,
                    'presenter_id'    => 2,
                    'created' => date('Y-m-d H:i:s'),
                ]
            ];

            $posts = $this->table('shows');
            $posts->insert($data)
                ->save();
        }

    }
}