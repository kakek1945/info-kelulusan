<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'nisn' => '1234567890',
                'name' => 'Budi Santoso',
                'status' => 'Lulus',
                'message' => 'Selamat, Anda dinyatakan lulus dengan hasil yang memuaskan!',
            ],
            [
                'nisn' => '0987654321',
                'name' => 'Siti Aminah',
                'status' => 'Tidak Lulus',
                'message' => 'Maaf, Anda dinyatakan tidak lulus karena nilai di bawah standar kelulusan. Tetap semangat belajar!',
            ],
            [
                'nisn' => '1122334455',
                'name' => 'Ahmad Reza',
                'status' => 'Ditunda',
                'message' => 'Kelulusan ditunda. Harap segera melengkapi administrasi ke tata usaha.',
            ]
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
