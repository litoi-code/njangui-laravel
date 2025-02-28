<?php

// database/migrations/xxxx_xx_xx_create_loans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade'); // Member who requested the loan
            $table->foreignId('fund_id')->constrained()->onDelete('cascade'); // Fund from which the loan is taken
            $table->decimal('amount', 10, 2); // Loan amount
            $table->decimal('interest_rate', 5, 2); // Interest rate (e.g., 5.00 for 5%)
            $table->decimal('remaining_balance', 10, 2); // Remaining loan balance
            $table->date('start_date'); // Loan start date
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}