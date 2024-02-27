<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Rules\MoodsRequestRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role->name = Role::ROLE_EDITOR;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'numberOfDays' => 'required|integer|min:1',
            'description' => 'string',
            'moods' => ['sometimes',new MoodsRequestRule()]
        ];
    }
}
