<?php

namespace Database\Factories;

use App\Models\Barangs;
use App\Models\Pelanggans;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barangs>
 */
class BarangsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Barangs::class;

    public function definition()
    {
        static $seriPerGrade = [];

        // Acak grade
        $grade = $this->faker->randomElement(['A', 'B', 'C']);

        // Jika array penampung belum punya grade tersebut → ambil dari database
        if (!isset($seriPerGrade[$grade])) {
            $maxDb = Barangs::where('grade', $grade)->max('no_seri');
            // Jika data kosong atau max < 2340, kita paksa mulai dari 2340 untuk test 4 digit
            $seriPerGrade[$grade] = ($maxDb && $maxDb > 2340) ? $maxDb : 2340;
        }

        // Tambah nomor seri hanya untuk grade ini
        $seriPerGrade[$grade]++;

        // Ambil data pelanggan yang ada di database secara acak
        $pelanggan = Pelanggans::inRandomOrder()->first();

        // Hitung nilai lain
        $bruto = $this->faker->numberBetween(40, 100);
        $netto = $bruto > 50 ? $bruto - 3 : $bruto - 2;
        $harga = $this->faker->numberBetween(10000, 100000);
        $jumlah = $harga * $netto;

        return [
            'tanggal' => now()->toDateString(), // <-- Set ke hari ini agar mudah dicari di dropdown
            'nama' => $pelanggan ? $pelanggan->nama : $this->faker->name(),
            'daerah' => $pelanggan ? $pelanggan->daerah : $this->faker->city(),
            'no_seri' => $seriPerGrade[$grade],   // ← sudah urut per grade
            'grade' => $grade,
            'bruto' => $bruto,
            'netto' => $netto,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'pelanggan_id' => $pelanggan ? $pelanggan->id : 1,
        ];
    }
}
