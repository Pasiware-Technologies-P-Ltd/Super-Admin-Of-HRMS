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
        Schema::create('hrm_upgrades', function (Blueprint $table) {
            $table->id();
            $table->string('company_id');
            $table->unsignedBigInteger('old_plan_id');
            $table->unsignedBigInteger('new_plan_id');
            $table->decimal('old_setup_fee', 15, 2);
            $table->decimal('new_setup_fee', 15, 2);
            $table->decimal('old_emp_price', 15, 2);
            $table->decimal('new_emp_price', 15, 2);
            $table->integer('old_capacity');
            $table->integer('new_capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_upgrades');
    }
};
