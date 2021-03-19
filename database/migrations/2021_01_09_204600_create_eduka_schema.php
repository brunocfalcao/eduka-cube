<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdukaSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                  ->comment('Your awesome course name');

            $table->string('admin_email')
                  ->comment('The admin email used to login on the admin panel');

            $table->longText('meta')
                  ->comment('The HTML meta attributes')
                  ->nullable();

            $table->dateTimeTz('launched_at')
                  ->comment('The launch date time of your course')
                  ->nullable();

            $table->engine = 'InnoDB';
        });

        Schema::create('application_log', function (Blueprint $table) {
            $table->id();

            $table->foreignId('causer_id')
                  ->comment('The user id in cause, if authenticated.')
                  ->nullable();

            $table->string('process')
                  ->comment('A process hash code that will allow to group actions');

            $table->string('description')
                  ->comment('A natural description of the activity')
                  ->nullable();

            $table->longText('parameters')
                  ->nullable();

            $table->unsignedBigInteger('loggable_id')
                  ->nullable();

            $table->string('loggable_type')
                  ->nullable();

            $table->foreign('causer_id')->references('id')->on('users');

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                  ->nullable();

            $table->string('email')
                  ->unique();

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('subscriber_id')
                  ->comment('The respective subscriber in case it exists')
                  ->nullable()
                  ->after('email')
                  ->constrained();
        });

        Schema::create('chapters', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')
                  ->comment('Chapter uuid for routing reasons')
                  ->nullable();

            $table->string('title')
                  ->comment('The chapter title');

            $table->string('introduction')
                  ->comment('The short, straight, chapter introduction');

            $table->string('details')
                  ->comment('A longer version of the introduction')
                  ->nullable();

            $table->unsignedInteger('index')
                  ->comment('The chapter index, giving the correct chapter order')
                  ->nullable();

            $table->boolean('is_enabled')
                  ->default(false);

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')
                  ->comment('Video uuid for routing reasons')
                  ->nullable();

            $table->string('title')
                  ->comment('The video title');

            $table->string('introduction')
                  ->comment('The short, straight, video introduction');

            $table->string('details')
                  ->comment('A longer version of the introduction')
                  ->nullable();

            $table->unsignedBigInteger('vimeo_id')
                  ->comment('Vimeo video id (should be not visible in Vimeo in case it is a premium video)')
                  ->unique()
                  ->nullable();

            $table->string('backblaze_filename')
                  ->comment('The backblaze storage filename, so it would be able to download the video')
                  ->unique()
                  ->nullable();

            $table->unsignedInteger('duration')
                  ->comment('Video duration, in seconds')
                  ->nullable();

            $table->foreignId('chapter_id')
                  ->comment('The respective chapter that the video belongs to')
                  ->nullable()
                  ->constrained();

            $table->unsignedInteger('index')
                  ->comment('The video index, giving the correct videos chapter orderings')
                  ->nullable();

            $table->boolean('is_enabled')
                  ->comment('Defines if a video is enabled (can be visible, and/or clickable) for the users, if the video is between the published and archived dates')
                  ->default(false);

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained();

            $table->foreignId('video_id')
                  ->constrained();

            $table->softDeletes();

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('watch_later', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained();

            $table->foreignId('video_id')
                  ->constrained();

            $table->softDeletes();

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('marked_as_seen', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained();

            $table->foreignId('video_id')
                  ->constrained();

            $table->softDeletes();

            $table->engine = 'InnoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
