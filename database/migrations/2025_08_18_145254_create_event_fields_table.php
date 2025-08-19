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
        Schema::create('event_fields', function (Blueprint $table) {
            $table->id();

            // NOTE: eid في الأب INT(11) signed ⇒ لازم INT signed هنا أيضاً
            $table->integer('event_id'); // NOT unsigned

            $table->string('name');
            $table->string('label');
            $table->string('type');                // text, email, number, date, select, checkbox, file...
            $table->json('options')->nullable();
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);  // signed تمام
            $table->timestamps();

            $table->foreign('event_id')
                ->references('eid')->on('events')
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
        Schema::dropIfExists('event_fields');
    }
};
