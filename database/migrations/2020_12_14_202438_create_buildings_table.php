<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('number');
            $table->unsignedTinyInteger('status')->default(0);
            $table->text('notes')->nullable();
            $table->dateTime('checked_at')->nullable();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('period_id')->nullable()->constrained('periods')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
