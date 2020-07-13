<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogoToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('logo')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('group_id')->nullable()->unsigned();
            $table->dropColumn('logo');
            $table->foreign('group_id')
                ->references('id')->on('groups')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('logo');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('logo');
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });
    }
}
