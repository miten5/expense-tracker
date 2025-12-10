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
        Schema::create("transactions", function (Blueprint $table) {
            $table->id();
            $table->string("description")->nullable();
            $table
                ->foreignId("user_id")
                ->constrained("users")
                ->cascadeOnDelete();

            // transaction types: INCOME, EXPENSE, TRANSFER
            $table->enum("transaction_type", ["INCOME", "EXPENSE", "TRANSFER"]);

            // For income/expense
            $table
                ->foreignId("account_id")
                ->nullable()
                ->constrained("accounts")
                ->nullOnDelete();

            // For transfers
            $table
                ->foreignId("from_account_id")
                ->nullable()
                ->constrained("accounts")
                ->nullOnDelete();
            $table
                ->foreignId("to_account_id")
                ->nullable()
                ->constrained("accounts")
                ->nullOnDelete();

            $table->foreignId("currency_id")->constrained("currencies");

            $table
                ->foreignId("category_id")
                ->nullable()
                ->constrained("categories")
                ->nullOnDelete();
            $table
                ->foreignId("subcategory_id")
                ->nullable()
                ->constrained("subcategories")
                ->nullOnDelete();

            $table->decimal("amount", 12, 2);
            $table->datetime("date");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("transactions");
    }
};
