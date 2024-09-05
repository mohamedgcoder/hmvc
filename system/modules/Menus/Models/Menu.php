<?php

namespace Module\Menus\Models;

use Illuminate\Database\Eloquent\Model;
use Module\Languages\Models\Translations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $guard_name = 'admin';
    protected $table = 'menus';
    protected $transModule = 'menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'type', 'url', 'group', 'parent', 'level', 'icon', 'arrangement', 'last_updated_by', 'default'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function menuTrans()
    {
        return $this->hasMany(Translations::class, 'key', 'id')
        ->where('module', $this->transModule)
        ->select(['key', 'value', 'lang']);
    }
}
