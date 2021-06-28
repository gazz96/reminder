<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'client' => 'required',
            'nama_perusahaan' => 'required',
            'email' => 'required',
            'kontak' => 'required',
            'domain' => 'required',
            'register' => 'required',
            'tanggal_beli_domain' => 'required',
            'tanggal_expired_domain' => 'required',
            'status' => 'required'
        ];
    }
}
