<?php


use Phinx\Seed\AbstractSeed;

class ShowsSeeder extends AbstractSeed
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
                    'name'    => 'Late Night Talk',
                    'created' => date('Y-m-d H:i:s'),
                ],[
                    'name'    => 'Early Breakfast',
                    'created' => date('Y-m-d H:i:s'),
                ]
            ];

            $posts = $this->table('shows');
            $posts->insert($data)
                ->save();
        }

    }
}
