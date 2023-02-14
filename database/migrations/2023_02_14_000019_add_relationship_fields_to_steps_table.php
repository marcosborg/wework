<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStepsTable extends Migration
{
    public function up()
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->unsignedBigInteger('funnel_id')->nullable();
            $table->foreign('funnel_id', 'funnel_fk_7997105')->references('id')->on('funnels');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id', 'state_fk_7997408')->references('id')->on('states');
        });
    }
}
