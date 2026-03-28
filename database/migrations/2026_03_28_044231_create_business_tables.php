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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('company_type')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('hrm_plan', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('employee_per_price', 10, 2)->nullable();
            $table->integer('employee_capacity');
            $table->string('status')->default('active');
        });

        Schema::create('hrm_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('company_id');
            $table->unsignedBigInteger('plan_id');
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('employee_per_price', 10, 2)->nullable();
            $table->integer('employee_capacity');
            $table->string('status')->default('active');
            $table->string('total_employee')->default('0');
            $table->string('active_employee')->default('0');
            $table->timestamps();
            
            $table->foreign('company_id')->references('company_id')->on('company');
            $table->foreign('plan_id')->references('id')->on('hrm_plan');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_subscriptions');
        Schema::dropIfExists('hrm_plan');
        Schema::dropIfExists('company');
    }
};
