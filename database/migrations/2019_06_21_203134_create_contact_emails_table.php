<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_emails', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name')->nullable();
            $table->string('email');
            $table->integer('priority')->nullable();
            $table->boolean('is_default')->nullable()->default(0);
            $table->boolean('is_active')->nullable()->default(1);
            $table->morphs('emailable');
            $table->timestamps();
            $table->foreignId('type_id')->nullable()->default(1)
                ->constrained('contact_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_emails');
    }
}
