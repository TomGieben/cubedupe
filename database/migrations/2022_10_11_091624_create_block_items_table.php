<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Block;
use App\Models\Item;

class CreateBlockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_items', function (Blueprint $table) {
            $table->foreignIdFor(Block::class);
            $table->foreignIdFor(Item::class);
            $table->integer('hp')->default(100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_items');
    }
}
