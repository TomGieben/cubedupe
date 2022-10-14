<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\HtmlString;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public string $username;
    public string $texture;
    public string $selectedItem;
    public array $inventory;
    public int $hp;

    public function renderCharacter(string $html = ''): HtmlString {
        if(self::createCharacter())
        {
            $html .= auth()->user()->texture;
        }else
        {
            $html .= '';
        }
        return new HtmlString($html);
    }

    public static function createCharacter(): bool {
        auth()->user()->username = auth()->user()->name;
        auth()->user()->texture = '<div ><img src="img/testchar.png" alt="image" style="width: 60; height: 80;"></div>';
        auth()->user()->selectedItem = '';
        auth()->user()->inventory = [];
        auth()->user()->hp = 10;

        return true;
    }

    public function resetCharacter(): bool {
        try {
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    
    public function worlds(): HasMany
    {
        return $this->hasmany(World::class);
    }
}
