<?php

namespace Callmeaf\Package\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Package\Enums\PackageType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Package extends Model implements HasResponseTitles,HasEnum
{
    use HasDate,HasStatus,HasType;
    protected $fillable = [
        'product_id',
        'type',
        'deadline',
    ];

    protected $casts = [
        'type' => PackageType::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(config('callmeaf-product.model'),'product_id','id');
    }

    public function responseTitles(ResponseTitle|string $key,string $default = ''): string
    {
        $product = $this->product()->select(['title'])->first();
        return [
            'store' => $product?->title ?? $default,
            'update' => $product?->title ?? $default,
            'status_update' => $product?->title ?? $default,
            'destroy' => $product?->title ?? $default,
        ][$key instanceof ResponseTitle ? $key->value : $key];
    }

    public static function enumsLang(): array
    {
        return __('callmeaf-product::enums');
    }
}
