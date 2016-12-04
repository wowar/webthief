<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourceUrlTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('source_urls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->unique();
            $table->timestamps();
        });
        Schema::create('source_htmls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('source_url_id');
            $table->longText('html');
            $table->timestamps();

            $table->foreign('source_url_id')->references('id')->on('source_urls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('source_urls');
        Schema::drop('source_htmls');
    }

}
