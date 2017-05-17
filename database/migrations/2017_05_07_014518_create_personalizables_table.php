<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalizablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personalizables', function (Blueprint $table) {
            $table->string('tablas');
            });
            /*
            En cada fila iria el nombre del elemento personalizable, para luego consultar cada tabla por separado
            Al agregar un elemento personalizabel se deberá agregar una table y una fila en esta tabla
            */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
