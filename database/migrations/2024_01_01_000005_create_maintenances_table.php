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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->default(1);
            $table->bigInteger('printer_id')->nullable()->default(1);
            $table->boolean('internal')->nullable()->default(false);
            $table->dateTime('date_init')->nullable()->default(null);
            $table->dateTime('date_finish')->nullable()->default(null);
            $table->dateTime('date_cancel')->nullable()->default(null);
            $table->string('user_name',65)->nullable()->default(null);
            $table->double('cost')->nullable()->default(0);
            $table->text('observation_init')->nullable();
            $table->text('observation_finish')->nullable();
            $table->text('observation_cancel')->nullable();
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
        Schema::dropIfExists('maintenances');
    }
};
