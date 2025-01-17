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
        Schema::create('entity',function(Blueprint $table){

            $table->id();
            $table->string('name',150);
            $table->string('phone',150);
            $table->string('mail',150);
            $table->string('address',200);
            $table->string('website',150)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity');
    }
};
