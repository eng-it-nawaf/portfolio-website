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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('social_links');
            $table->string('telegram')->nullable()->after('whatsapp');
            $table->string('facebook')->nullable()->after('telegram');
            $table->string('youtube')->nullable()->after('facebook');
            $table->string('instagram')->nullable()->after('youtube');
            $table->string('stackoverflow')->nullable()->after('instagram');
            $table->string('website')->nullable()->after('stackoverflow');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp',
                'telegram',
                'facebook',
                'youtube',
                'instagram',
                'stackoverflow',
                'website'
            ]);
        });
    }
};
