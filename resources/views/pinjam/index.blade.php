@extends('layouts.app')

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Tambah Pinjam Barang</h1>
<x-breadcrumb :currentURL="['name' => 'Tambah Pinjam Barang']" :dataURL="[['name' => 'Pinjam Barang', 'url' => '#']]">
</x-breadcrumb>
@endsection

@section('css')
<style>
    .margin-custom-btn-barang{
        margin-right: 74.2px;
    }

    .max-jumlah{
        display: inline-block;
        font-size: .8rem;
        margin: 0!important;
    }
</style>
@endsection

@section('content')
<div class="card p-lg-6 pt-lg-4">
    <div class="card-header border-0 pt-6">
        <div class="w-100">
            <div class="d-flex w-100 justify-content-between">
                <h1 class="fw-bolder text-dark">Pinjam Barang</h1>
            </div>
        </div>
    </div>
    <div class="card-body pt-10">
        <form id="form_pinjam">
            <div class="row">
                <div class="col-12 col-md-4 mb-6">
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2">Kode Pinjaman</label>
                        <input type="text" class="form-control form-control-solid" value="{{ $kode_pinjam }}" readonly name="kode_pinjam">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-6">
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2">Peminjam</label>
                        <div class="input-group input-group-solid">
                            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                            <div class="flex-grow-1">
                                <select class="form-select select-2 form-select-solid rounded-start-0 border-start" data-placeholder="Pilih Peminjam" data-control="select2" name="id_peminjam" required
                                data-placeholder="Select an option">
                                    <option></option>
                                    @foreach ($peminjam as $item)
                                    <option value="{{ $item->id }}" >{{ $item->nama_peminjam }}</option>                                            
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-6">
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2">Atur Durasi Pinjaman</label>
                        <input class="form-control form-control-solid daterange" autocomplete="off" placeholder="Atur Durasi Pinjaman" name="tanggal_pinjam" id="tanggal_pinjam">
                    </div>
                </div>
            </div>

            <hr class="slash-3 mb-12">
            <div class="card-dark-purple">
                <div class="w-100">
                    <div class="d-flex w-100 justify-content-between">
                        <h1 class="fw-bolder text-light">Detail Barang</h1>
                        <button type="button" class="btn btn-shadow-warning" onclick="show_add()">Tambah Barang</button>
                    </div>
                </div>
                <div id="barang_select2">
                    <div class="barang-row mt-3">
                        <div class="display-no-barang">
                            <p>Belum Ada Barang Yang Dipilih</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-12">
                <div class="form-group d-flex justify-content-end">
                    <button type="submit" id="button_submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>    
            </div>
        </form>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder modal-title">Pinjam Barang</h2>
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
                <div style="width: 250px; position: relative">
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
                        <input type="text" class="form-control form-control-solid w-250px ps-15" data-table-filter="search" onkeyup="$('#loading_search').removeClass('d-none');" placeholder="Search Barang">
                        <div class="spinner-border position-absolute d-none" role="status" id="loading_search"></div>
                    </div>
                </div>
                <div id="table_wrapper" class="no-footer">
                    <div class="table-responsive mb-2">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer table-striped" id="tb">
                            <thead>
                                <tr class="text-start text-light bg-origin fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="text-center">No</th>
                                    <th class="min-w-100px text-center">Barang</th>
                                    <th class="text-center">Kode Barang</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Spesifikasi</th>
                                    <th class="text-center">Ruang</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-center">
                <button data-modal-action="close" class="btn btn-light me-3 no-confirmation">Close</button>
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
                ajax: {
                    url: '{{ route("pinjam") }}/datatables',
                    type: 'GET'
                },
                columnDefs: [
                    { className: 'text-center', targets: [0,1,2,3,4,5,6,7] },
                ],
                columns: [
                    { data: 'DT_RowIndex',searchable: false, orderable: false},
                    { data: 'nama_barang' },
                    { data: 'kode_barang' },
                    { data: 'kategori.nama_kategori' },
                    { data: 'spesifikasi' },
                    { data: 'ruang.nama_ruang' },
                    { data: 'jumlah' },
                    { data: null, searchable: false, orderable: false },
                ],
                rowCallback : function(row, data){
                    let berkas_image_url = "{{ asset('berkas/master-barang/') }}";
                    let empty_image_url = "{{ asset('assets/img/no-photo.png') }}";
                    let path = `${data.image ? berkas_image_url + '/' +  data.image : empty_image_url}`;

                    $('td:eq(1)', row).html(`
                        <div class="d-flex flex-direction-row align-items-center">
                            <img class="w-65px h-65px image-popup" style="object-fit: cover" draggable="false" src="${path}" alt="Foto ${data.nama_barang}">
                            <div class="ms-5">
                                <a href="" class="text-gray-800 text-hover-primary fs-5 fw-bold">${data.nama_barang}</a>
                            </div>
                        </div>
                    `);

                    $('td:eq(2)', row).html(`<div class="badge badge-light">${data.kode_barang}</div>`);

                    $('td:eq(7)', row).html(`
                        <button class="btn-sm btn-shadow-info px-5" aria-label="edit" id="button_delete_${data.id}" onclick="tambahBarang('${data.id}', '${data.jumlah}', '${data.nama_barang}', '${data.ruang.nama_ruang}')"><i class="bi bi-plus-lg"></i></button>
                    `);
                },
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
        $("#tanggal_pinjam").daterangepicker({
            minDate: moment(),
            locale: {
                format: 'DD/MM/YYYY'
            },
        });

        $("#tanggal_pinjam").val(null);
    });

    function disableDeleteButton(id){
        $('#button_delete_' + id).removeClass('btn-shadow-info');
        $('#button_delete_' + id).addClass('btn-secondary');
        $('#button_delete_' + id).prop('disabled', true);
    }

    function enableDeleteButton(id){
        $('#button_delete_' + id).addClass('btn-shadow-info');
        $('#button_delete_' + id).removeClass('btn-secondary');
        $('#button_delete_' + id).prop('disabled', false);
    }

    function show_add(){
        $('#modal').modal('show');
        $(".modal-title").text('Pinjam Barang');
    }

    function tambahBarang(id, jumlah, nama, ruang){
        disableDeleteButton(id);
        $('input[name="id_barang[]"]').each(function(index) {
            var currentValue = $(this).val();
            if(id === currentValue){
                Swal.fire({
                    title: 'Warning!',
                    text: 'Barang sudah dipilih.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return false;
            }
        });

        if($('.barang-row').find('[name="id_barang[]"]').length < 1){
            $('.display-no-barang').remove();
        }

        $('.barang-row').append(`
            <div class="row" id="detail_barang_${id}">
                <div class="col-6 col-md-5 mb-6">
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2">Barang</label>
                        <input type="hidden" name="id_barang[]" value="${id ?? ''}">
                        <div class="input-group input-group-solid">
                            <span class="input-group-text cust-br-barang"><i class="bi bi-people-fill"></i></span>
                            <div class="flex-grow-1">
                                <input type="text" readonly class="form-control form-control-solid nama-barang" value="${nama ?? ''}" placeholder="Nama Barang">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-6">
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2">Ruang</label>
                        <div class="input-group input-group-solid">
                            <span class="input-group-text cust-br-barang"><i class="bi bi-house fs-4"></i></span>
                            <div class="flex-grow-1">
                                <input type="text" readonly class="form-control form-control-solid nama-ruang" value="${ruang ?? ''}" placeholder="Ruang Barang">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 mb-6">
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2 label-jumlah">Jumlah</label>
                        <p class="max-jumlah text-secondary fw-bolder">(max: ${jumlah})</p>
                        <div class="d-flex barang-action-container" style="gap: 20px">
                            <input type="text" class="form-control form-control-solid" onkeypress="return onKeypressAngka(event,false)" placeholder="Masukkan Jumlah" name="jumlah[]" required>
                            <button type="button" class="btn btn-danger button-remove-barang" onclick="delete_barang_input(${id})">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }

    function delete_barang_input(id){
        $('#detail_barang_' + id).remove();
        enableDeleteButton(id);

        if($('.barang-row').find('[name="id_barang[]"]').length < 1){
            $('.barang-row').append(`
                <div class="display-no-barang">
                    <p>Belum Ada Barang Yang Dipilih</p>
                </div>`
            );
        }
    }
    

    $('#form_pinjam').submit(function(e){
        e.preventDefault();
        let this_form = this;
        Swal.fire({
            title: 'Yakin?',
            text: "Apakah anda yakin akan melakukan pinjaman barang ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lakukan Pinjaman'
        }).then((result) => {
            if (result.isConfirmed) {
                if($('.barang-row').find('[name="id_barang[]"]').length < 1){
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Silahkan Pilih Barang Terlebih Dahulu.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }
                $("#button_submit").attr('data-kt-indicator', "on");
                $("#button_submit").attr('disabled', "true");
                $('#modal_loading').modal('show');
                $.ajax({
                    url:  "{{ route('pinjam') . '/store-pinjam' }}",
                    type: "POST",
                    data: $('#form_pinjam').serialize(),
                    success: function(response){
                        $("#button_submit").removeAttr('data-kt-indicator');
                        $("#button_submit").removeAttr('disabled');
                        $('#modal_loading').modal('hide');
                        if(response.code == 200){
                            Swal.fire({
                                title: 'Success!',
                                text: 'Pinjam Barang Berhasil Dilakukan.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(function(){
                                window.location.href = `{{ route('pengembalian') }}`;
                            });
                        }
                    },error: function (jqXHR, textStatus, errorThrown) {
                        $("#button_submit").removeAttr('data-kt-indicator');
                        $("#button_submit").removeAttr('disabled');
                        $('#modal_loading').modal('hide');
                        if(jqXHR.status == 400){
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');
                            $('input, textarea, select').removeClass('is-invalid');
                            Object.keys(jqXHR.responseJSON.errors).forEach(function (key) {
                                var responseError = jqXHR.responseJSON.errors[key];
                                var elem_name = $(this_form).find('[name=' + responseError['field'] + ']');
                                if(elem_name.hasClass('select-2')){
                                    console.log(elem_name.parent().parent());
                                    elem_name.parent().parent().parent().append(`<span class="d-flex text-danger invalid-feedback">${responseError['message']}</span>`)
                                    elem_name.parent().parent().parent().find('.input-group-text').addClass('is-invalid');
                                    elem_name.next().find('.select2-selection--single:first').addClass('is-invalid');
                                } else {
                                    elem_name.after(`<span class="d-flex text-danger invalid-feedback">${responseError['message']}</span>`)
                                    elem_name.addClass('is-invalid');
                                }
                            });
                            Swal.fire('Oops!',jqXHR.responseJSON.message,'warning');
                        }
                        else if(jqXHR.status == 500){
                            Swal.fire('Error!',jqXHR.responseJSON.message,'error');
                        }else{
                            Swal.fire('Oops!','Something wrong try again later (' + errorThrown + ')','error');
                        }
                    }
                });
            }
        })
    });
</script>
@endsection
