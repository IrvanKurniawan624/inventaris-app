@extends('layouts.app')

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Barang Masuk</h1>
<x-breadcrumb :currentURL="['name' => 'Barang Masuk']" :dataURL="[['name' => 'Transaksi', 'url' => '#']]">
</x-breadcrumb>
@endsection

@section('content')
<div class="card p-lg-6 pt-lg-4">
    <div class="card-header border-0 pt-6">
        <div class="w-100">
            <div class="d-flex w-100 justify-content-between">
                <h1 class="fw-bolder text-dark">Data Barang</h1>
                <div class="form-group custom-radio d-flex justify-content-center" style="width: 40%">
                    <input type="radio" id="add_barang_option" name="showTipeBarangTaken" class="tipe_barang_taken" value="1" checked=""><label for="add_barang_option" style="text-align: center">Tambah Barang Baru</label>
                    <input type="radio" id="table_barang_option" name="showTipeBarangTaken" class="tipe_barang_taken" value="2"><label for="table_barang_option" style="text-align: center">Ambil Dari Table Barang</label>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-10">
        <form id="form_transaksi">
            <input type="hidden" name="barang_taken" value="1">
            <div id="barang_select2" class="d-none">
                <div class="row">
                    <div class="col-12 col-md-12 mb-6">
                        <div class="form-group">
                            <label class="fs-5 fw-bold mb-2">Barang</label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                <div class="flex-grow-1">
                                    <select class="form-select select-2 form-select-solid rounded-start-0 border-start barang-select2" name="barang_from_table" data-placeholder="Pilih Barang" id="barang_select2">
                                        <option></option>
                                        @foreach ($barang as $item)
                                        <option value="{{ $item->id }}" data-kode="{{ $item->kode_barang }}" data-jumlah="{{ $item->jumlah }}" data-kt-select2-img="{{ $item->image }}">{{ $item->nama_barang }}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tambah_barang_input">
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
            <hr class="slash-3 mb-12">
            <div class="card-dark-purple">
                <div class="w-100">
                    <div class="d-flex w-100 justify-content-between">
                        <h1 class="fw-bolder text-light">Detail Transaksi</h1>
                    </div>
                </div>
                <div class="row pt-7">
                    <div class="col-12 col-md-4 mb-6">
                        <div class="form-group">
                            <label class="fs-5 fw-bold mb-2">Supplier</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-check-fill"></i></span>
                                <div class="flex-grow-1">
                                    <select class="form-select select-2 rounded-start-0 border-start" data-control="select2" name="supplier_id" data-placeholder="Pilih Supplier">
                                        <option></option>
                                        @foreach ($supplier as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_supplier }}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mb-6">
                        <div class="form-group">
                            <label class="fs-5 fw-bold mb-2">Jumlah</label>
                            <input type="text" class="form-control" placeholder="" onkeypress="return onKeypressAngka(event,false)" name="jumlah">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-6">
                        <div class="form-group">
                            <label class="fs-5 fw-bold mb-2">Harga</label>
                            <input type="text" class="form-control" placeholder="" onkeypress="return onKeypressAngka(event,false)" name="harga">
                        </div>
                    </div>
                    <div class="col-12 col-md-12 mb-6">
                        <div class="form-group">
                            <label class="fs-5 fw-bold mb-2">Keterangan Transaksi</label>
                            <textarea name="keterangan_transaksi" class="form-control form-control-solid" style="min-height: 100px"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-12">
                <div class="form-group d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-5" onclick="clearForm()">Clear</button>
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
@section('script')
<script>
    const format = (item) => {
        if (!item.id) {
            return item.text;
        }
        var url = (item.element.getAttribute('data-kt-select2-img') === '') ? '/assets/img/no-photo.png' : '/berkas/master-barang/' + item.element.getAttribute('data-kt-select2-img');
        var img = $("<img>", {
            class: "rounded-circle me-2",
            width: 26,
            height: 26,
            src: url
        });
        var span = $("<span>", {
            text: " " + item.text
        });
        var span2 = $("<span>", {
            text: " " + item.element.getAttribute('data-jumlah'),
            class: "fw-bolder badge badge-primary ms-3 w-40px float-right"
        }).appendTo(span);
        var span3 = $("<span>", {
            text: " " + item.element.getAttribute('data-kode'),
            class: "fw-bolder float-right"
        }).appendTo(span);
        span.prepend(img);
        return span;
    }

    function initializeSelect2(){
        $('.barang-select2').select2({
            templateResult: function (item) {
                return format(item);
            }
        });
    }

    function refreshSelect2Data(){
        $.ajax({
            url: `{{ route('transaksi.barang_masuk') . '/get-select2-data' }}`,
            type: "GET",
            success: function(response) {
                setTimeout(function () { $('#modal_loading').modal('hide'); }, 500);
                // Empty the existing options
                $('.barang-select2').empty();

                // Append new options based on response.data
                response.data.forEach(function(item) {
                    var option = $('<option>', {
                        value: item.id,
                        'data-kode': item.kode_barang,
                        'data-jumlah': item.jumlah,
                        'data-kt-select2-img': item.image,
                        text: item.nama_barang
                    });

                    // Append the option to the Select2 element
                    $('.barang-select2').append(option);
                });
                initializeSelect2();
                $('.barang-select2').val(null).trigger('change');
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

    $(document).ready(function(){
        initializeSelect2();
        $('[name=showTipeBarangTaken]').change(function(){
            if($(this).val() === '1'){
                $('#barang_select2').addClass('d-none');
                $('#tambah_barang_input').removeClass('d-none');
            } else {
                $('#barang_select2').removeClass('d-none');
                $('#tambah_barang_input').addClass('d-none');
            }
        });

        $('input.tipe_barang_taken').change(function() {
            $('.invalid-feedback').remove();
            $('.is-invalid').removeClass('is-invalid');
            $('input, textarea, select').removeClass('is-invalid');
            $('[name=barang_taken]').val($(this).val());
        });

        $('#form_transaksi').submit(function(e){
            e.preventDefault();
            let this_form = this;
            Swal.fire({
                title: 'Yakin?',
                text: "Apakah anda yakin akan menyimpan data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan Transaksi'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#button_submit").attr('data-kt-indicator', "on");
                    $("#button_submit").attr('disabled', "true");
                    $('#modal_loading').modal('show');
                    $.ajax({
                        url:  "{{ route('transaksi.barang_masuk') . '/store-transaksi' }}",
                        type: "POST",
                        enctype: 'multipart/form-data',
                        data: new FormData($('#form_transaksi')[0]),
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            $("#button_submit").removeAttr('data-kt-indicator');
                            $("#button_submit").removeAttr('disabled');
                            $('#modal_loading').modal('hide');
                            if(response.code == 200){
                                iziToast.success({
                                    title: 'Success!',
                                    message: response.message,
                                    position: 'topRight'
                                });
                                this_form.reset();
                                resetAllSelect();
                                refreshSelect2Data();
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
    });

    function clearForm(){
        Swal.fire({
            title: 'Yakin?',
            text: "Apakah anda yakin akan mereset input transaksi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset Transaksi'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#form_transaksi')[0].reset();
                resetAllSelect();
                $('.image-input').addClass('image-input-empty');
                $('.image-input-wrapper').css('background-image', 'none');
            }
        })
    }

    $("#image_barang").change(function(){
        $(".image-input").removeClass("image-input-empty");
    })
</script>
@endsection
