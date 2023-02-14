<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFunnelPivotTable extends Migration
{
    public function up()
    {
        Schema::create('company_funnel', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id', 'company_id_fk_7996157')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('funnel_id');
            $table->foreign('funnel_id', 'funnel_id_fk_7996157')->references('id')->on('funnels')->onDelete('cascade');
        });
    }
}
