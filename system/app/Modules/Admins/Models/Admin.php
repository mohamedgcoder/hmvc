<?php

namespace Admins\Models;

use Laravel\Sanctum\HasApiTokens;
use Languages\Models\Translations;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $table = 'admins';
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'code', 'name', 'phone', 'email', 'title', 'status', 'gender', 'profile_pic', 'api_token', 'created_at', 'updated_at', 'created_by', 'last_updated_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function scopeCurrentAndDefaultLanguage($query)
    {
        return $this->hasOne(Translations::class, 'key', 'id')
        ->where('module', $this->table)
        ->where('lang', _current_Language())->orWhere('lang', _default_lang())
        ->select(['key', 'value', 'lang']);
    }

    function adminStatus()
    {
        return $this->hasMany(Translations::class, 'key', 'status')
        ->where('module', 'status')
        ->select(['key', 'value', 'lang']);
    }

    function adminTitle()
    {
        return $this->hasMany(Translations::class, 'key', 'status')
        ->where('module', 'titles')
        ->select(['key', 'value', 'lang']);
    }

    function adminGender()
    {
        return $this->hasMany(Translations::class, 'key', 'status')
        ->where('module', 'genders')
        ->select(['key', 'value', 'lang']);
    }

    public function scopeAllStatus($query)
    {
        return $query->whereIn('status', [2, 3]);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 2);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 3);
    }

    public function scopeNotinactive($query)
    {
        return $query->where('status', '!=', 3);
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 4);
    }
}
