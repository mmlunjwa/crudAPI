<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Presenters extends Model
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
            $slotsList = self::select('presenters.name as presenter')
                ->where([
                    ["slots.{$filter_attribute}", $filter_value],
                ])
                ->get();
        }else{
            $slotsList = self::select('presenters.name as presenter')
                ->get();
        }

        return ($slotsList == null ? [] : $slotsList);
    }


    /**
     * @param array $request
     * @return bool
     */
    public function update($request){
        $presenter = self::find($request->getParam('id'));
        $presenter->name = $request->getParam('name');
        return $presenter-save();
    }


    /**
     * @param $request
     * @return mixed
     */
    public function remove($request){
        $presenter = self::find($request->getParam('id'));
        return $presenter->delete();
    }

}