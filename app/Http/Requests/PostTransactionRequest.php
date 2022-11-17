<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostTransactionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = Auth::user();

        return [
            'date' => 'required|date',
            'from' => [
                'required',
                Rule::exists('accounts', 'name')->where(function($query){
                    return $query->where('name', $this->from);
                })
            ],
            'to' => [
                'required',
                Rule::exists('accounts', 'name')->where(function($query){
                    return $query->where('name', $this->to);
                })
            ],
            'amount' => 'required|numeric',
            'description' => 'nullable|string' 
        ];
    }

    public function attributes()
    {
        return [
            'date' => 'data',
            'from' => 'conta de origem',
            'to' => 'conta de destino',
            'amount' => 'valor',
            'description' => 'descrição'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute é obrigatório',
            'exists' => ':attribute informada não foi encontrada',
            'numeric' => ':attribute deve ser um valor numérico'
        ];
    }
}
