<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFojingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fojings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained();
            $table->string('name');
            $table->string('pathName');
            $table->string('url');
            $table->integer('sort');
            $table->string('ext');
            $table->integer('playback');
            $table->decimal('filesize', $precision = 8, $scale = 2);
            $table->integer('duration');
            $table->integer('type');
            $table->string('jump_url');
            $table->string('cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fojings');
    }
}
