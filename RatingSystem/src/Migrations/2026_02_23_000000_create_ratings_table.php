<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
		Schema::create('ratings', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->tinyInteger('rating');
			$table->text('review')->nullable();

			// Polymorphic fields
			$table->morphs('rateable');

			$table->timestamps();

			$table->unique(['rateable_type', 'rateable_id', 'user_id']);
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};