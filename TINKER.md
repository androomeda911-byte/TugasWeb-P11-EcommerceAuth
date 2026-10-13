# Dokumentasi 5 Query Tinker

| No | Query | Penjelasan | Bukti |
|---|---|---|---|
| 1 | `Product::count()` | Menghitung jumlah seluruh produk | screenshot/tinker-1.png |
| 2 | `Product::with('category')->first()` | Mengambil satu produk sekaligus kategorinya (eager loading) | screenshot/tinker-2.png |
| 3 | `User::where('email', ...)->first()->orders->count()` | Menghitung pesanan milik user lewat relasi hasMany | screenshot/tinker-3.png |
| 4 | `Order::with('items')->first()->items->sum(...)` | Menghitung total harga satu pesanan | screenshot/tinker-4.png |
| 5 | `Product::whereRelation(...)->inStock()->get()` | Produk Elektronik yang stoknya ada (scope inStock) | screenshot/tinker-5.png |