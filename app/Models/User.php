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

    private int $width = 40;
    private int $height = 80;
    public int $reach = 5;
    public int $hp;
    public string $username;
    public string $texture;
    public string $selectedItem;
    public array $inventory;

    
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

         $worldMaxY = World::getVar('positiveY');
         $worldMaxY++;

        auth()->user()->username = auth()->user()->name;
        auth()->user()->texture = '<div><img id="imagechar" src="img/testchar2.png" alt="image" style="width: '. auth()->user()->width .'px; height: '. auth()->user()->height .'px; position: relative; left: 0px; top: 0px; z-index: 9999;" data-grid-position-y="'.$worldMaxY.'"; data-grid-position-x="1" data-selected-item=""></div>';
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

    public static function getVar(string $var) {
        $char = new User();
    
        return $char->$var;
    }
}
