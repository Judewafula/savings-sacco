<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceAndUserToSalesTable extends Migration
{
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            // Only add columns that don't already exist
            if (!Schema::hasColumn('sales', 'total_price')) {
                $table->decimal('total_price', 12, 2)->after('price')->nullable();
            }

            if (!Schema::hasColumn('sales', 'sale_date')) {
                $table->date('sale_date')->nullable()->after('total_price');
            }

            if (!Schema::hasColumn('sales', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('sale_date');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['total_price', 'sale_date', 'user_id']);
        });
    }
}
