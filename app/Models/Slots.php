<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slots extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'show_id', 'station_id', 'time_in', 'time_out', 'day_of_week'
    ];

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $slots['slot'][0]['show_id']    =   $request->getParam('show_id');
        $slots['slot'][1]['station_id']     =   $request->getParam('station_id');
        $slots['slot'][2]['time_in']     =   $request->getParam('time_in');
        $slots['slot'][3]['time_out']     =   $request->getParam('time_out');
        $slots['slot'][4]['day_of_week']     =   $request->getParam('day_of_week');

        // insert into the database
        self::insert($slots['slot']);

        return $slots;
    }

    /**
     * @param $request
     * @return array
     */
    public function getList($request){
        $filter_attribute = $request->getParam('filter_attribute');
        $filter_value = $request->getParam('filter_value');
        if(isset($filter_attribute) &&  isset($filter_value)){
            $slotsList = self::leftjoin('presenters', 'slots.presenter_id', '=', 'presenters.id')
                ->leftjoin('shows', 'slots.show_id', '=', 'shows.id')
                ->leftjoin('stations', 'slots.station_id', '=', 'station.id')
                ->select('shows.name as show','presenters.name as presenter', 'stations.name as station', 'slots.time_in as start','slots.time_out as finish','slots.day_of_week as day')
                ->where([
                    ["slots.{$filter_attribute}", $filter_value],
                ])
                ->get();
        }else{
            $slotsList = self::leftjoin('presenters', 'slots.presenter_id', '=', 'presenters.id')
                ->leftjoin('shows', 'slots.show_id', '=', 'shows.id')
                ->leftjoin('stations', 'slots.station_id', '=', 'station.id')
                ->select('shows.name as show','presenters.name as presenter', 'stations.name as station', 'slots.time_in as start','slots.time_out as finish','slots.day_of_week as day')
                ->get();
        }

        return ($slotsList == null ? [] : $slotsList);
    }


    /**
     * @param array $request
     * @return bool|void
     */
    public function update($request)
    {
        $slot = self::find($request->getParam('id'));

        $time_in = $request->getParam('time_in');
        $time_out = $request->getParam('time_out');
        $day_of_week = $request->getParam('day_of_week');
        if (isset($time_in)) {
            $slot->name = $request->getParam('time_in');
        } elseif ($time_out){
            $slot->name = $request->getParam('time_out');
        } elseif($day_of_week){
            $slot->name = $request->getParam('day_of_week');
        }

         $slot-save();
    }

    /**
     * @param $request
     */
    public function remove($request){
        $slot = self::find($request->getParam('id'));
        $slot->delete();
    }

}