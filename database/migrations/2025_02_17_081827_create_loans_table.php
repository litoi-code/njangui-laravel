<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_account_id');
            $table->unsignedBigInteger('destination_account_id');
            $table->decimal('principal', 10, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('loan_term_months');
            $table->date('start_date')->default(now());
            $table->decimal('total_repayment', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->timestamps();

            $table->foreign('source_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('destination_account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
};