@extends('layouts.app')

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Pengembalian</h1>
<x-breadcrumb :currentURL="['name' => 'Pengembalian']" :dataURL="[['name' => 'Pinjam Barang', 'url' => '#']]">
</x-breadcrumb>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="black"></path>
                    </svg>
                </span>
                <input type="text" class="form-control form-control-solid w-250px ps-15" data-table-filter="search" onkeyup="$('#loading_search').removeClass('d-none');" placeholder="Search">
                <div class="spinner-border position-absolute d-none" role="status" id="loading_search">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div id="table_wrapper" class="no-footer">
            <div class="table-responsive mb-2">
                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer table-striped" id="tb">
                    <thead>
                        <tr class="text-start text-light bg-origin fw-bolder fs-7 text-uppercase gs-0">
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Pinjam</th>
                            <th class="text-center">Peminjam</th>
                            <th class="text-center">Durasi Pinjam</th>
                            <th class="text-center min-w-70px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder modal-title">List Barang Pinjaman</h2>
                <button data-modal-action="close" class="btn btn-icon btn-sm btn-active-icon-primary">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </button>
            </div>
            <div class="modal-body py-10 px-lg-17">
                <input type="hidden" id="id_pinjam">
                <div class="table-responsive mb-2">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bolder text-muted">
                                <th class="text-center">No</th>
                                <th class="min-w-100px text-center">Barang</th>
                                <th class="text-center">Kode Barang</th>
                                <th class="text-center">Ruang</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" id="tbody_list_barang">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer flex-center">
                <button data-modal-action="close" class="btn btn-light me-3">Close</button>
                <button type="button" class="btn btn-primary" onclick="actionKembalikanBarang()">
                    <span class="indicator-label">Ya, Kembalikan Barang</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let tb;
    var DatatablesServerSide = function () {
        var initDatatable = function () {
            tb = $('#tb').DataTable({
                responsive: true,
                lengthMenu: [5, 10, 25, 50], // Set the page length options
                pageLength: 5,
                ajax: {
                    url: '{{ route("pengembalian") }}/datatables',
                    type: 'GET'
                },
                columnDefs: [
                    { className: 'text-center', targets: [0,1,3,4] },
                ],
                columns: [
                    { data: 'DT_RowIndex',searchable: false},
                    { data: 'kode_pinjam' },
                    { data: 'peminjam.nama_peminjam' },
                    { data: 'tanggal_pinjam' },
                    { data: 'tanggal_kembali', orderable: false },
                ],
                rowCallback : function(row, data){

                    $('td:eq(3)', row).html(`<div class="badge badge-primary">${formatted_indonesia_date(data.tanggal_pinjam)} - ${formatted_indonesia_date(data.tanggal_kembali)}</div>`);

                    $('td:eq(4)', row).html(`
                        <button class="btn-sm btn-shadow-warning" aria-label="pengembalian" onclick="kembalikanBarangModal('${data.id}', '${data.kode_pinjam}')"><i class="fas fa-share-square fs-4"></i></button>
                    `);
                }
            });
        }

        var handleSearchDatatable = function () {
            const filterSearch = document.querySelector('[data-table-filter="search"]');
            filterSearch.addEventListener('keyup', debounce(function (e) {
                $('#loading_search').addClass('d-none');
                tb.search(e.target.value).draw();
            }, 500));
        }

        // Public methods
        return {
            init: function () {
                initDatatable();
                handleSearchDatatable();
            }
        }
    }();

    $(document).ready(function(){
        DatatablesServerSide.init();
    })

    function kembalikanBarangModal(id, kode_pinjam){
        Swal.fire({
            title: 'Yakin?',
            text: "Apakah anda yakin akan mengembalikan " + kode_pinjam,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lakukan Pengembalian'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#modal_loading').modal('show');
                $.ajax({
                    url: `{{ route('pengembalian') . '/detail/${id}' }}`,
                    type: "GET",
                    success: function(response) {
                        setTimeout(function () { $('#modal_loading').modal('hide'); }, 500);
                        $("#tbody_list_barang").empty();
                        response.data.pinjam_detail.forEach(function(item, key) {
                            let barang = item.master_barang;
                            let berkas_image_url = "{{ asset('berkas/master-barang/') }}";
                            let empty_image_url = "{{ asset('assets/img/no-photo.png') }}";
                            let path = `${barang.image ? berkas_image_url + '/' +  barang.image : empty_image_url}`;
                            $("#tbody_list_barang").append(`
                                <tr>
                                    <td class="text-center">${key + 1}</td>
                                    <td>
                                        <div class="d-flex flex-direction-row align-items-center">
                                            <img class="w-65px h-65px image-popup" style="object-fit: cover" draggable="false" src="${path}" alt="${barang.nama_barang}">
                                            <div class="ms-5">
                                                <a href="" class="text-gray-800 text-hover-primary fs-5 fw-bold">${barang.nama_barang}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-light">${barang.kode_barang}</div>
                                    </td>
                                    <td class=" text-center">${barang.ruang.nama_ruang}</td>
                                    <td class=" text-center">${item.jumlah}</td>
                                </tr>
                            `);
                        });
                        $("#modal").modal("show");
                        $("#id_pinjam").val(id);
                    }, error: function(jqXHR, textStatus, errorThrown) {
                        setTimeout(function () { $('#modal_loading').modal('hide'); }, 500);
                        Swal.fire({
                            text: (jqXHR.responseJSON && jqXHR.responseJSON.code === 400)
                                ? jqXHR.responseJSON.message
                                : "Oops! Terjadi kesalahan segera hubungi tim IT (" + errorThrown + ")",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    function actionKembalikanBarang(){
        Swal.fire({
            title: 'Peringatan ?',
            text: "Pastikan semua barang telah dikembalikan ke ruangan yang ditentukan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjutkan Pengembalian'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#modal_loading').modal('show');
                $.ajax({
                    url: `{{ route('pengembalian') . '/store-pengembalian' }}`,
                    type: "POST",
                    data: { id_pinjam: $("#id_pinjam").val() },
                    success: function(response) {
                        setTimeout(function () { $('#modal_loading').modal('hide'); }, 500);
                        iziToast.success({
                            title: 'Success!',
                            message: response.message,
                            position: 'topRight'
                        });
                        $('#modal').modal('hide');
                        tb.ajax.reload(null, false);
                    }, error: function(jqXHR, textStatus, errorThrown) {
                        setTimeout(function () { $('#modal_loading').modal('hide'); }, 500);
                        Swal.fire({
                            text: (jqXHR.responseJSON && jqXHR.responseJSON.code === 400)
                                ? jqXHR.responseJSON.message
                                : "Oops! Terjadi kesalahan segera hubungi tim IT (" + errorThrown + ")",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }
</script>
@endsection
