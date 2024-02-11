@extends('layouts.app')

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Laporan Pinjaman Barang</h1>
<x-breadcrumb :currentURL="['name' => 'Pinjaman Barang']" :dataURL="[['name' => 'Laporan', 'url' => '#']]">
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
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" onclick="printPDF();"><span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black"></rect>
                        <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black"></path>
                        <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4"></path>
                    </svg>
                </span>Export PDF</button>
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
                            <th class="text-center">Status</th>
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
                <button data-modal-action="close" class="btn btn-icon btn-sm btn-active-icon-primary no-confirmation">
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
                <button data-modal-action="close" class="no-confirmation btn btn-light me-3">Close</button>
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
                    url: '{{ route("laporan.pinjam") }}/datatables',
                    type: 'GET'
                },
                columnDefs: [
                    { className: 'text-center', targets: [0,1,3,4,5] },
                ],
                columns: [
                    { data: 'DT_RowIndex',searchable: false},
                    { data: 'kode_pinjam' },
                    { data: 'peminjam.nama_peminjam' },
                    { data: 'tanggal_pinjam' },
                    { data: 'status' },
                    { data: 'tanggal_kembali', orderable: false },
                ],
                rowCallback : function(row, data){

                    $('td:eq(3)', row).html(`<div class="badge badge-primary">${formatted_indonesia_date(data.tanggal_pinjam)} - ${formatted_indonesia_date(data.tanggal_kembali)}</div>`);

                    const statusBadge = data.status == 0 ? `<div class="badge badge-success">Sudah Dikembalikan</div>` : `<div class="badge badge-danger">Belum Dikembalikan</div>`;
                    $('td:eq(4)', row).html(statusBadge);

                    $('td:eq(5)', row).html(`
                        <button class="btn-sm btn-shadow-info" aria-label="pengembalian" onclick="showListPinjaman('${data.id}', '${data.kode_pinjam}')"><i class="fas fa-info-circle fs-4"></i></button>
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

    function printPDF(){
        let url = `{{ route('laporan.pinjam') }}/print-pdf`;
        window.open(url, '_blank');
    }

    function showListPinjaman(id, kode_pinjam){
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
</script>
@endsection
