<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Description of CreateCodeCategoriesTable
 *
 * @author gabriel
 */
class CreateCodeCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('codepress_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable(true)->unsigned();
            $table->foreign('parent_id')->references('id')->on('codepress_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('codepress_categories');
    }

}
