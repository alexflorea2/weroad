<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Rules\MoodsRequestRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role->name = Role::ROLE_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:travels,name',
            'numberOfDays' => 'required|integer|min:1',
            'description' => 'string',
            'isPublic' => 'sometimes|boolean',
            'moods' => ['sometimes', new MoodsRequestRule()],
        ];
    }
}
