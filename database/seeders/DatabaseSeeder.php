<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun uji (password semuanya: "password")
        $admin  = User::factory()->create(['name' => 'Admin',      'email' => 'admin@example.com',  'role' => 'admin']);
        $editor = User::factory()->create(['name' => 'Editor',     'email' => 'editor@example.com', 'role' => 'editor']);
        $user   = User::factory()->create(['name' => 'User Biasa', 'email' => 'user@example.com',   'role' => 'user']);

        $tags = collect(['Terbaru', 'Diskon', 'Terlaris', 'Premium', 'Hemat'])
            ->map(fn ($nama) => Tag::create(['name' => $nama]));

        // kategori => [[harga min, harga max], [daftar produk]]
        $katalog = [
            'Elektronik' => [[150000, 8000000], [
                'Smartphone Xiaomi Redmi Note 13', 'Laptop ASUS Vivobook 14', 'Earbuds JBL Wave Beam',
                'Smartwatch Amazfit Bip 5', 'Power Bank Anker 10000mAh', 'Keyboard Mechanical Keychron K2',
                'Mouse Logitech M331', 'Monitor LG 24 Inci', 'Speaker Bluetooth Sony SRS-XB13']],
            'Fashion' => [[50000, 900000], [
                'Kaos Polos Cotton Combed 30s', 'Kemeja Flanel Kotak', 'Celana Chino Slim Fit',
                'Jaket Hoodie Fleece', 'Sepatu Sneakers Putih', 'Tas Ransel Laptop Waterproof',
                'Topi Baseball Hitam', 'Jam Tangan Casio MTP-VD01', 'Dompet Kulit Pria']],
            'Makanan & Minuman' => [[10000, 150000], [
                'Kopi Arabika Gayo 250g', 'Teh Hijau Organik 50 Kantong', 'Keripik Singkong Balado',
                'Madu Hutan Murni 500ml', 'Cokelat Batang 72% Cacao', 'Mie Instan Goreng Isi 10',
                'Sambal Bawang Botol', 'Granola Madu Kacang', 'Biskuit Gandum Diet']],
            'Buku' => [[40000, 250000], [
                'Belajar Laravel dari Nol', 'Pemrograman PHP untuk Pemula', 'Algoritma dan Struktur Data',
                'Clean Code', 'Basis Data dengan MySQL', 'Desain UI/UX Praktis',
                'Pengantar Jaringan Komputer', 'Matematika Diskrit', 'Atomic Habits Edisi Indonesia']],
            'Rumah Tangga' => [[20000, 1500000], [
                'Rice Cooker Miyako 1.8L', 'Set Panci Anti Lengket 5 Pcs', 'Lampu LED Philips 12W',
                'Sapu Lantai Microfiber', 'Botol Minum Stainless 750ml', 'Blender Philips 2L',
                'Dispenser Air Galon Bawah', 'Setrika Uap Listrik', 'Kipas Angin Meja 12 Inci']],
            'Olahraga' => [[30000, 1200000], [
                'Matras Yoga Anti Slip', 'Dumbbell Set 10kg', 'Sepatu Lari Ringan',
                'Raket Badminton Yonex', 'Bola Futsal Ukuran 4', 'Skipping Rope Speed',
                'Resistance Band Set', 'Tas Gym Duffle', 'Sarung Tangan Gym']],
        ];

        foreach ($katalog as $namaKategori => [$harga, $daftar]) {
            $kategori = Category::create(['name' => $namaKategori]);

            foreach ($daftar as $namaProduk) {
                $produk = Product::factory()->create([
                    'category_id' => $kategori->id,
                    'user_id'     => $admin->id,
                    'name'        => $namaProduk,
                    'description' => "{$namaProduk} original, kondisi baru, siap kirim.",
                    'price'       => (int) (round(rand($harga[0], $harga[1]) / 1000) * 1000),
                    'stock'       => rand(0, 80),
                ]);
                $produk->tags()->attach($tags->random(rand(1, 2))->pluck('id'));
            }
        }

        // Pesanan contoh untuk user biasa
        foreach (range(1, 5) as $i) {
            $order = Order::create([
                'user_id' => $user->id,
                'status'  => collect(['pending', 'paid', 'shipped'])->random(),
            ]);
            foreach (Product::inRandomOrder()->take(rand(1, 3))->get() as $p) {
                $order->items()->create([
                    'product_id' => $p->id,
                    'quantity'   => rand(1, 3),
                    'price'      => $p->price,
                ]);
            }
        }

        // 12 post blog nyata (milik user dan editor)
        $this->call(PostSeeder::class);
    }
}