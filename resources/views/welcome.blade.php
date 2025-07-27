<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Untuk favicon PNG -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <!-- AOS Animate On Scroll CDN -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-white text-gray-900">

    <!-- Header -->
    <header class="bg-gray-100 shadow p-6 flex justify-between items-center sticky top-0 z-50">
        <x-application-logo />
        <nav class="space-x-6 text-sm font-medium">
            <a href="#order" class="hover:underline">Pesan Sekarang</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen text-white text-center flex items-center justify-center overflow-hidden">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
            <source src="{{ asset('images/video-fish.mp4') }}" type="video/mp4">
            Pakan Ikan
        </video>

        <!-- Overlay hitam agar teks tetap terbaca -->
        <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 z-10"></div>

        <!-- Konten Teks -->
        <div class="relative z-20 p-8 rounded" data-aos="zoom-in">
            <h2 class="text-4xl md:text-6xl font-semibold mb-4">Solusi Lengkap Pakan Ikan</h2>
            <p class="text-lg md:text-xl">Lengkap, Terjangkau, dan Terjamin!</p>
        </div>
    </section>


    <!-- Features -->
    <section id="order" class="py-20 px-6 max-w-6xl mx-auto">
        <h3 class="text-4xl font-semibold mb-12 text-center" data-aos="fade-up">Pesan Sekarang</h3>
        <div class="grid md:grid-cols-3 gap-12">
            <!-- TOKOPEDIA -->
            <div class="flex flex-col items-center text-center gap-y-4" data-aos="fade-up" data-aos-delay="100">
                <a href="https://tokopedia.link/chiamon" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia"
                        class="w-24 md:w-28 mx-auto hover:scale-105 transition-transform">
                </a>
                <p class="text-gray-600 px-2">Sering Diskon & Pengiriman Cepat</p>
            </div>

            <!-- TIKTOKSHOP -->
            <div class="flex flex-col items-center text-center gap-y-4" data-aos="fade-up" data-aos-delay="200">
                <a href="https://vt.tokopedia.com/t/ZSkKFQece/" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/tiktokshop.png') }}" alt="Tiktokshop"
                        class="w-24 md:w-28 mx-auto hover:scale-105 transition-transform">
                </a>
                <p class="text-gray-600 px-2">Sering Diskon & Pengiriman Cepat</p>
            </div>

            <!-- WA -->
            <div class="flex flex-col items-center text-center gap-y-4" data-aos="fade-up" data-aos-delay="300">
                <a href="http://wa.me/6285157385001" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/wa.png') }}" alt="Whatsapp"
                        class="w-24 md:w-28 mx-auto hover:scale-105 transition-transform">
                </a>
                <p class="text-gray-600 px-2">Pesan Jumlah Banyak & Kirim luar Jabodetabek</p>
            </div>
        </div>
    </section>

    @php
        $gallery = [
            [
                'img' => asset('images/udang-rawa.png'),
                'desc' =>
                    'Udang Rawa adalah pakan ikan cocok untuk ikan predator & arwana. Setiap kemasan berisi 500gr, memberikan nutrisi optimal untuk pertumbuhan ikan Anda.',
            ],
            [
                'img' => asset('images/cacing-beku.png'),
                'desc' =>
                    'Cacing Beku Pakan Ikan Fresh adalah produk yang dirancang khusus untuk ikan. Setiap kemasan berisi 500gr, cocok untuk kebutuhan pakan ikan Anda.',
            ],
            [
                'img' => asset('images/kutu-air.png'),
                'desc' =>
                    'Kutu air adalah pakan ikan cocok untuk ikan cupang. Setiap kemasan berisi 500gr, memberikan nutrisi optimal untuk pertumbuhan ikan Anda',
            ],
        ];
    @endphp



    <!-- Gallery Section -->
    <section class="py-12">
        <div x-data="{
            show: false,
            img: '',
            desc: '',
            open(item) {
                this.img = item.img;
                this.desc = item.desc;
                this.show = true;
            },
            close() {
                this.show = false;
            }
        }">
            <!-- Gallery -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($gallery as $item)
                    <div class="bg-white rounded shadow cursor-pointer hover:scale-105 transition" data-aos="fade-down"
                        @click="open({img: '{{ $item['img'] }}', desc: '{{ $item['desc'] }}'})">
                        <img src="{{ $item['img'] }}" alt="gallery" class="rounded-t w-full h-40 object-cover">
                        <div class="p-2 text-sm text-center">{{ $item['desc'] }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Modal -->
            <div x-show="show" style="display: none"
                class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-60">
                <div class="bg-white rounded-xl p-6 max-w-md w-full relative shadow-lg">
                    <!-- Tombol X -->
                    <button @click="close"
                        class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-2xl font-bold focus:outline-none">&times;</button>
                    <img :src="img" alt="detail" class="rounded w-full mb-4 max-h-72 object-contain">
                    <div class="text-center text-lg font-semibold mb-2" x-text="desc"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center text-sm text-gray-500 py-6">
        &copy; 2025 Chiamonshop | made by <a href="https://github.com/kthrzsyh" target="_blank"
            class="text-blue-500 hover:underline">kthrzsyh</a>
    </footer>

    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>

</body>

</html>
