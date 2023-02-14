<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('vat')->nullable();
            $table->string('address')->nullable();
            $table->string('zip')->nullable();
            $table->string('location')->nullable();
            $table->string('email');
            $table->string('theme');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
