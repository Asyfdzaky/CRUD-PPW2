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
        Schema::create('books',function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('harga');
            $table->string('tanggal_terbit');
            $table->string('image');
            $table->boolean('editorial_pick')->default(0);
            $table->integer("discount")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
