<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('order_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('status'); 
            $table->timestamp('changed_at')->nullable(); 
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('order_status_history');
    }
};
