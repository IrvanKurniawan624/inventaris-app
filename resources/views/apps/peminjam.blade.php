@extends('layouts.app')

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Peminjam</h1>
<x-breadcrumb :currentURL="['name' => 'Peminjam']" :dataURL="[['name' => 'Apps', 'url' => '#']]">
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
                <input type="text" class="form-control form-control-solid w-250px ps-15" data-table-filter="search" onkeyup="$('#loading_search').removeClass('d-none');" placeholder="Search Peminjam">
                <div class="spinner-border position-absolute d-none" role="status" id="loading_search">
                </div>
            </div>
        </div>
        
        <div class="card-toolbar">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" onclick="show_add()">Tambah Peminjam</button>
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
                            <th class="min-w-100px text-center">Nama Peminjam</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Kontak</th>
                            <th class="text-center">Updated By</th>
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
<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form form_submit" action="{{ route('peminjam') . '/store-update' }}" id="form_submit" method="POST">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h2 class="fw-bolder modal-title">Tambah Peminjam</h2>
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
                    <div class="scroll-y me-n7 pe-7">
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-bold mb-2">Nama Peminjam</label>
                            <input type="text" class="form-control form-control-solid" placeholder="" name="nama_peminjam"/>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-bold mb-2">Jabatan</label>
                            <select class="form-select form-select-solid select-2" name="jabatan" data-control="select2" data-dropdown-parent="#modal" data-placeholder="Select an option">
                                <option></option>
                                <option value="siswa">Siswa</option>
                                <option value="guru">Guru</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-bold mb-2">Kontak Peminjam</label>
                            <input type="text" class="form-control form-control-solid" placeholder="" name="kontak_peminjam"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" data-modal-action="close" class="btn btn-light me-3">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
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
                    url: '{{ route("peminjam") }}/datatables',
                    type: 'GET'
                },
                columnDefs: [
                    { className: 'text-center', targets: [0,2,3,4,5] },
                ],
                columns: [
                    { data: 'DT_RowIndex',searchable: false},
                    { data: 'nama_peminjam' },
                    { data: 'jabatan' },
                    { data: 'kontak_peminjam' },
                    { data: 'updated_by.nama' },
                    { data: null, orderable: false },
                ],
                rowCallback : function(row, data){
                    var url_edit   = "{{ route('peminjam') }}/detail/" + data.id;
                    var url_delete = "{{ route('peminjam') }}/delete/" + data.id;
                    $('td:eq(5)', row).html(`
                        <button class="btn-sm btn-shadow-info me-3" aria-label="edit" onclick="editAction('${url_edit}', 'Edit Peminjam')"><i class="fas fa-edit fs-4"></i></button>
                        <button class="btn-sm btn-shadow-danger" aria-label="delete" onclick="deleteAction('${url_delete}','${data.nama_peminjam}')"><i class="fas fa-trash fs-4"></i></button>
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

    function show_add(){
        $('#modal').modal('show');
        $(".modal-title").text('Tambah Peminjam');
        $("#form_submit")[0].reset();
        resetAllSelect();
    }
</script>
@endsection
