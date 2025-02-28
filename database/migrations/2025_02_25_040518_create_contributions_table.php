<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
       
    Schema::create('contributions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('member_id')->constrained()->onDelete('cascade');
        $table->foreignId('fund_id')->constrained()->onDelete('cascade');
        $table->decimal('amount', 10, 2);
        $table->date('date');
        $table->string('host')->nullable();
        $table->timestamps();
    });
}
    

    public function down() {
        Schema::dropIfExists('contributions');
    }
};
