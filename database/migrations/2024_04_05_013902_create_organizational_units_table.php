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
        Schema::create('organizational_units', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type")->nullable();
            $table->text("description")->nullable();
            $table->string("logo")->nullable();
            $table->boolean("is_brand")->default(false);
            $table->foreignId("parent_id")->nullable();
            $table->boolean("active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizational_units');
    }
};
