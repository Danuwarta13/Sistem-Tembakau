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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggans');
            $table->date('tanggal');
            $table->string('nama');
            $table->string('daerah');
            $table->integer('no_seri');
            $table->string('grade');
            $table->decimal('bruto', 10, 2);   // 55,5
            $table->decimal('netto', 10, 2);   // 52,5
            $table->bigInteger('harga');       // 53000
            $table->bigInteger('jumlah');      // 2782500
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
