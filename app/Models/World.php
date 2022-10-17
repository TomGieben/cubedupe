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

    private int $positiveY = 50;
    private int $negativeY = 50;
    private int $positiveX = 100;

    public function render(): HtmlString {
        return new HtmlString($this->html);
    }

    public static function new(array $attributes = []): World {
        $html = self::empty();

        $world = new World();

        $world->user_id = auth()->user()->id ?? 1;
        $world->name = $attributes['name'];
        $world->slug = Str::slug($attributes['name']);
        $world->html = $html;
        $world->save();

        return $world;
    }

    private static function empty(): HtmlString {
        $world = new World();
        $containerWidth = $world->positiveX * Block::getVar('width');
        $blocks = $world->getAllBlocks();

        $html = '<div id="container" style="width:' . $containerWidth . 'px;">';

            //positive
            for ($row=0; $row <= $world->positiveY; $row++) {
                for ($col=1; $col <= $world->positiveX; $col++) {
                    $x = $col;
                    $y = $world->positiveY - $row;

                    if($y == 0) {
                        $html .= Block::setAttributes($blocks['grass'], $x, $y);
                    } else {
                        if($y == $world->positiveY && $x < count($blocks) && config('app.dev')) {
                            $html .= Block::setAttributes(array_values(array_slice($blocks, $x, 1))[0], $x, $y);
                        } else {
                            $html .= Block::setAttributes($blocks['air'], $x, $y);
                        }
                    }
                }
            }

            //negative
            for ($row=1; $row <= $world->negativeY; $row++) {
                for ($col=1; $col <= $world->positiveX; $col++) {
                    $x = $col;
                    $y = -(-1 * abs($world->negativeY - $row) + $world->negativeY);

                    if($y > -10) {
                        $html .= Block::setAttributes($blocks['dirt'], $x, $y);
                    } else {
                        $html .= Block::setAttributes($blocks['stone'], $x, $y);
                    }
                }
            }

        $html .= '</div>';

        return new HtmlString($html);
    }

    public function getAllBlocks(): array {
        $blocks = Block::all();
        $array = [];

        foreach($blocks as $block) {
            $array[$block->slug] = $block->render();
        }

        return $array;
    }
}
