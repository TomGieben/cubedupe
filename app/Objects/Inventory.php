<?php
    namespace App\Objects;

    use Illuminate\Support\HtmlString;
    use App\Models\Block;

    class Inventory
    {
        private array $items = [];

        static function render(): Htmlstring {
            $html = "<div></div>";

            return new Htmlstring($html);
        }

        public function add(int $id, int $times = 1): array {
            $this->items[$id] = (isset($this->items[$id])) ? $this->items[$id] + $times : $times;

            return $this->items;
        }

        public function remove(int $id, int $times = 1): array {
            
        }

        public function get(): array {
            return $this->items;
        }
    }
?>