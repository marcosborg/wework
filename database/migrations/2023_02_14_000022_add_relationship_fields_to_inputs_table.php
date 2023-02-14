<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInputsTable extends Migration
{
    public function up()
    {
        Schema::table('inputs', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id', 'item_fk_7997244')->references('id')->on('items');
        });
    }
}
