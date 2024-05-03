<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id");
            $table->dateTime("from");
            $table->dateTime("to");
            $table->string("type")->nullable();
            $table->string("status")->nullable();
            $table->integer("qty")->default(0);
            $table->boolean("paid_leave")->default(true);
            $table->tinyText("remark")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
