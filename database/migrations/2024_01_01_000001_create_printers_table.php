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
        Schema::create('printers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->default(1);
            $table->bigInteger('brand_id')->nullable()->default(1);
            $table->string('serial', 65)->nullable();
            $table->string('model', 65)->nullable();
            $table->string('description', 65)->nullable();
            $table->string('image', 255)->nullable();
            $table->text('observation')->nullable();
            $table->double('cost')->nullable()->default(0);
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
        Schema::dropIfExists('printers');
    }
};
