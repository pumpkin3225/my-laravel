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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('img_path')->nullable()->default('')->comment('照片路徑');
            $table->string('title')->nullable()->default('')->comment('新聞標題');
            $table->string('content')->nullable()->default('')->comment('新聞內容');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
