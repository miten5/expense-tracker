<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("goals", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->string("name");
            $table->decimal("targeted_amount", 12, 2);
            $table->decimal("already_saved", 12, 2);
            $table->datetime("desired_date");
            $table->text("note")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("goals");
    }
};
