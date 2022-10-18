<?php
    namespace App\Objects;

    use Illuminate\Support\HtmlString;
    use App\Models\Block;

    class Tree
    {
        private int $height = 10;
        private int $width = 5;

        static function render(): Htmlstring {
            $tree = new Tree;
            $blocks = $tree->getAllBlocks();
            $html = '';

            for ($row=0; $row <= $tree->height; $row++) {
                for ($col=1; $col <= $tree->width; $col++) {
                    $x = $col;
                    $y = $tree->height - $row;

                    $html .= Block::setAttributes($blocks['grass'], $x, $y);
                }
            }

            return new Htmlstring($html);
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
?>
