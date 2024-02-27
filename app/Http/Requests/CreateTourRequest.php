<?php

namespace App\Http\Requests;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateTourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (! $this->user()) {
            return false;
        }

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
            'title' => 'required|string|max:255|unique:tours,name',
            'startingDate' => 'required|date:Y-m-d',
            'endingDate' => 'required|date_format:Y-m-d|after:startingDate',
            'travelId' => 'required|string',
            'price' => 'required|numeric',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validatedData = parent::validated($key, $default);

        if (array_key_exists('startingDate', $validatedData)) {
            $validatedData['startingDate'] = Carbon::createFromFormat('Y-m-d', $validatedData['startingDate']);
        }
        if (array_key_exists('endingDate', $validatedData)) {
            $validatedData['endingDate'] = Carbon::createFromFormat('Y-m-d', $validatedData['endingDate']);
        }

        return $validatedData;
    }
}
