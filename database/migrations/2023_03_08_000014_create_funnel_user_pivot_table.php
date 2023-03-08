<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunnelUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('funnel_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_8151220')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('funnel_id');
            $table->foreign('funnel_id', 'funnel_id_fk_8151220')->references('id')->on('funnels')->onDelete('cascade');
        });
    }
}