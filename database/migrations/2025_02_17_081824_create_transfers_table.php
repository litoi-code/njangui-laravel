<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_account_id');
            $table->unsignedBigInteger('destination_account_id');
            $table->decimal('amount', 10, 2);
            $table->date('transfer_date')->default(now());
            $table->string('location')->nullable();
            $table->timestamps();

            $table->foreign('source_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('destination_account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfers');
    }
};