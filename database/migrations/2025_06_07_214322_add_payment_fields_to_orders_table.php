<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_currency')->default('USD');
            $table->double('exchange_rate')->unsigned()->default(1);
            $table->double('amount_paid')->unsigned()->default(0);
            $table->double('change_due')->unsigned()->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_currency');
            $table->dropColumn('exchange_rate');
            $table->dropColumn('amount_paid');
            $table->dropColumn('change_due');
        });
    }
};
