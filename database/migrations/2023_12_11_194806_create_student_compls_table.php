<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentComplsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_compls', function (Blueprint $table) {
            $table->id();
            $table->uuid('unique_identifier')->unique();
            $table->foreignId('user_id')->constrained(); // Assuming a relationship with a user table
            $table->foreignId('category_id')->constrained(); // Assuming a relationship with a categories table
            $table->text('description');
            $table->dateTime('date_of_occurence');
            $table->string('attachments')->nullable();
            $table->enum('status', ['submitted', 'in_progress', 'resolved'])->default('submitted');
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
        Schema::dropIfExists('student_compls');
    }
}
