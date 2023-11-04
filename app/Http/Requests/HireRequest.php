<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HireRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'names' => 'nullable',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date'
                ];
            }
            default:break;
        }
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'names.required' => 'Choosing at least one developer is required!',
            'start_date.required' => 'Start Date is required!',
            'end_date.required' => 'End Date is required!'
        ];
    }
}
