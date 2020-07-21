<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sheet_id');
            $table->text('source_link')->nullable();
            $table->string('company_Name')->index()->nullable();
            $table->string('contact_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email_address')->nullable();
            $table->string('title')->index()->nullable();
            $table->string('tag')->index()->nullable();
            $table->string('phone_number')->nullable();
            $table->text('web_link')->nullable();
            $table->string('review_by')->nullable();
            $table->text('linkedin_link')->nullable();
            $table->string('company_linkedin')->nullable();
            $table->string('working_duration')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->index()->nullable();
            $table->string('state')->index()->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->index()->nullable();
            $table->timestamps();

            $table->foreign('sheet_id')->references('id')->on('sheets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
