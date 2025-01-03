<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_allowances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('allowance_id')->constrained()->onDelete('cascade');
            $table->string('month');
            $table->decimal('amount', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_allowances');
    }
};
