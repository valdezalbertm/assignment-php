<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeysTable extends Migration
{
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keys');
    }
}
