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
        Schema::create('participant_field_values', function (Blueprint $table) {
            $table->id();

            // publishers.pid هو INT(11) signed ⇒ خَلّي النوع INT signed
            $table->integer('participant_id');

            // event_fields.id عادة BIGINT افتراض لاراڤيل؟ نحن أنشأناه id() ⇒ BIGINT UNSIGNED
            // لكن بما إننا للتناسق، خلّيه BIGINT UNSIGNED هنا:
            $table->unsignedBigInteger('field_id');

            $table->longText('value')->nullable();
            $table->timestamps();

            $table->foreign('participant_id')
                ->references('pid')->on('publishers')
                ->onDelete('cascade');

            $table->foreign('field_id')
                ->references('id')->on('event_fields')
                ->onDelete('cascade');

            $table->unique(['participant_id','field_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_field_values');
    }
};
