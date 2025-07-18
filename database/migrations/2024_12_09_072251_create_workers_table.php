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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('noid', 20);
            $table->string('name');
            $table->string('nik', 50);
            $table->date('dob');
            $table->string('telp', 20)->nullable();
            $table->string('address')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->date('start_work_at')->nullable();
            $table->string('bank_account', 50)->nullable();
            $table->string('account_name', 100)->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
