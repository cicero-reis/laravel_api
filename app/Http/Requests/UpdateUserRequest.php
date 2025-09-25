<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules(User $user): array
    {
        $result = $user->find($this->route('id'));

        if ($result?->id) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,'.$result->id,
            ];
        }

        return [];

    }
}
