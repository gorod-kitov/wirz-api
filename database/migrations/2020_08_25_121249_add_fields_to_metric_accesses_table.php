<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToMetricAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metric_accesses', function (Blueprint $table) {
            $table->text('number_description')->nullable()->after("is_active");
            $table->integer('kpi')->nullable()->after("number_description");
            $table->text('description')->nullable()->after("kpi");
            $table->integer('percent')->nullable()->after("description");
            $table->text('percent_text')->nullable()->after("percent");
            $table->integer('campaign_id')->nullable()->after("is_active");
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))
                ->after("percent");
            $table->boolean('engagement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metric_accesses', function (Blueprint $table) {
            $table->dropColumn(['number_description', 'kpi', 'description', 'percent', 'percent_text', 'campaign_id','date','engagement']);
        });
    }
}
