<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('comment_id');
            $table->string('phone', 20);
            $table->string('address');
            $table->string('avatar');

            /**
             * relation
             */
            $table->foreign('comment_id')
                ->references('id')
                ->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_comments');
    }
}
