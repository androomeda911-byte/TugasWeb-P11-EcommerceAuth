<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
                $user   = User::where('email', 'user@example.com')->first();
        $editor = User::where('email', 'editor@example.com')->first();

        $daftar = [
            [
                'title' => 'Mengenal Laravel: Framework PHP yang Rapi dan Ekspresif',
                'body'  => 'Laravel adalah framework PHP yang menerapkan pola MVC. Struktur foldernya tetap, sehingga kode lebih rapi dan mudah dikerjakan bersama. Laravel juga menyediakan fitur bawaan seperti routing, validasi, dan Eloquent ORM.',
            ],
            [
                'title' => 'Cara Kerja MVC dalam Aplikasi Web',
                'body'  => 'MVC memisahkan aplikasi menjadi Model untuk data, View untuk tampilan, dan Controller untuk logika. Saat browser membuka sebuah URL, route meneruskannya ke controller, controller mengambil data lewat model, lalu mengirimkannya ke view.',
            ],
            [
                'title' => 'Migration: Membuat Tabel Lewat Kode',
                'body'  => 'Migration memungkinkan struktur database ditulis sebagai kode PHP. Dengan satu perintah php artisan migrate, seluruh tabel dibuat otomatis, dan perubahan struktur bisa dilacak lewat Git seperti file lainnya.',
            ],
            [
                'title' => 'Eloquent ORM: Query Tanpa Menulis SQL',
                'body'  => 'Di Eloquent, setiap tabel diwakili sebuah model. Perintah seperti Post::latest()->paginate(5) mengambil data terbaru dan membaginya per halaman tanpa menulis query SQL secara manual.',
            ],
            [
                'title' => 'Blade Template: Tampilan yang Bisa Dipakai Ulang',
                'body'  => 'Blade memungkinkan satu layout dipakai bersama oleh banyak halaman lewat @extends dan @yield. Sintaks kurung kurawal ganda juga otomatis melindungi dari serangan XSS, sehingga aman menampilkan input pengguna.',
            ],
            [
                'title' => 'Validasi Form di Laravel',
                'body'  => 'Method validate() memeriksa input sebelum disimpan. Bila ada yang salah, pengguna dikembalikan ke form lengkap dengan pesan error dan isian sebelumnya, sehingga tidak perlu mengetik ulang dari awal.',
            ],
            [
                'title' => 'Apa Itu CSRF dan Kenapa Form Butuh @csrf',
                'body'  => 'CSRF adalah serangan yang membuat pengguna tanpa sadar mengirim permintaan ke situs tempat ia sedang login. Token yang dipasang oleh @csrf memastikan permintaan benar-benar berasal dari form di situs sendiri.',
            ],
            [
                'title' => 'Memakai Git untuk Tugas Kuliah',
                'body'  => 'Git menyimpan riwayat perubahan project. Alur dasarnya adalah git add, git commit, lalu git push ke GitHub. Dengan begitu pekerjaan tersimpan aman dan mudah dibagikan ke dosen atau teman satu kelompok.',
            ],
            [
                'title' => 'Composer: Pengelola Paket PHP',
                'body'  => 'Composer mengunduh library yang dibutuhkan project dan mencatatnya di composer.json. Folder vendor berisi hasil unduhan itu, jadi tidak perlu diunggah ke GitHub karena bisa dibuat ulang dengan composer install.',
            ],
            [
                'title' => 'Tips Mengatur File .env',
                'body'  => 'File .env menyimpan pengaturan rahasia seperti koneksi database dan tidak boleh diunggah ke GitHub. Sebagai gantinya, sediakan .env.example agar orang lain tahu pengaturan apa saja yang perlu mereka isi.',
            ],
            [
                'title' => 'Pagination: Membagi Data per Halaman',
                'body'  => 'Pagination mencegah halaman memuat ribuan data sekaligus. Cukup memanggil paginate(5) di controller dan menampilkan tautan halaman di view, maka Laravel membuat navigasi halamannya secara otomatis.',
            ],
            [
                'title' => 'Mengapa Tailwind CSS Populer',
                'body'  => 'Tailwind menyediakan kelas utilitas kecil seperti p-4 atau text-center yang bisa digabungkan langsung di HTML. Pendekatan ini mempercepat pembuatan tampilan tanpa harus berpindah-pindah ke file CSS terpisah.',
            ],
        ];

        foreach ($daftar as $i => $item) {
            $post = new Post($item);
            $post->user_id = ($i % 3 === 0) ? $editor->id : $user->id;
            $post->created_at = now()->subDays($i);
            $post->save();
        }
    }
}