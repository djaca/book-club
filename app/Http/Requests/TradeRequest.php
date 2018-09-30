<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TradeRequest extends FormRequest
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
            'offered_book_id' => 'required',
            'requested_book_id' => [
                'required',
                Rule::unique('trades')->where(function ($query) {
                    return $query->where('offered_book_id', $this->offered_book_id)
                        ->where('status', 'pending');
                })
            ],
        ];
    }

    public function messages()
    {
        return [
            'requested_book_id.unique' => 'You already requested that book',
            'offered_book_id.required' => 'You must pick a book to offer'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        flash()->error($validator->messages()->first());

        return parent::failedValidation($validator);

    }
}
