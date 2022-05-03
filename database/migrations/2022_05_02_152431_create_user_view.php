<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }


    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW view_user_data AS
                SELECT users.id,users.karma_score,
                RANK() OVER (ORDER BY users.karma_score DESC) 'position'
                ,(SELECT images.url FROM images WHERE users.image_id = images.id) AS image_url
                FROM users
                ORDER BY position
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_user_data`;
            SQL;
    }
};
