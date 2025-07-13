<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('value', 10, 2);
            $table->date('date_recorded'); // ensure this exists
            $table->text('asset_description')->nullable();
            $table->string('color_of_asset')->nullable();
            $table->decimal('price', 10, 2)->nullable();  // price column exists
            $table->integer('quantity')->nullable();      // quantity column exists
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
