<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->boolean('is_app'); // or game
            $table->string('cover')->nullable();
            $table->string('package_name')->nullable();
            $table->string('version')->nullable();
            $table->string('file')->nullable();
            $table->string('download_url')->nullable();
            $table->string('publisher')->nullable();
            $table->string('publisher_url')->nullable();
            $table->text('description')->nullable();
            // todo category
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
        Schema::dropIfExists('apps');
    }
};
