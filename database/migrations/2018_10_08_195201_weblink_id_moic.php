<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WeblinkIdMoic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moic_logs', function (Blueprint $table) {
            $table->integer('weblink_id')->after('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moic_logs', function (Blueprint $table) {
            $table->integer('weblink_id')->after('link');
        });
    }
}
