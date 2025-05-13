<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        $genders = ['L', 'P'];
        $customerTypes = ['first buyer', 'replacement', 'additional'];
        $customerCategories = ['retail', 'fleet'];
        $progresses = ['DO', 'SPK', 'pending', 'reject', 'tidak valid'];
        $carModels = [
            'Toyota Avanza', 'Toyota Fortuner', 'Toyota Innova',
            'Honda CR-V', 'Honda HR-V', 'Honda Brio',
            'Mitsubishi Xpander', 'Mitsubishi Pajero', 'Mitsubishi Triton',
            'Suzuki Ertiga', 'Suzuki XL7', 'Suzuki Carry',
            'Daihatsu Terios', 'Daihatsu Xenia', 'Daihatsu Sigra',
            'Hyundai Creta', 'Hyundai Stargazer', 'Hyundai Palisade'
        ];

        $salesmen = DB::table('user')
            ->where('role', 'salesman')
            ->pluck('id');

        $branches = DB::table('branches')
            ->pluck('id');

        // Generate 500 customer records
        for ($i = 1; $i <= 500; $i++) {
            $gender = $genders[array_rand($genders)];
            $firstName = $this->generateIndonesianName($gender);
            $lastName = $this->generateIndonesianLastName();

            $createdAt = Carbon::now()
                ->subDays(rand(0, 365))
                ->subHours(rand(0, 23))
                ->subMinutes(rand(0, 59));

            $savedStatus = rand(0, 100) > 30; // 70% chance of being saved

            Customer::create([
                'branch_id' => $branches->random(),
                'salesman_id' => $salesmen->random(),
                'nama' => $firstName . ' ' . $lastName,
                'alamat' => $this->generateIndonesianAddress(),
                'nomor_hp_1' => '08' . rand(100000000, 999999999),
                'nomor_hp_2' => rand(0, 1) ? '08' . rand(100000000, 999999999) : null,
                'kelurahan' => 'Kel. ' . $this->generateIndonesianPlaceName(),
                'kecamatan' => 'Kec. ' . $this->generateIndonesianPlaceName(),
                'kota' => $this->generateIndonesianCity(),
                'tanggal_lahir' => Carbon::now()
                    ->subYears(rand(20, 60))
                    ->subMonths(rand(0, 11))
                    ->subDays(rand(0, 30))
                    ->format('Y-m-d'),
                'jenis_kelamin' => $gender,
                'tipe_pelanggan' => $customerTypes[array_rand($customerTypes)],
                'jenis_pelanggan' => $customerCategories[array_rand($customerCategories)],
                'pekerjaan' => $this->generateIndonesianJob(),
                'tenor' => rand(0, 1) ? rand(12, 60) : null,
                'tanggal_gatepass' => $savedStatus
                    ? $createdAt->copy()->addDays(rand(1, 30))->format('Y-m-d')
                    : null,
                'model_mobil' => $carModels[array_rand($carModels)],
                'nomor_rangka' => strtoupper(fake()->bothify('??#########')),
                'sumber_data' => fake()->randomElement(['Walk-in', 'Referral', 'Website', 'Event', 'Telemarketing']),
                'progress' => rand(0, 1) ? $progresses[array_rand($progresses)] : null,
                'saved' => $savedStatus,
                'alasan' => rand(0, 1) ? 'N/A' : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt->copy()->addDays(rand(0, 30)),
            ]);
        }
    }

    private function generateIndonesianName($gender)
    {
        $maleNames = ['Budi', 'Agus', 'Joko', 'Eko', 'Hadi', 'Rudi', 'Ahmad', 'Dedi', 'Fajar', 'Gunawan'];
        $femaleNames = ['Ani', 'Dewi', 'Siti', 'Rini', 'Linda', 'Maya', 'Nina', 'Rina', 'Sari', 'Wati'];

        return $gender == 'L'
            ? $maleNames[array_rand($maleNames)]
            : $femaleNames[array_rand($femaleNames)];
    }

    private function generateIndonesianLastName()
    {
        $lastNames = ['Santoso', 'Wijaya', 'Prabowo', 'Hidayat', 'Kusuma', 'Setiawan', 'Suryanto'];
        return $lastNames[array_rand($lastNames)];
    }

    private function generateIndonesianAddress()
    {
        $streets = ['Jl. Merdeka', 'Jl. Sudirman', 'Jl. Thamrin', 'Jl. Gatot Subroto', 'Jl. Hayam Wuruk'];
        return $streets[array_rand($streets)] . ' No. ' . rand(1, 200) . ', ' . $this->generateIndonesianCity();
    }

    private function generateIndonesianCity()
    {
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Yogyakarta', 'Denpasar'];
        return $cities[array_rand($cities)];
    }

    private function generateIndonesianPlaceName()
    {
        $places = ['Menteng', 'Kebayoran', 'Cilandak', 'Pondok Indah', 'Kemang', 'Grogol', 'Tanjung Duren'];
        return $places[array_rand($places)];
    }

    private function generateIndonesianJob()
    {
        $jobs = [
            'Pegawai Negeri', 'Wiraswasta', 'Dokter', 'Guru', 'Pengusaha',
            'Karyawan Swasta', 'Pegawai Bank', 'Arsitek', 'Insinyur', 'Akuntan'
        ];
        return $jobs[array_rand($jobs)];
    }
}
