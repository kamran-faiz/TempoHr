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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->integer('days_per_year');
            $table->boolean('carry_forward')->default(false);
            $table->integer('carry_forward_limit')->nullable();
            $table->boolean('is_encashable')->default(false);
            $table->boolean('allow_encroachment')->default(false);
          


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
