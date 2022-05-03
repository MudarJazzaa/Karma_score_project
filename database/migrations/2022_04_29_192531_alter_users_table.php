<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('users', function (Blueprint $table) {
            $table->index(['karma_score', 'image_id']);
            $table->string('username')->unique();
            $table->integer('karma_score')->unsigned()->default(0);
            $table->foreignId('image_id')->nullable()->constrained('images')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->string('username')->unique();
        //     $table->integer('karma_score')->unsigned()->default(0);
        //     $table->foreignId('image_id')->nullable()->constrained('images')->onDelete('set null');
        // });
    }
};
