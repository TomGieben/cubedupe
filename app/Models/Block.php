<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'texture',
        'damage',
        'hp',
    ];

    private int $width = 20;
    private int $height = 20;
    private int $zIndex = 1;
    private string $unit = 'px';
    private string $defaultColor = '#EDEDED';
    private bool $showTextures = false;
    private array $style = [];

    public function render(): HtmlString {
        $texture = ($this->texture ? $this->texture : asset('img/test_texture.png'));

        //temporarily, until there is a grid system.
            $this->addStyle('float', 'left');
        //

        $this->addStyle('z-index', $this->zIndex);
        $this->addStyle('width', $this->width, $this->unit);
        $this->addStyle('height', $this->height, $this->unit);
        $this->addStyle('background-color', $this->color ?? $this->defaultColor);

        if(config('app.dev') || $this->texture) {
            if($this->showTextures) {
                $this->addStyle('background-image', 'url(\'' . $texture . '\')');
                $this->addStyle('background-repeat', 'no-repeat');
                $this->addStyle('background-size', 'cover');
                $this->addStyle('object-fit', 'cover');
            }
        } 

        $block = '
            <div 
                style="'. $this->renderStyle() .'" 
                data-block="'. $this->slug .'"
                data-damage="'. $this->damage .'"
                data-hp="'. $this->hp .'"
                ' . (config('app.dev') ? 'title="' . $this->slug . '"' : '') . '
            ></div>
        ';

        return new HtmlString($block);
    }

    private function addStyle(string $attribute, $value, string $unit = null): array {
        $this->style[$attribute] = $value . $unit;

        return $this->style;
    }

    private function renderStyle(): string {
        $style = '';

        foreach($this->style as $attribute => $value) {
            $style .= $attribute . ':' . $value . '; ';
        }

        return $style;
    }

    public static function airAttributes(): string {
        $block = new Block();

        //temporarily, until there is a grid system.
            $block->addStyle('float', 'left');
        //

        $block->addStyle('width', $block->width, $block->unit);
        $block->addStyle('height', $block->height, $block->unit);
        $block->addStyle('background-color', 'transparent');

        $block = '
            style="'. $block->renderStyle() .'" 
            data-block="air"
            ' . (config('app.dev') ? 'title="air"' : '') . '
        ';

        return $block;
    }

    public static function setAttributes(string $html, int $x, int $y): HtmlString {
        $attributes = '
            data-grid-position-y="'. $y .'"
            data-grid-position-x="'. $x .'"
        >';

        $html = preg_replace('/(<div\b[^><]*)>/i', '$1 '. $attributes .'', $html);

        return new HtmlString($html);
    }

    public static function getBlock(string $slug): Block {
        return Block::query()
            ->where('slug', $slug)
            ->first();
    }

    public static function getVar(string $var) {
        $block = new Block();

        return $block->$var;
    }
}
