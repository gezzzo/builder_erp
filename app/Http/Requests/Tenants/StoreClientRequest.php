<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'salesman' => 'required|string|max:255',
            'interest' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'contact_method' => 'required|string|max:255',
            'budget' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'neighbourhood' => 'required|string|max:255',
            'notes' => 'required|string|max:255',
            'legal_agent' => 'required|string|max:255',
            'is_lead' => 'required|boolean',
            'is_tax_exempted' => 'required|boolean',
            'is_deleted' => 'required|boolean',
            'is_active' => 'required|boolean',
            'national_id' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'national_address' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'iban_certification' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
