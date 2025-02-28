<?php

// database/migrations/xxxx_xx_xx_create_transactions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade'); // Member involved in the transaction
            $table->foreignId('fund_id')->nullable()->constrained()->onDelete('cascade'); // Fund involved (if applicable)
            $table->string('type'); // Type of transaction (e.g., contribution, loan_repayment, penalty)
            $table->decimal('amount', 10, 2); // Transaction amount
            $table->text('description')->nullable(); // Additional details about the transaction
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}