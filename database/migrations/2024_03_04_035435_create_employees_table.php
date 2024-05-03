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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->string('name')->index();
            $table->string('name_kh')->nullable();
            $table->string('position')->nullable();
            $table->string('avatar_url')->nullable();
            $table->date('date_of_birth');
            $table->date('hired_date');
            $table->string('type')->nullable();
            $table->string('level')->nullable();
            $table->string('sift')->nullable();
            $table->integer('probation_duration')->default(3);
            $table->float('leave_balance',2)->default(0);
            $table->date('probation_confirmation_date')->nullable();
            $table->date('last_working_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('remark')->nullable();
            $table->foreignId('user_id')->index()->nullable();
            $table->foreignId('report_to')->index()->nullable();
            $table->foreignId('ou_id')->index()->nullable();
            $table->foreignId('category_id')->index()->nullable();
            $table->json('dependencies')->nullable();
            $table->json('educations')->nullable();
            $table->json('skills')->nullable();
            $table->json('attached_files')->nullable();
            $table->json('work_experiences')->nullable();
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
