<?php

namespace General\Models;

use Languages\Models\Translations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $table = 'gen_status';
    protected $transModule = 'status';

    public function statusTrans()
    {
        return $this->hasMany(Translations::class, 'key', 'id')
        ->where('module', $this->transModule)
        ->select(['key', 'value', 'lang']);
    }

    public function scopeCurrentAndDefaultLanguage()
    {
        return $this->hasOne(Translations::class, 'key', 'id')
        ->where('module', $this->transModule)
        ->where(function($q) {
            $value = $q->where('lang', _current_Language())->get();
            return ($value != null)? $value : $q->orWhere('lang', _default_lang());
        })
        ->select(['key', 'value', 'lang']);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 2);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 3);
    }

    public function scopeArrangement($query)
    {
        return $query->orderBy('arrangement', 'ASC');
    }
}
