<?php


use Phinx\Seed\AbstractSeed;

class SlotsSeeder extends AbstractSeed
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
                    'station_id'    => 1,
                    'time_in'    => HOUR('6:00'),
                    'time_out'    => HOUR('6:00'),
                    'day_of_week'    => 'Monday',
                    'created' => date('Y-m-d H:i:s'),
                ],[
                    'show_id'    => 1,
                    'station_id'    => 1,
                    'time_in'    => HOUR('6:00'),
                    'time_out'    => HOUR('6:00'),
                    'day_of_week'    => 'Tuesday',
                    'created' => date('Y-m-d H:i:s')
                ]
            ];

            $posts = $this->table('shows');
            $posts->insert($data)
                ->save();
        }

    }
}
