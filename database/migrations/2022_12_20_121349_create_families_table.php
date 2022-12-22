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
        Schema::create('families', function (Blueprint $table) {
            $table->id("fid");
            $table->text('firstname')->nullable();;
            $table->text('lastname')->nullable();
            $table->text('rooms')->nullable();
            $table->text('room_type')->nullable();
            $table->integer('linked')->default(0);
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->text('package_type')->nullable();
            $table->integer('family_size')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
};
