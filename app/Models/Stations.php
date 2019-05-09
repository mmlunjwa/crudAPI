<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stations extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return self::firstOrCreate([
            'name'          => $request->getParam('name'),
        ]);
    }


    /**
     * @param $request
     * @return array
     */
    public function getList($request){
        $filter_attribute = $request->getParam('filter_attribute');
        $filter_value = $request->getParam('filter_value');
        if(isset($filter_attribute) &&  isset($filter_value)){
            $slotsList = self::select('stations.name as station')
                ->where([
                    ["slots.{$filter_attribute}", $filter_value],
                ])
                ->get();
        }else{
            $slotsList = self::select('stations.name as station')
                ->get();
        }

        return ($slotsList == null ? [] : $slotsList);
    }

    /**
     * @param array $request
     * @return bool|void
     */
    public function update($request){
        $station = $request->getParam('id');
        $station->name =  $request->getParam('name');
        $station-save();
    }

    /**
     * @param $request
     */
    public function remove($request){
        $station = self::find($request->getParam('id'));
        $station->delete();
    }

}