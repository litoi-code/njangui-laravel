<?php

// database/migrations/xxxx_xx_xx_create_penalties_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltiesTable extends Migration
{
    public function up()
    {
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade'); // Member who incurred the penalty
            $table->string('reason'); // Reason for the penalty
            $table->decimal('amount', 10, 2); // Penalty amount
            $table->boolean('is_paid')->default(false); // Whether the penalty has been paid
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penalties');
    }
}