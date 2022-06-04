<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class NakesProfileRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'tanggallahir' => Carbon::createFromFormat('d/m/Y', $this->tanggallahir)->format('Y-m-d'),
        ]);
    }

    public function withValidator($validator)
    {
        if($validator->fails()){
            flashError($validator->errors()->first());
            return back();
        }
        // $validator->after(function ($validator) {
            
        // });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|exists:mpegawai,id',
            'nik' => 'string',
            'nama' => 'required|string',
            'tempatlahir' => 'nullable|string',
            'tanggallahir' => 'nullable|date',
            'jeniskelamin' => 'required|string',
            'alamat' => 'nullable|string',
            'nohp' => 'nullable|string',
            "provinsi" => 'nullable|string',
            "kabkota" => 'required|string',
            "kecamatan" => 'nullable|string',
            "kelurahan" => 'nullable|string',
            "perguruantinggi" => 'nullable|string',
            "tahunlulus" => 'nullable|integer',
            "idjenispraktik" => 'nullable|integer',
            "idspesialisasi" => 'nullable|integer',
            "jenispraktik" => 'nullable|string',
            "spesialisasi" => 'nullable|string',
            "foto" => 'file|mimetypes:image/jpeg,image/png|max:512',
        ];
    }
}
