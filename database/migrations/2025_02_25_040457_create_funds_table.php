<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up()
{
    Schema::create('funds', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->enum('type', ['checking', 'saving', 'investment']);
        $table->decimal('balance', 10, 2)->default(0);
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('funds');
    }
};
