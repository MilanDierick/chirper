<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reservation_type_id' => ['required', 'exists:reservation_types'],
            'child_id'            => ['required', 'exists:children'],
            'event_id'            => ['required', 'exists:events'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
