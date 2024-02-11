@extends('layouts.app')

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">About This Project</h1>
<x-breadcrumb :currentURL="['name' => 'Project']" :dataURL="[['name' => 'About', 'url' => '#']]">
</x-breadcrumb>
@endsection

@section('content')
<div class="card">
    <div class="card-body p-lg-17">
        <div class="mb-18">
            <div class="mb-10">
                <div class="text-center mb-15">
                    <h3 class="fs-2hx text-dark mb-5">About This Project</h3>
                    <div class="fs-5 text-muted fw-bold">Proyek ini bertujuan untuk memenuhi syarat dalam mengikuti UKK yang diwajibkan oleh kurikulum pendidikan, dengan demikian tidak dimaksudkan untuk kepentingan komersial atau penggunaan yang luas, melainkan hanya untuk keperluan pribadi dan pendidikan semata.</div>
                </div>
                <div class="overlay" style="padding: 40px;background: linear-gradient(145deg, #ffffff, #e3e3e3); border-radius: 18px;">
                    <img class="d-flex card-rounded justify-content-center" style="width: 70%; margin: auto" src="{{ asset('assets/img/logo.png') }}" alt="">
                </div>
            </div>
            <div class="fs-5 fw-bold text-gray-600">
                <p class="mb-8">Inventarisasi website merupakan proses yang penting dalam pengelolaan dan pemeliharaan konten online yang efisien. Dalam era digital yang terus berkembang pesat, kebutuhan untuk memiliki sistem yang teratur dalam mengelola dan memelihara inventarisasi website menjadi semakin penting bagi perusahaan, organisasi, dan individu yang aktif dalam ruang online. Dengan memahami pentingnya inventarisasi website, proyek-proyek khusus dapat diluncurkan untuk menyusun dan memelihara daftar yang lengkap dan terstruktur dari semua aset digital yang dimiliki.</p>
                <p class="mb-8">Slogan <span class="text-gray-800 pe-1">"Simplify and Organize"</span> menggambarkan komitmen untuk menyederhanakan dan mengorganisir pengelolaan inventaris. Melalui pendekatan ini, tujuannya adalah untuk menciptakan efisiensi, meningkatkan produktivitas, dan mengurangi kesalahan data.</p>
                <p class="mb-8">Selain itu, proyek inventarisasi website juga mencakup pemantauan dan pemeliharaan terhadap kondisi teknis dari website itu sendiri. Ini meliputi peninjauan terhadap struktur URL, pengecekan terhadap tautan-tautan yang rusak, dan memastikan bahwa semua halaman dapat diakses dengan baik. Dengan melakukan pemeliharaan yang teratur, para pemilik website dapat memastikan bahwa pengalaman pengguna tetap optimal dan bahwa website mereka tetap berfungsi dengan baik.</p>
                <p class="mb-17">Secara keseluruhan, proyek inventarisasi website adalah langkah yang krusial dalam upaya untuk mengelola konten online dengan efisien dan efektif. Dengan menyusun inventarisasi yang terstruktur dan memelihara website dengan baik, para pemilik website dapat memastikan bahwa aset-aset digital mereka dapat memberikan nilai yang maksimal bagi pengguna.</p>
            </div>
        </div>
        <div class="card bg-light mb-18">
            <div class="card-body py-15">
                <div class="text-center mb-12">
                    <h3 class="fs-2hx text-dark mb-5">Framework / Library Used</h3>
                </div>
                <div class="d-flex flex-center">
                    <div class="d-flex justify-content-between mb-10 mx-auto w-xl-900px">
                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-2">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/framework/Vitejs.png') }}" width="90" alt="" srcset="">
                            </div>
                        </div>
                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-2">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/framework/Bootstrap-New.png') }}" width="190" alt="" srcset="">
                            </div>
                        </div>
                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-2">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/framework/Laravel.png') }}" width="170" alt="" srcset="">
                            </div>
                        </div>
                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-2">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/framework/jQuery-removebg-preview.png') }}" width="190" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-18">
            <div class="text-center mb-12">
                <h3 class="fs-2hx text-dark mb-5">About Me</h3>
            </div>
            <div class="d-flex justify-content-start tns tns-default mb-10 tns-initiazlied">
                <div class="mb-9 d-flex" style="gap: 40px">
                    <div class="rounded-circle mx-auto mb-2 d-flex w-150px h-150px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url({{ asset('assets/img/wasd.jpg') }})"></div>
                    <div class="d-flex align-items-center">
                        <div class="mb-0" style="padding-bottom: 40px">
                            <a href="#" class="text-dark fw-bolder text-hover-primary" style="font-size: 2.2rem">Irvan Aditya Kurniawan</a>
                            <div class="text-muted fs-6 fw-bold">Fullstack Developer</div>
                            <div class="text-muted fs-6 fw-bold">irvankurniawan624@gmail.com</div>
                            <div class="text-muted fs-6 fw-bold" style="border-top: 1px solid #d9d9d9; padding-top: 4px; margin-top: 4px">1 week project donnnn....</div>
                            <div class="text-muted fs-6 fw-bold">Salam Ilmu Padi 🌾 Abangkuh....🔥🔥🔥</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4 bg-light text-center">
            <div class="card-body py-12">
                <a href="https://www.facebook.com/irvan.kurniawan.96343" target="_blank" class="mx-4">
                    <img src="assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="">
                </a>
                <a href="https://www.instagram.com/coach_irvan/" target="_blank" class="mx-4">
                    <img src="assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="">
                </a>
                <a href="https://github.com/IrvanStillLearning" target="_blank" class="mx-4">
                    <img src="assets/media/svg/brand-logos/github.svg" class="h-30px my-2" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
<div style="margin-top: 35000px">
    <h1 style="margin-bottom: 25px">Reaksi Admin Saat INI : </h1>
    <img src="{{ asset('assets/img/wetwetwetwetwet.jpg') }}" alt="" class="d-flex justify-content-center" style="margin: auto; margin-bottom: 100px" srcset="">    
    <img src="{{ asset('assets/img/yusril.jpg') }}" alt="" class="d-flex justify-content-center" style="margin: auto" srcset="">    
</div>
@endsection
