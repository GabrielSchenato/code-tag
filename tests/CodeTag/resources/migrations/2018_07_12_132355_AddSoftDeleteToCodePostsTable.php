<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Description of AddSoftDeleteToCodePostsTable
 *
 * @author gabriel
 */
class AddSoftDeleteToCodePostsTable extends Migration
{

    public function up()
    {
        Schema::table('codepress_posts', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('codepress_posts', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }

}
