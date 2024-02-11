@extends('layouts.app')

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Master Barang</h1>
<x-breadcrumb :currentURL="['name' => 'Master Barang']" :dataURL="[['name' => 'Apps', 'url' => '#']]">
</x-breadcrumb>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }}">
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
                <input type="text" class="form-control form-control-solid w-250px ps-15" data-table-filter="search" onkeyup="$('#loading_search').removeClass('d-none');" placeholder="Search Barang">
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
                
                <button type="button" class="btn btn-primary" onclick="show_add()">Tambah Barang</button>
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
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form class="form form_upload" action="{{ route('barang') . '/store-update' }}" id="form_upload" method="POST">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h2 class="fw-bolder modal-title">Tambah Barang</h2>
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
                    <div class="row">
                        <div class="col-12 col-md-4 mb-6">
                            <div class="form-group">
                                <label class="fs-5 fw-bold mb-2">Kode Barang</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="kode_barang">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-6">
                            <div class="form-group">
                                <label class="fs-5 fw-bold mb-2">Kategori</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text"><i class="bi bi-card-list fs-4"></i></span>
                                    <div class="flex-grow-1">
                                        <select class="form-select select-2 form-select-solid rounded-start-0 border-start" name="kategori_id" data-control="select2" data-placeholder="Pilih Kategori">
                                            <option></option>
                                            @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>                                            
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-6">
                            <div class="form-group">
                                <label class="fs-5 fw-bold mb-2">Ruang</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text"><i class="bi bi-house fs-4"></i></span>
                                    <div class="flex-grow-1">
                                        <select class="form-select select-2 form-select-solid rounded-start-0 border-start" name="ruang_id" data-control="select2" data-placeholder="Pilih Ruang">
                                            <option></option>
                                            @foreach ($ruang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_ruang }}</option>                                            
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <!--begin::Image input-->
                            <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ asset('assets/img/no-photo.png') }});">
                                <div class="image-input-wrapper" style="width: 210px; height: 200px"></div>
                                
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-40px h-40px bg-white shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Change gambar Barang">
                                    <i class="bi bi-pencil-fill fs-4"></i>
                                    <input type="file" id="image_barang" name="gambar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>

                                <span class="btn btn-icon btn-circle btn-active-color-primary w-40px h-40px bg-white shadow"
                                    data-kt-image-input-action="remove"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Delete gambar barang">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-6">
                                    <div class="form-group">
                                        <label class="fs-5 fw-bold mb-2">Nama Barang</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="nama_barang">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-6">
                                    <div class="form-group">
                                        <label class="fs-5 fw-bold mb-2">Spesifikasi</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="spesifikasi">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 mb-6">
                                    <div class="form-group">
                                        <label class="fs-5 fw-bold mb-2">Keterangan Barang</label>
                                        <textarea name="keterangan" class="form-control form-control-solid" style="min-height: 100px"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button data-modal-action="close" class="btn btn-light me-3">Close</button>
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
<script src="{{ asset('assets\vendor\magnific-popup\magnific-popup.min.js') }}"></script>
<script>
    let tb;
    var DatatablesServerSide = function () {
        var initDatatable = function () {
            tb = $('#tb').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("barang") }}/datatables',
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

                    var url_edit   = "{{ route('barang') }}/detail/" + data.id;
                    var url_delete = "{{ route('barang') }}/delete/" + data.id;
                    $('td:eq(7)', row).html(`
                        <button class="btn-sm btn-shadow-info me-3" aria-label="edit" onclick="editActionImage('${url_edit}', 'Edit Barang')"><i class="fas fa-edit fs-4"></i></button>
                        <button class="btn-sm btn-shadow-danger" aria-label="delete" onclick="deleteAction('${url_delete}','${data.nama_barang}')"><i class="fas fa-trash fs-4"></i></button>
                    `);
                },
                initComplete: function (row, data) {
                    $('.image-popup').magnificPopup({
                        type: 'image',
                        callbacks: {
                            elementParse: function(item) {
                                item.src = item.el.attr('src');
                            }
                        }
                    });
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

    $('#tb').on('draw.dt', function() {
        $('.image-popup').magnificPopup({
            type: 'image',
            callbacks: {
                elementParse: function(item) {
                    item.src = item.el.attr('src');
                }
            }
        });
    });

    $(document).ready(function(){
        DatatablesServerSide.init();
    });


    function show_add(){
        $('#modal').modal('show');
        $(".modal-title").text('Tambah Barang');
        resetFormImage();
    };

    function resetFormImage(){
        $("#form_upload")[0].reset();
        $('.image-input').addClass('image-input-empty');
        $('.image-input-wrapper').css('background-image', 'none');
        resetAllSelect();
    }

    function editActionImage(url, modal_text){
        resetFormImage();
        save_method = 'edit';
        $("#modal").modal('show');
        $(".modal-title").text(modal_text);
        $('.invalid-feedback').remove();
        $('input.is-invalid').removeClass('is-invalid');
        $("#modal_loading").modal('show');
        $.ajax({
            url : url,
            type: "GET",
            dataType: "JSON",
            success: function(response){
                setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                Object.keys(response.data).forEach(function (key) {
                var elem_name = $('[name=' + key + ']');
                elem_name.removeClass('is-invalid');
                if (elem_name.hasClass('selectric')) {
                    elem_name.val(response.data[key]).change().selectric('refresh');
                }else if(elem_name.hasClass('select-2')){
                    elem_name.select2("trigger", "select", { data: { id: response.data[key] } });
                }else if(elem_name.hasClass('selectgroup-input')){
                    $("input[name="+key+"][value=" + response.data[key] + "]").prop('checked', true);
                }else if(elem_name.hasClass('my-ckeditor')){
                    CKEDITOR.instances[key].setData(response.data[key]);
                }else if(elem_name.hasClass('custom-control-input')){
                    $("input[name="+key+"][value=" + response.data[key] + "]").prop('checked', true);
                }else if(elem_name.hasClass('time-format')){
                    elem_name.val(response.data[key].substr(0, 5));
                }else if(elem_name.hasClass('format-rp')){
                    var nominal = response.data[key].toString();
                    elem_name.val(nominal.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                }else{
                    elem_name.val(response.data[key]);
                    if(key == 'image' && response.data['image'] !== null){
                        $('.image-input').removeClass('image-input-empty');
                        let imagePath = '{{ asset("berkas/master-barang") }}/' + response.data['image'];
                        $('.image-input-wrapper').css('background-image', 'url(' + imagePath + ')');
                    }
                }
                });
            },error: function (jqXHR, textStatus, errorThrown){

            setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
            
            if(jqXHR.status == 400){
                $('.invalid-feedback').remove();
                $('input, textarea, select').removeClass('is-invalid');
                Object.keys(jqXHR.responseJSON.errors).forEach(function (key) {
                    var responseError = jqXHR.responseJSON.errors[key];
                    var elem_name = $('[name=' + responseError['field'] + ']');
                    elem_name.after(`<span class="d-flex text-danger invalid-feedback">${responseError['message']}</span>`)
                    elem_name.addClass('is-invalid');
                });
                Swal.fire('Oops!',jqXHR.responseJSON.message,'warning');
            }
            else if(jqXHR.status == 404){
                Swal.fire('Error!',jqXHR.responseJSON.message,'error');
            }else if(jqXHR.status == 500){
                Swal.fire('Error!',jqXHR.responseJSON.message,'error');
            }else{
                Swal.fire('Oops!','Something wrong try again later (' + errorThrown + ')','error');
            }

                setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                Swal.fire('Oops!','Terjadi kesalahan segera hubungi tim IT (' + errorThrown + ')','error');
            }
        });
    }

    function printPDF(){
        let url = `{{ route('barang') }}/print-pdf`;
        window.open(url, '_blank');
    }
</script>
@endsection
