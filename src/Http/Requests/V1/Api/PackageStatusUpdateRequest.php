<?php

namespace Callmeaf\Package\Http\Requests\V1\Api;

use Callmeaf\Product\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PackageStatusUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-package.form_request_authorizers.package'))->statusUpdate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'status' => [new Enum(ProductStatus::class)],
        ],filters: app(config("callmeaf-package.validations.package"))->statusUpdate());
    }

}
