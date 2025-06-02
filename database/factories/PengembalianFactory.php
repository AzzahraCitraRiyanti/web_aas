<?php

namespace Database\Factories;

use App\Models\Pengembalian;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengembalianFactory extends Factory
{
    protected $model = Pengembalian::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Menggunakan factory untuk User
            'barang_id' => Barang::factory(), // Menggunakan factory untuk Barang
            'tanggal_kembali' => $this->faker->date(),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
        ];
    }
}
