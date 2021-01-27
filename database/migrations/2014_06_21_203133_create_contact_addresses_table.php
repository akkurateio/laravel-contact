<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_addresses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->string('name')->nullable();
            $table->string('housenumber')->nullable();
            $table->string('street1');
            $table->string('street2')->nullable();
            $table->string('street3')->nullable();
            $table->string('postcode');
            $table->string('city');
            $table->integer('priority')->nullable();
            $table->boolean('is_default')->nullable()->default(1);
            $table->boolean('is_active')->nullable()->default(1);
            $table->morphs('addressable');
            $table->timestamps();
            $table->foreignId('type_id')->nullable()->default(1)->constrained('contact_types')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('contact_departments')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_addresses');
    }
}
