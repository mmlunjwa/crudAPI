<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowPresenter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'presenter_id', 'show_id', ''
    ];



}