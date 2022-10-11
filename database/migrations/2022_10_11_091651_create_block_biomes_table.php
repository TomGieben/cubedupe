<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Block;
use App\Models\Biome;

class CreateBlockBiomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_biomes', function (Blueprint $table) {
            $table->foreignIdFor(Block::class);
            $table->foreignIdFor(Biome::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_biomes');
    }
}
