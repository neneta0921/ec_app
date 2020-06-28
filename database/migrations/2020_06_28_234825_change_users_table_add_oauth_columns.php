<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTableAddOauthColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('remember_token')->comment('アバター画像');
            $table->unsignedBigInteger('twitter_id')->nullable()->after('remember_token')->comment('Twitter ID');
            $table->unsignedBigInteger('facebook_id')->nullable()->after('remember_token')->comment('Facebook ID');
            $table->unsignedBigInteger('github_id')->nullable()->after('remember_token')->comment('GitHub ID');
            $table->unsignedBigInteger('google_id')->nullable()->after('remember_token')->comment('Google ID');
            $table->unsignedBigInteger('yahoo_id')->nullable()->after('remember_token')->comment('Yahoo ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('twitter_id');
            $table->dropColumn('facebook_id');
            $table->dropColumn('github_id');
            $table->dropColumn('google_id');
            $table->dropColumn('yahoo_id');
        });
    }
}