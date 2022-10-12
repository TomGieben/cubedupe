<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class World extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'html',
    ];

    private int $positiveY = 10;
    private int $negativeY = 10;
    private int $positiveX = 25;
    private array $blocks = [];

    public function render(): HtmlString {
        return $this->html;
    } 

    public static function new(): World {
        $html = self::empty();

        $world = new World();

        $world->user_id = auth()->user()->id;
        $world->name = 'New world';
        $world->slug = Str::slug($world->name . $world->id);
        $world->html = $html;
        $world->save();

        return $world;
    }

    private static function empty(): HtmlString {
        $world = new World();
        $airAttributes = Block::airAttributes();
        $world->getAllBlocks();

        $html = '<div id="container" style="background-color: #6ad2fd;">';

            //positive
            for ($row=1; $row <= $world->positiveY; $row++) { 
                for ($col=1; $col <= $world->positiveX; $col++) { 
                    if($row = 1) {
                        $html .= $world->blocks['grass'];
                    } else {
                        $html .= '
                            <div
                            data-grid-position-y="'. ($world->positiveY - $row) .'"
                            data-grid-position-x="'. $col .'"
                            '. $airAttributes .'
                            ></div>
                        ';
                    }
                }
            }

            //negative
            for ($row=1; $row <= $world->negativeY; $row++) { 
                for ($col=1; $col <= $world->positiveX; $col++) { 
                    $html .= $world->blocks['dirt'];
                    // $html .= '
                    //     <div
                    //     data-grid-position-y="-'. $row .'";
                    //     data-grid-position-x="'. $col .'";
                    //     '. $airAttributes .'
                    //     ></div>
                    // ';
                }
            }

        $html .= '</div>';

        return new HtmlString($html);
    } 

    public function getAllBlocks(): array {
        $blocks = Block::all();

        foreach($blocks as $block) {
            $this->blocks[$block->slug] = $block->render();
        }   

        return $this->blocks;
    }
}
