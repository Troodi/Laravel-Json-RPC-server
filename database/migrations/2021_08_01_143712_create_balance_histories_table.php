<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceHistoriesTable extends Migration
{
    /**
     * Миграция для создания таблицы истории операций с балансом
     */
    public function up()
    {
        Schema::create('balance_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique()->index(); // Индекс по user_id
            $table->decimal('value', 16, 5)->nullable(); // В данном случае лучше decimal, а не float
            $table->decimal('balance', 16, 5)->nullable(); // В данном случае лучше decimal, а не float
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
        Schema::dropIfExists('balance_histories');
    }
}
