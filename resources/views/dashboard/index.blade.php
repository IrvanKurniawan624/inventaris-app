@extends('layouts.app')
@php
    use App\Helpers\App;
@endphp

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Dashboard</h1>
@endsection

@section('header')
<div class="card rounded-0 bgi-no-repeat bgi-position-x-end bgi-size-cover"
    style="background-color: #663259;background-size: auto 100%; background-image: url(assets/media/misc/taieri.svg)">
    <div class="card-body container-xxl pt-10 pb-8">
        <div class="d-flex align-items-center">
            <h1 class="fw-bold me-3 text-white">Welcome Back Admin !</h1>
            <span class="fw-bold text-white opacity-50">Inventaris Management App</span>
        </div>
        <div class="d-flex flex-column">
            <div class="d-lg-flex align-lg-items-center flex-column">
                <div
                    class="rounded d-flex flex-column flex-lg-row align-items-lg-center bg-white p-5 w-xxl-750px h-lg-60px me-lg-10 my-5">
                    <div class="row flex-grow-1 mb-5 mb-lg-0">
                        <div class="col-lg-12 d-flex align-items-center mb-3 mb-lg-0">
                            <span class="svg-icon svg-icon-1 svg-icon-gray-400 me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                        height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                        fill="black" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <input type="text" id="search_input" class="form-control form-control-flush flex-grow-1"
                                name="search" value="" placeholder="Search Menu" autocomplete="off" />
                        </div>
                    </div>
                    <div class="min-w-150px text-end">
                        <button type="submit" class="btn btn-dark" onclick="searchButtonTrigger()"
                            id="kt_advanced_search_button_1">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card card-bordered w-100">
            <div class="card-body">
                <div class="card-header card-header border-0 p-0">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Rekap Barang Masuk/Keluar</span>
                        <span class="text-muted fw-bold fs-7">Rekap yang ditampilkan adalah rekap 5 hari terakhir</span>
                    </h3>
                </div>
                <div id="chart" style="height: 350px;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-bordered w-100">
            <div class="card-body">
                <div class="card-header border-0 p-0" style="min-height: 50px">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Rekap Pinjaman Barang Bulan Ini</span>
                        <span class="text-muted fw-bold fs-7">Hanya menampilkan pinjaman bulan ini</span>
                    </h3>
                </div>
                <div class="row align-items-center">
                    <div class="col-7">
                        <h4 class="fw-bold mb-3">{{ $total_pinjaman }} Pinjaman Bulan Ini</h4>
                        <div class="d-flex align-items-center">
                            <div class="me-4">
                                <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                <span style="font-size: .85rem!important">{{ App::bulan_tahun() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="d-flex justify-content-center">
                            <div id="breakup"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-bordered w-100 mt-5" style="min-height: 230px">
            <div class="card-body" style="background-image: url({{ asset('assets/img/graph-bg.png') }}); background-size: 100%; background-position: bottom; background-repeat: no-repeat">
                <div class="card-header border-0 p-0" style="min-height: 50px">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Total Pembelian Barang</span>
                        <span class="text-muted fw-bold fs-7">Menampilkan total semua pembelian barang</span>
                    </h3>
                    <div class="mt-10">
                        <h1>{{ "Rp. ".number_format($total_pembelian_barang, 0 , ',' , '.' ) }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script>
    $.ajax({
        url: "{{ route('dashboard') . '/get-data' }}",
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            let data = response.data;
            var chart = {
                series: [{
                        name: "Barang Masuk",
                        data: data.barang_masuk_list
                    },
                    {
                        name: "Barang Keluar",
                        data: data.barang_keluar_list
                    },
                ],

                chart: {
                    type: "bar",
                    height: 345,
                    offsetX: -15,
                    toolbar: {
                        show: true
                    },
                    foreColor: "#adb0bb",
                    fontFamily: 'inherit',
                    sparkline: {
                        enabled: false
                    },
                },


                colors: ["#CB2E2E", "#FFA426"],


                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "35%",
                        borderRadius: [6],
                        borderRadiusApplication: 'end',
                        borderRadiusWhenStacked: 'all'
                    },
                },
                markers: {
                    size: 0
                },

                dataLabels: {
                    enabled: false,
                },


                legend: {
                    show: false,
                },


                grid: {
                    borderColor: "rgba(0,0,0,0.1)",
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                },

                xaxis: {
                    type: "category",
                    categories: data.date_list,
                    labels: {
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color"
                        },
                    },
                },


                yaxis: {
                    show: true,
                    min: 0,
                    tickAmount: 4,
                    labels: {
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color",
                        },
                    },
                },
                stroke: {
                    show: true,
                    width: 3,
                    lineCap: "butt",
                    colors: ["transparent"],
                },


                tooltip: {
                    theme: "light"
                },

                responsive: [{
                    breakpoint: 600,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 3,
                            }
                        },
                    }
                }]


            };

            var chart = new ApexCharts(document.querySelector("#chart"), chart);
            chart.render();
        },error: function (jqXHR, textStatus, errorThrown) {
            Swal.fire('Oops!','Terjadi kesalahan segera hubungi tim IT (' + errorThrown + ')','error');
        },
    })

    var data = [
      { display: 'Master Barang', url: '/apps/barang' },
      { display: 'Kategori', url: '/apps/kategori' },
      { display: 'Supplier', url: '/apps/supplier' },
      { display: 'Peminjam', url: '/apps/peminjam' },
      { display: 'Ruang', url: '/apps/ruang' },
      { display: 'Barang Masuk', url: '/transaksi/barang-masuk' },
      { display: 'Barang Keluar', url: '/transaksi/barang-keluar' },
      { display: 'Pinjam Barang', url: '/pinjam' },
      { display: 'Pengembalian Barang', url: '/pinjam/pengembalian' },
      { display: 'Laporan Pinjaman Barang', url: '/laporan/pinjaman' },
      { display: 'About This Project', url: '/about' },
    ];

    $(document).ready(function(){

      $('#search_input').typeahead({
        source: data.map(function(item) {
            return item.display;
        }),
        updater: function(item) {
            // Find the corresponding URL for the selected item
            var selectedItem = data.find(function(suggestion) {
                return suggestion.display === item;
            });
            
            // Redirect to the URL of the selected suggestion
            if (selectedItem) {
                window.location.href = selectedItem.url;
            }
            
            return item;
        }
      });
    });

    function searchButtonTrigger(){
        var selectedItem = data.find(function(suggestion) {
            return suggestion.display.toLowerCase() === $('#search_input').val().toLowerCase();
        });
        // Redirect to the URL of the selected suggestion
        if (selectedItem) {
            window.location.href = selectedItem.url;
        } else {
            Swal.fire({
                text: "Menu Tidak Ditemukan",
                icon: "warning"
            });
        }
    }

    var breakup = {
        color: "#adb5bd",
        series: [{{ $total_masih_dipinjam .',' . $total_sudah_dikembalikan }}],
        labels: ["Barang Masih Dipinjam", "Barang Sudah Dikembalikan"],
        chart: {
            width: 180,
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        plotOptions: {
            pie: {
                startAngle: 0,
                endAngle: 360,
                donut: {
                    size: '75%',
                },
            },
        },
        stroke: {
            show: false,
        },

        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
        },
        colors: ["#5D87FF", "#FFA426", "#CB2E2E"],

        responsive: [{
            breakpoint: 991,
            options: {
                chart: {
                    width: 150,
                },
            },
        }, ],
        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
    chart.render();
</script>

@endsection