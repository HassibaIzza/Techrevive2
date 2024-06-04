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
            $table->decimal('prix', 10, 2)->nullable()->after('status');
            $table->string('modele')->nullable()->after('prix');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        {
            Schema::table('rendez_vouses', function (Blueprint $table) {
                $table->dropColumn('prix');
                $table->dropColumn('modele');
            });
        }
    }
};
