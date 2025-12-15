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
            $seriPerGrade[$grade] = Barangs::where('grade', $grade)->max('no_seri') ?? 0;
        }

        // Tambah nomor seri hanya untuk grade ini
        $seriPerGrade[$grade]++;

        // Hitung nilai lain
        $bruto = $this->faker->numberBetween(40, 100);
        $netto = $bruto > 50 ? $bruto - 3 : $bruto - 2;
        $harga = $this->faker->numberBetween(10000, 100000);
        $jumlah = $harga * $netto;

        return [
            'tanggal' => $this->faker->date(),
            'nama' => $this->faker->name(),
            'daerah' => $this->faker->city(),
            'no_seri' => $seriPerGrade[$grade],   // ← sudah urut per grade
            'grade' => $grade,
            'bruto' => $bruto,
            'netto' => $netto,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'pelanggan_id' => Pelanggans::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
