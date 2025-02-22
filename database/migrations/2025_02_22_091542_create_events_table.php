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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // not event without a host
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete(); // event may be uncategorized
            $table->string('title');
            $table->text('description')->default('');
            $table->date('date');
            $table->time('time');
            $table->unsignedInteger('max_participants')->min(1)->default(1);
            $table->string('location');
            $table->string('map_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
