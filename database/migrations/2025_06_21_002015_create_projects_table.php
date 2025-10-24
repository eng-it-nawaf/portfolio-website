<?php
// database/migrations/xxxx_create_projects_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('technologies')->nullable(); // نصي بدلاً من علاقة
            $table->string('category'); // ويب، موبايل، سطح المكتب
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('play_store_url')->nullable();
            $table->date('completed_at');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_images');
        Schema::dropIfExists('projects');
    }
};