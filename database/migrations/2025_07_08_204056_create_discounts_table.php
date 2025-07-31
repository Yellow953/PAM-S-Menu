<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("business_id")->unsigned();
            $table->string('type')->default('percentage');
            $table->string('code');
            $table->double('value')->unsigned();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('businesses');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
