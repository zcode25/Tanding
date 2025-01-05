<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
      <div class="container mx-auto px-6 py-4 flex justify-between items-center">
          <a href="#" class="text-2xl font-bold text-indigo-600">Tanding</a>
          <ul class="flex space-x-6 items-center">
              <li><a href="#form" class="text-gray-700 hover:text-indigo-600">Daftar</a></li>
              <li>
                  <a href="/login" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                      Login
                  </a>
              </li>
          </ul>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-white py-20">
      <div class="container mx-auto text-center lg:px-80">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-indigo-600">
              <span class="text-black leading-normal">Raih Prestasi di Kejuaraan</span> Pencak Silat
          </h1>
          <p class="text-xl mt-7 text-gray-800 leading-normal">
              Bergabunglah dalam platform yang menyediakan informasi lengkap tentang kejuaraan olahraga beladiri. Temukan kompetisi sesuai bakatmu!
          </p>
          <a href="#form"
              class="mt-8 inline-block px-8 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">
              Lihat Jadwal dan Daftar
          </a>
      </div>
    </section>
  

    <section class="py-16">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                <div class="text-center">
                    <img class="w-full h-auto rounded-lg object-cover aspect-[16/9]" src="/img/screen.jpg" alt="image description">
                </div>
                <div class="flex items-center justify-center text-center lg:text-left">
                    <div>
                        <h3 class="text-5xl font-semibold text-indigo-600 leading-normal">Explore and joint Event</h3>
                        <p class="text-gray-800 mt-4">Kami adalah salah satu platform penyedia layanan informasi kejuaraan olahraga beladiri yang akan diselenggaran oleh event organizer atau penyelenggara kejuaraan olahraga khususnya pencak silat, kami menyediakan layanan dari promosi, pendaftaran, sound system, it scoring system sampai alat-alat untuk kejuaraan/pertandingan olahraga khususnya pencaksilat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto">
            <h2 class="text-5xl font-semibold text-center leading-normal text-indigo-600 mb-5">Event Kejuaran Pencak Silat</h2>
            <p class="text-lg mb-12 text-gray-800 leading-normal text-center">Bergabunglah dalam platform yang menyediakan informasi lengkap tentang kejuaraan olahraga beladiri. Temukan kompetisi sesuai bakatmu!</p>
            @foreach ($informations as $information)
              @php
                  $banner = $information->event->banners->first();
                  $competitions = $information->event->competitions;
              @endphp
              <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 border-2 border-indigo-600 rounded-2xl p-5 mb-10">
                  <div class="text-center">
                      @if ($banner)
                          <img class="w-full h-auto rounded-lg object-cover" src="{{ asset('storage/' . $banner->banner_img) }}" alt="{{ $information->title }}">
                      @else
                          <img class="w-full h-auto rounded-lg object-cover aspect-[16/9]" src="{{ asset('images/default-banner.jpg') }}" alt="Default Banner">
                      @endif
                  </div>
                  <div class="flex items-center justify-center lg:text-left">
                      <div class="mb-5">
                          <h3 class="text-4xl font-semibold text-indigo-600 leading-normal">{{ $information->title }}</h3>
                          <p class="text-gray-800 my-4">{!! $information->description !!}</p>
                          <div class="mt-4">
                            <h4 class="text-xl font-semibold text-gray-800 mb-3">Daftar Kompetisi</h4>
                            <ul class="space-y-2 text-gray-800">
                              @forelse ($competitions as $competition)
                                  <li class="border p-4 rounded-lg">
                                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                          <p class="mb-2">Jenis Kompetisi: <strong>{{ $competition->competition_type }}</strong></p>
                                          <p class="mb-2">Kelompok Umur: <strong> {{ $competition->age_group }}</strong></p>
                                      </div>
                                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                          <p class="mb-2">Gender:<strong> {{ $competition->gender }}</strong></p>
                                          <p class="mb-2">Harga:<strong> Rp {{ number_format($competition->price, 0, ',', '.') }}</strong></p>
                                      </div>
                                  </li>
                              @empty
                                  <li class="text-gray-500">Tidak ada kompetisi terkait.</li>
                              @endforelse
                            </ul>
                          </div>
                          <div class="mt-4">
                            <h4 class="text-xl font-semibold text-gray-800 mb-3">Tanggal Pendaftaran</h4>
                            <ul class="space-y-2 text-gray-800">
                                <li class="border p-4 rounded-lg">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                                        <p class="mb-2">Buka Pendaftaran: <strong> {{ $information->open_reg }} </strong></p>
                                        <p class="mb-2"> Mulai Pertandingan:<strong> {{ $information->open_reg }} </strong></p>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <p class="mb-2">Tutup Pendaftaran:<strong> {{ $information->start_match }} </strong></p>
                                        <p class="mb-2">Akhir Pertandingan:<strong> {{ $information->end_match }} </strong></p>
                                    </div>
                                </li>
                            </ul>
                          </div>
                      </div>
                  </div>
              </div>
            @endforeach  

        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto">
            <h2 class="text-5xl font-semibold text-center leading-normal text-indigo-600 mb-5">Galeri Kejuaraan</h2>
            <p class="text-lg mb-12 text-gray-800 leading-normal text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <div class="bg-white shadow-lg rounded-lg p-2 text-center flex items-center">
                    <img class="w-full h-auto rounded-lg" src="/img/screen.jpg" alt="image description">
                </div>
                <div class="bg-white shadow-lg rounded-lg p-2 text-center flex items-center">
                    <img class="w-full h-auto rounded-lg" src="/img/screen.jpg" alt="image description">
                </div>
                <div class="bg-white shadow-lg rounded-lg p-2 text-center flex items-center md:col-span-2 xl:col-span-1">
                    <img class="w-full h-auto rounded-lg" src="/img/screen.jpg" alt="image description">
                </div>
                <div class="bg-white shadow-lg rounded-lg p-2 text-center flex items-center">
                  <img class="w-full h-auto rounded-lg" src="/img/screen.jpg" alt="image description">
              </div>
              <div class="bg-white shadow-lg rounded-lg p-2 text-center flex items-center">
                  <img class="w-full h-auto rounded-lg" src="/img/screen.jpg" alt="image description">
              </div>
              <div class="bg-white shadow-lg rounded-lg p-2 text-center flex items-center md:col-span-2 xl:col-span-1">
                  <img class="w-full h-auto rounded-lg" src="/img/screen.jpg" alt="image description">
              </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-gray-800 py-6 mt-16">
        <div class="container mx-auto text-center text-white">
            <p>&copy; 2024 TerasWeb. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    @include('sweetalert::alert')
</body>

</html>
