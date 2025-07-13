<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSellingAndCostPriceFromAssetsTable extends Migration
{
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['selling_price', 'cost_price']);
        });
    }

    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('cost_price', 10, 2)->nullable();
        });
    }
}
