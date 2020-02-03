<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'type'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function scopeSearchStrict($query, $field, $search)
    {
        if ($search !== '') {
            return $query->where($field, $search);
        }
    }

    public function scopeOrSearch($query, $field, $search)
    {
        if ($search !== '') {
            return $query->orWhere($field, 'like', "%$search%");
        }
    }

    public function scopeSearch($query, $field, $search)
    {
        if ($search !== '') {
            return $query->where($field, 'like', "%$search%");
        }
    }

    public function scopeSearchMany($query, $field, $search, $relation)
    {
        if ($search !== '') {
            return $query->whereHas($relation, function ($query) use ($field, $search) {
                $query->where($field, 'like', '%' . $search . '%');
            });
        }
    }

}
