<?php

namespace Module\Languages\Models;

use Illuminate\Database\Eloquent\Model;

class Translations extends Model
{
    protected $table = 'lang_translations';

    protected $fillable = [
        'key',
        'value',
        'lang',
        'module',
        'created_by',
    ];
}
