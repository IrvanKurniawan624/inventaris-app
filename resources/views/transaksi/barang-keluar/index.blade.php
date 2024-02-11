@extends('layouts.app')

@section('breadcrumb')
<h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Barang Keluar</h1>
<x-breadcrumb :currentURL="['name' => 'Barang Keluar']" :dataURL="[['name' => 'Transaksi', 'url' => '#']]">
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
                <h1 class="fw-bolder text-dark">Barang Keluar</h1>
            </div>
        </div>
    </div>
    <div class="card-body pt-10">
        <form id="form_transaksi">
            <div id="barang_select2">
                <div class="row barang-row">
                    <div class="col-6 col-md-6 mb-6">
                        <div class="form-group">
                            <label class="fs-5 fw-bold mb-2">Barang</label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                <div class="flex-grow-1">
                                    <select class="form-select select-2 form-select-solid rounded-start-0 border-start barang-select2" name="id_barang[]" required
                                     data-placeholder="Select an option">
                                        <option></option>
                                        @foreach ($barang as $item)
                                        <option value="{{ $item->id }}" data-kode="{{ $item->kode_barang }}" data-jumlah="{{ $item->jumlah }}" data-kt-select2-img="{{ $item->image }}">{{ $item->nama_barang }}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4 mb-6">
                        <div class="form-group">
                            <label class="fs-5 fw-bold mb-2 label-jumlah">Jumlah</label>
                            <p class="max-jumlah text-danger"></p>
                            <div class="d-flex barang-action-container" style="gap: 20px">
                                <input type="text" class="form-control form-control-solid" onkeypress="return onKeypressAngka(event,false)" placeholder="Masukkan Jumlah" name="jumlah[]" required>
                                <button type="button" class="btn btn-danger button-action-barang-transaksi d-none button-delete-barang" onclick="delete_barang_input($(this))">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
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
                    <div class="col-12 col-md-12 mb-6">
                        <div class="form-group">
                            <label class="fs-5 fw-bold mb-2">Keterangan Barang Keluar</label>
                            <textarea class="form-control" placeholder="Masukkan Keterangan" style="min-height: 100px" name="keterangan_transaksi"></textarea>
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
@section('script')
<script>
    var selectedValuesArray = [];
    let countBarang;
    $(document).ready(function(){
        countBarang = {{ count($barang) }};
        initializeSelect2();
        addPlusBarangButton();
    });

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
            class: "fw-bolder badge badge-primary ms-2"
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
        $('.barang-select2[name="id_barang[]"]').on('change', function() {
            checkSelect2($(this));
        });
    }

    function checkSelect2(element) {
        var selectedOption = $(element).find(':selected');
        var maxJumlah = selectedOption.data('jumlah');
        var conditionMet = false;

        $('.barang-select2[name="id_barang[]"]').not(element).each(function(index, select) {
            if ($(element).val() === $(select).val() && $(element).val() !== '') {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Barang sudah dipilih.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                $(element).val(null).trigger('change.select2');
                $(element).closest('.barang-row').find('.max-jumlah').text('');
                conditionMet = true;
                return false;  // Exit the each loop
            }
        });

        if (conditionMet) return;
        if(maxJumlah !== undefined){
            $(element).closest('.barang-row').find('.max-jumlah').text(`(max : ${maxJumlah})`);
        }
    }


    function add_barang_input(){
        $('#barang_select2').append(`
            <div class="row barang-row">
                <div class="col-6 col-md-6 mb-6">
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2">Barang</label>
                        <div class="input-group input-group-solid">
                            <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                            <div class="flex-grow-1">
                                <select class="form-select select-2 form-select-solid rounded-start-0 border-start barang-select2" name="id_barang[]" required
                                    data-placeholder="Select an option">
                                    <option></option>
                                    @foreach ($barang as $item)
                                    <option value="{{ $item->id }}" data-kode="{{ $item->kode_barang }}" data-jumlah="{{ $item->jumlah }}" data-kt-select2-img="{{ $item->image }}">{{ $item->nama_barang }}</option>                                            
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 mb-6">
                    <div class="form-group">
                        <label class="fs-5 fw-bold mb-2 label-jumlah">Jumlah</label>
                        <p class="max-jumlah text-danger"></p>
                        <div class="d-flex barang-action-container" style="gap: 20px">
                            <input type="text" class="form-control form-control-solid" onkeypress="return onKeypressAngka(event,false)" placeholder="Masukkan Jumlah" name="jumlah[]" required>
                            <button type="button" class="btn btn-danger button-action-barang-transaksi d-none button-delete-barang" onclick="delete_barang_input($(this))">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `);
        $('.button-delete-barang').toggleClass('d-none', $('.barang-row').length <= 1);
        initializeSelect2();
        $('.barang-select2').trigger('select2:updated');
        addPlusBarangButton();
    }

    function delete_barang_input(element){
        element.closest('.barang-row').remove();
        $('.button-delete-barang').toggleClass('d-none', $('.barang-row').length == 1);
        addPlusBarangButton();
    }

    function addPlusBarangButton(){
        let buttonElement = $('.barang-row').length >= countBarang
        ? `<button type="button" class="btn btn-secondary button-action-barang-transaksi button-add-barang" disabled onclick="add_barang_input()"><i class="bi bi-plus-lg"></i></button>`
        : `<button type="button" class="btn btn-success button-action-barang-transaksi button-add-barang" onclick="add_barang_input()"><i class="bi bi-plus-lg"></i></button>`;
        $('.button-add-barang').remove();
        $(".barang-action-container:not(:last) .button-delete-barang").addClass('margin-custom-btn-barang');
        $(".barang-action-container:last").append(buttonElement);
        $(".barang-action-container:last .button-delete-barang").removeClass('margin-custom-btn-barang');
    }

    function refreshSelect2Data(){
        $.ajax({
            url: `{{ route('transaksi.barang_keluar') . '/get-select2-data' }}`,
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
                $('.barang-select2').closest('.barang-row').find('.max-jumlah').text('');
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
                    url:  "{{ route('transaksi.barang_keluar') . '/store-transaksi' }}",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    data: $('#form_transaksi').serialize(),
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
                            $('.max-jumlah').text('');
                            $('.barang-row:not(:first)').remove();
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
</script>
@endsection
