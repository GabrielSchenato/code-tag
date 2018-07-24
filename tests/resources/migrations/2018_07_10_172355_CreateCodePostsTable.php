<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use CodePress\CodePosts\Models\Post;
/**
 * Description of CreateCodePostsTable
 *
 * @author gabriel
 */
class CreateCodePostsTable extends Migration
{

    public function up()
    {
        Schema::create('codepress_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->binary('image');
            $table->text('content');
            $table->string('slug');
            $table->integer('state')->default(Post::STATE_DRAFT);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('codepress_posts');
    }

}
