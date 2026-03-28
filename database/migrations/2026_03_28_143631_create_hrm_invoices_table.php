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
        Schema::create('hrm_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('billing_type'); // 'subscription' or 'upgrade'
            $table->unsignedBigInteger('billing_id'); // Link to hrm_subscriptions or hrm_upgrades
            $table->decimal('base_amount', 12, 2);
            $table->decimal('gst_amount', 12, 2);
            $table->decimal('total_amount', 12, 2);
            $table->string('status')->default('paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrm_invoices');
    }
};
