<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->default(1);
            $table->bigInteger('cartridge_id')->nullable()->default(1);
            $table->double('quantity')->nullable()->default(0);
            $table->double('_quantity')->nullable()->default(0);
            $table->double('cost')->nullable()->default(0);
            $table->smallInteger('type')->nullable()->default(1);
            $table->text('observation')->nullable();
            $table->dateTime('date_at')->nullable()->default(now());
            $table->string('status',15)->nullable()->default('Active');
            $table->dateTime('created_at')->nullable()->default(now());
            $table->dateTime('updated_at')->nullable()->default(null);
            $table->dateTime('deleted_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
