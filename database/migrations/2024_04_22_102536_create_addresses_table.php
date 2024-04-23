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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();    
            $table->string('first_name')->nullbale();  
            $table->string('last_name')->nullabull();
            $table->string('phone')->nullbale();
            $table->string('email')->nullbale();
            $table->text('street_address')->nullbale();
            $table->string('city')->nullbale();
            $table->string('state')->nullbale();
            $table->string('country')->nullbale();
            $table->string('zip_code')->nullbale();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
