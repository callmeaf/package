<?php

namespace Callmeaf\Package\Http\Requests\V1\Api;

use Callmeaf\Base\Enums\DateTimeFormat;
use Callmeaf\Package\Enums\PackageStatus;
use Callmeaf\Package\Enums\PackageType;
use Callmeaf\Product\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class PackageStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-package.form_request_authorizers.package'))->store();
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
            'type' => [new Enum(PackageType::class)],
            'title' => ['string','min:3','max:255'],
            'slug' => ['string','min:3','max:255',Rule::unique(config('callmeaf-product.model'),'slug')],
            'summary' => ['string','max:255'],
            'content' => ['string','max:700'],
            'published_at' => ['date_format:' . DateTimeFormat::DATE_TIME_WITH_DASH_AND_TIME_WITH_DOUBLE_POINT->value],
            'expired_at' => ['date_format:' . DateTimeFormat::DATE_TIME_WITH_DASH_AND_TIME_WITH_DOUBLE_POINT->value],
            'deadline' => ['integer'],
        ],filters: app(config("callmeaf-package.validations.package"))->store());
    }

}
