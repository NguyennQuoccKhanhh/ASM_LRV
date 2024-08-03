<?php

use App\Models\Catelogue;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Catelogue::class)->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->comment('Mã bài viết');
            $table->string('image_post')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('view')->default(0);
            $table->boolean('is_show_home')->default(false);
            $table->timestamp('published_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
