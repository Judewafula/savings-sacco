<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostPriceToAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::table('assets', function (Blueprint $table) {
        $table->decimal('price', 12, 2)->default(0);
    });
}

public function down()
{
    Schema::table('assets', function (Blueprint $table) {
        $table->dropColumn('price');
    });
}

}
