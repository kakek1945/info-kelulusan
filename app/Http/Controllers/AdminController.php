<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class AdminController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('admin.index', compact('students'));
    }

    public function create()
    {
        return view('admin.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nisn' => 'required|numeric|unique:students,nisn',
            'name' => 'required|string|max:255',
            'status' => 'required|in:Lulus,Tidak Lulus,Ditunda',
            'message' => 'nullable|string'
        ]);

        Student::create($data);
        return redirect()->route('admin.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Student $student)
    {
        return view('admin.form', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'nisn' => 'required|numeric|unique:students,nisn,'.$student->id,
            'name' => 'required|string|max:255',
            'status' => 'required|in:Lulus,Tidak Lulus,Ditunda',
            'message' => 'nullable|string'
        ]);

        $student->update($data);
        return redirect()->route('admin.index')->with('success', 'Data siswa berhasil diubah.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=template-kelulusan.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['NISN', 'Nama Siswa', 'Status (Lulus/Tidak Lulus/Ditunda)', 'Pesan (Opsional)'];
        
        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns, ','); // Use comma as standard CSV
            fputcsv($file, ['1234567891', 'Contoh Siswa Lulus', 'Lulus', 'Selamat anda lulus!'], ',');
            fputcsv($file, ['1234567892', 'Contoh Siswa Gagal', 'Tidak Lulus', 'Mohon maaf anda tidak lulus.'], ',');
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:5120',
        ]);

        $file = $request->file('file');
        $content = file_get_contents($file->getPathname());
        $lines = explode(PHP_EOL, trim($content));
        
        if (count($lines) <= 1) {
            return redirect()->back()->with('error', 'File kosong atau format salah.');
        }

        $header = array_shift($lines);
        $delimiter = strpos($header, ';') !== false ? ';' : ','; // Detect delimiter (Indonesian excel uses ;)

        $count = 0;
        foreach ($lines as $line) {
            if (empty(trim($line))) continue;
            
            $row = str_getcsv($line, $delimiter);
            
            if (count($row) >= 3) {
                // Formatting status to avoid mismatch
                $rawStatus = trim($row[2]);
                $statusMap = [
                    'lulus' => 'Lulus',
                    'tidak lulus' => 'Tidak Lulus',
                    'ditunda' => 'Ditunda'
                ];
                $finalStatus = $statusMap[strtolower($rawStatus)] ?? 'Lulus';

                Student::updateOrCreate(
                    ['nisn' => trim($row[0])],
                    [
                        'name' => trim($row[1]),
                        'status' => $finalStatus,
                        'message' => isset($row[3]) && !empty(trim($row[3])) ? trim($row[3]) : null
                    ]
                );
                $count++;
            }
        }

        return redirect()->route('admin.index')->with('success', "$count Data siswa berhasil di-import dari file Excel/CSV!");
    }
}
