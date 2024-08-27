<?php

namespace Module\Admins\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
     /**
     * The Name of namespace for request.
     *
     * @var string
     */
    protected string $namespace;

    /**
     * The URI that users should be redirected to if validation fails.
     *
     * @var string
     */
    protected string $redirect;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 2));
        $this->redirect = back();
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'title' => 'required|integer',
            'phone' => 'required|unique:contact_phones,phone',
            'email' => 'required|email|unique:contact_emails,email',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => _trans($this->namespace, 'validation.required', ['attribute' =>  _trans($this->namespace, 'name')]),
            'title.required' =>  _trans($this->namespace, 'validation.required', ['attribute' =>  _trans($this->namespace, 'admin-title')]),
            'phone.required' =>  _trans($this->namespace, 'validation.required', ['attribute' =>  _trans($this->namespace, 'phone')]),
            'email.required' =>  _trans($this->namespace, 'validation.required', ['attribute' =>  _trans($this->namespace, 'email')]),
            'email.email' => '',
        ];
    }
}
