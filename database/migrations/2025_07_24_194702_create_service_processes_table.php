<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('details')->nullable();       // تفاصيل إضافية
            $table->string('duration')->nullable();     // مدة التنفيذ
            $table->boolean('requires_approval')->default(false);
            $table->json('deliverables')->nullable();  // مخرجات/نتائج
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_processes');
    }
};
