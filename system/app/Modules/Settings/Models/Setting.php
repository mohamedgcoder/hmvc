<?php

namespace Settings\Models;

use Languages\Models\Translations;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // table name
    protected $table = 'settings';

    // fillable
    protected $fillable = [
        'module', 'setting', 'value', 'translation'
    ];

    // translation value for settings module
    function valueTrans()
    {
        return $this->hasMany(Translations::class, 'key', 'id')
        ->where('module', 'settings')
        ->where(function($q){
            $q->where('lang', _current_Language())->orWhere('lang', config('app.fallback_locale'));
        })
        ->select(['key', 'value', 'lang']);
    }

    // translations for settings module
    function translations()
    {
        return $this->hasMany(Translations::class, 'key', 'id')
        ->where('module', 'settings')
        ->select(['key', 'value', 'lang']);
    }
}
