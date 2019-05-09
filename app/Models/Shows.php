<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shows extends Model
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
        $created_show = self::firstOrCreate([
            'name'          => $request->getParam('name'),
            'slot_id'          => $request->getParam('slot_id'),
        ]);

        return $created_show;
    }

    /**
     * @param $request
     * @return array
     */
    public function getList($request){
        $filter_attribute = $request->getParam('filter_attribute');
        $filter_value = $request->getParam('filter_value');
        if(isset($filter_attribute) &&  isset($filter_value)){
            $slotsList = self::select('shows.name as show')
                ->where([
                    ["slots.{$filter_attribute}", $filter_value],
                ])
                ->get();
        }else{
            $slotsList = self::select('shows.name as show')
                ->get();
        }

        return ($slotsList == null ? [] : $slotsList);
    }


    /**
     * @param array $request
     * @return bool
     */
    public function update($request){
        $show = self::find($request->getParam('id'));
        $show->name = $request->getParam('name');
        return $show-save();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function remove($request){
        $show = self::find($request->getParam('id'));
        return $show->delete();
    }

}