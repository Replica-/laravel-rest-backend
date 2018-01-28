<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserOrganisations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try{
            Schema::create('user_organisations', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('organisation_id')->unsigned();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->foreign('organisation_id')
                    ->references('id')
                    ->on('organisations')
                    ->onDelete('cascade');

                $table->primary(['user_id', 'organisation_id']);
            });
        } catch(PDOException $ex){
            $this->down();
            throw $ex;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_organisations');
    }
}
