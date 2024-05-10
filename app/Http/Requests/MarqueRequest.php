<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class MarqueRequest extends FormRequest
{
    private const ALLOWED_EXTENSION = 'jpg,jpeg,png,webp,gif';

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
         // get the brand id ( for updating only )
         $currentBrandId = 0;
         if ($this->has('id')){
             $currentBrandId = $this->get('id');
         }
 
         return [
            'name' => 'required|max:255|unique:marques,name'  . $this->marque ,
            'gmail' => 'required|email|max:255',
            
        ];

            

        
    }

    public function messages()
{
    return [
        'name.unique' => 'la marque existe déjà.',
    ];
}
}
