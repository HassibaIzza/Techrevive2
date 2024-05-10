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
        Schema::table('rendez_vouses', function (Blueprint $table) {
                $table->unsignedBigInteger('client_id')->nullable(); // Ajoutez nullable si la clé peut être nulle
                $table->foreign('client_id')->references('id')->on('users')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rendez_vouses', function (Blueprint $table) {
            
                $table->dropForeign(['client_id']); // Laravel 5.8+ utilise une syntaxe simplifiée pour dropForeign
                $table->dropColumn('client_id');
           
        });
    }
};
