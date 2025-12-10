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
        Schema::create("budgets", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->string("name");
            $table->enum("period", ["month", "week", "year", "one_time"]);
            $table->decimal("amount", 12, 2);
            $table->text("description")->nullable();
            $table->text("note")->nullable();
            $table->foreignId("currency_id")->constrained()->cascadeOnDelete();
            $table->foreignId("category_id")->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("budgets");
    }
};
