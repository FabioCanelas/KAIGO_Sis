<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
    {
        Schema::create('site_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section', 50);
            $table->string('setting_key', 100);
            $table->text('setting_value')->nullable();
            $table->timestamps();
            
            // Esto evita que creemos dos veces la misma configuración en la misma sección
            $table->unique(['section', 'setting_key'], 'unique_section_key');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_contents');
    }
};
