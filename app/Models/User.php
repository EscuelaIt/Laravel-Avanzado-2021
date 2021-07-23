<?php

namespace App\Models;

use App\Notifications\WelcomeNotification;
use App\Scopes\VisibleScope;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements HasLocalePreference
{
    use Cachable, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'birth_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'datetime',
        // 'is_admin' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($user) {
            $user->notify(new WelcomeNotification('Welcome'));
        });

        // static::addGlobalScope(new VisibleScope);
    }

    public function getAgeAttribute()
    {
        return $this->birth_date->diffInYears(now());
    }

    public function isAdmin()
    {
        return $this->is_admin == true;
    }

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return 'es';
    }
}
