<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'titre' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'temps_de_preparation' => 'required',
            'temps_de_cuisson' => 'required',
            'categories' => 'required|array',
        ];
        
        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
    
        return $rules;
    }
}
