<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestLogTables extends Migration
{
    private $tableName = 'request_logs';
    private $tableNameEvents = 'request_log_events';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('request_log')) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->timestamp('created_at');
                $table->string('remote_address');
                $table->string('method');
                $table->string('route');
                $table->string('return_code')->nullable();
                $table->bigInteger('request_id')->unsigned()->nullable();
                $table->bigInteger('response_id')->unsigned()->nullable();
                $table->index('created_at');
            });
            Schema::create($this->tableNameEvents, function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->bigInteger('parent_id')->unsigned();
                $table->text('headers')->nullable();
                $table->text('body')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->tableNameEvents);
        Schema::drop($this->tableName);
    }
}
