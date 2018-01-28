<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserBranches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('user_branches', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('branch_id')->unsigned();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->foreign('branch_id')
                    ->references('id')
                    ->on('branches')
                    ->onDelete('cascade');

                $table->primary(['user_id', 'branch_id']);
            });
        } catch (PDOException $ex) {
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
        Schema::dropIfExists('user_branches');
    }
}
