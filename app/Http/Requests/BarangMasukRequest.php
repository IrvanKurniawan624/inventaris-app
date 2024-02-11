<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BarangMasukRequest extends FormRequest
{
/**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'barang_taken' => 'required|string|max:2',
            'supplier_id' => 'required|numeric|exists:supplier,id',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
            'keterangan_transaksi' => 'required|string',
        ];

        $barangTaken = $this->input('barang_taken');

        if ($barangTaken == 1) {
            $rules['kode_barang'] = 'required|string';
            $rules['kategori_id'] = 'required|numeric|exists:kategori,id';
            $rules['ruang_id'] = 'required|numeric|exists:ruang,id';
            $rules['nama_barang'] = 'required|string';
            $rules['spesifikasi'] = 'required|string';
            $rules['keterangan'] = 'required|string';
        } else {
            $rules['barang_from_table'] = 'required|numeric|exists:master_barang,id';
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator) {

        $errors = json_decode($validator->errors());
        $array = [];

        //format error validation message laravel to Wowrack RESTAPI format
        foreach($errors as $key => $item){
            foreach($item as $error){
                $array[] = [
                    'message' => $error,
                    'field' => $key,
                ];
            }
        }

        throw new HttpResponseException(response()->json([
            'code' => 400,
            'errors' => $array,
            'message' => 'Sorry, looks like there are some errors detected, please try again.'
        ], 400));
    }
}
