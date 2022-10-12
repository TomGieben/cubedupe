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
    private string $unit = 'px';
    private string $defaultColor = '#EDEDED';
    private array $style = [];

    public function render(): HtmlString {
        $texture = ($this->texture ? $this->texture : asset('img/test_texture.png'));

        //temporarily, until there is a grid system.
            $this->addStyle('float', 'left');
        //

        $this->addStyle('width', $this->width, $this->unit);
        $this->addStyle('height', $this->height, $this->unit);
        $this->addStyle('background-color', $this->color ?? $this->defaultColor);

        if(config('app.dev') || $this->texture) {
            $this->addStyle('background-image', 'url(\'' . $texture . '\')');
            $this->addStyle('background-repeat', 'no-repeat');
            $this->addStyle('background-size', 'cover');
            $this->addStyle('object-fit', 'cover');
        } 

        $block = '
            <div 
                style="'. $this->renderStyle() .'" 
                data-block="'. $this->slug .'"
                data-damage="'. $this->damage .'"
                data-hp="'. $this->hp .'"
                ' . (config('app.dev') ? 'title=" ' . $this->slug . ' "' : '') . '
                >
            </div>
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
}
