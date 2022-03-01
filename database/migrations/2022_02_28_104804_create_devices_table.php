<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * Назови модель Device
Таблицу devices

Поля будут
serial_number - сможешь найти примеры в файле
creator_id - связь с users, это тот кто создал или загрузил девайс (тот кто авторизован, не приходит с клиента)
address_id - это связь с адресами

Должна быть возможность создавать в ручную или загрузка с файла
Должна быть возможность менять адрес, адреса могут менять только админы
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("serial_number");
            $table->unsignedBigInteger("creator_id");
            $table->unsignedBigInteger("address_id");
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign("address_id")->references("id")->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
