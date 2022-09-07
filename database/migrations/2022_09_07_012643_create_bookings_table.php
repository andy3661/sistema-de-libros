<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('bookings', function (Blueprint $table) {
        //     $table->id();
        //     $table->date('reservation_date');
        //     $table->integer('reservation_days');
        //     $table->unsignedBigInteger('id_user');
        //     $table->unsignedBigInteger('id_book');
        //     $table->timestamps();
        //     $table->foreign("id_user")
        //         ->references("id")
        //         ->on("users")
        //         ->onDelete("cascade")
        //         ->onUpdate("cascade");
        //         $table->foreign("id_book")
        //         ->references("id")
        //         ->on("books")
        //         ->onDelete("cascade")
        //         ->onUpdate("cascade");
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
