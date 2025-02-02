<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('gender_id')->nullable()->index();
            $table->unsignedBigInteger('profession_id')->nullable()->index();
            $table->unsignedBigInteger('department_id')->nullable()->index();
            $table->unsignedBigInteger('clothes_size_id')->nullable()->default(null);
            $table->unsignedBigInteger('shoes_size_id')->nullable()->default(null);
            $table->unsignedBigInteger('hats_size_id')->nullable()->default(null);
            $table->unsignedBigInteger('external_id')->nullable()->default(null);
            $table->string('last_name')->index();
            $table->string('first_name');
            $table->string('middle_name')->nullable()->default(null);
            $table->integer('height');
            $table->timestamp('employment_date')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('set null');
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');

            $table->foreign('clothes_size_id')->references('id')->on('sizes')->onDelete('set null');
            $table->foreign('shoes_size_id')->references('id')->on('sizes')->onDelete('set null');
            $table->foreign('hats_size_id')->references('id')->on('sizes')->onDelete('set null');
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
