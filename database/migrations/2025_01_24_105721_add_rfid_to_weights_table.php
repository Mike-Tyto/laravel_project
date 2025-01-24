<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRfidToWeightsTable extends Migration
{
    public function up()
    {
        Schema::table('weights', function (Blueprint $table) {
            $table->string('rfid')->after('id'); // Добавляем колонку rfid
        });
    }

    public function down()
    {
        Schema::table('weights', function (Blueprint $table) {
            $table->dropColumn('rfid'); // Удаляем колонку rfid
        });
    }
}
