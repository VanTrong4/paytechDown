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
    Schema::create('master_ads', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('code');
      $table->string('name');
      $table->string('remarks');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('master_ads');
  }
};
