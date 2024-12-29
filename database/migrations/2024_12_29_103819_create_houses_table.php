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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Since the task does not specify exactly the data type of the columns below and whether it can be null,
            // we are working with the possibility of empty values to avoid problems.
            $table->unsignedInteger('price')->nullable();
            // As a rule, the number of bathrooms and garages below is not more than 127.
            // Therefore, in order to optimize the data, we choose tinyint
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedTinyInteger('storeys')->nullable();
            $table->unsignedTinyInteger('garages')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
