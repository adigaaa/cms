<?php 
namespace Api\Posts\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title'=> 'bail|required|string|max:100|min:5',
            'body' => 'bail|required|string|min:100',
            'image'=> 'bail|sometimes|image|mimes:jpg,jpeg,gif,png',
        ];
    }
}