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
        Schema::create('tickets',function(Blueprint $table){

            $table->id();
            $table->string('title',150);
            $table->string('type',150);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('entity_id')->constrained('entity');
            $table->foreignId('employee_id')->nullable()->constrained('employee')->nullOnDelete();
            $table->foreignId('service_id')->constrained();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
