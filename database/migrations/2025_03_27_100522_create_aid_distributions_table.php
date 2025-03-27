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
        Schema::create('aid_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_id')->constrained()->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            $table->enum('aid_type', ['food', 'clothing', 'medical', 'cash']);
            $table->date('received_at');
            $table->timestamps();
    
            // نمنع نفس الشخص من استلام نفس نوع المساعدة من نفس المخزن بنفس الشهر
            $table->unique(['beneficiary_id', 'warehouse_id', 'aid_type', 'received_at'], 'unique_monthly_distribution');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aid_distributions');
    }
};
