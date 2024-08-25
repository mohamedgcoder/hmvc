<?php

namespace Languages\Models;

use Languages\Models\Translations;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'lang_languages';
    protected $transModule = 'languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code', 'flag', 'name', 'direction', 'status', 'arrangement', 'created_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    function nameTrans()
    {
        return $this->hasMany(Translations::class, 'key', 'id')
        ->where('module', $this->transModule)
        ->select(['key', 'value', 'lang']);
    }

    function statusTrans()
    {
        return $this->hasMany(Translations::class, 'key', 'status')
        ->where('module', 'status')
        ->select(['key', 'value', 'lang']);
    }

    function scopeName()
    {
        return $this->hasOne(Translations::class, 'key', 'id')
        ->where('module', $this->transModule)
        ->where('lang', 'en')
        ->select(['key', 'value', 'lang']);
    }

    public function scopeAllStatus($query)
    {
        return $query->whereIn('status', [2, 3]);
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
        return $query->orderBy('arrangement');
    }
}
