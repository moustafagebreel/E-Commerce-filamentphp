<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->decimal('amount', 10, 2);
            $table->decimal('balance', 10, 2);
            $table->foreignId('issued_to_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('purchased_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
    }
};
