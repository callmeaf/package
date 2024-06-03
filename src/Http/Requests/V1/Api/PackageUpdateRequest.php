<?php

namespace Callmeaf\Package\Http\Requests\V1\Api;

use Callmeaf\Package\Enums\PackageType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PackageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-package.form_request_authorizers.package'))->update();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'type' => [new Enum(PackageType::class)],
            'deadline' => ['integer'],
        ],filters: app(config("callmeaf-package.validations.package"))->update());
    }

}
