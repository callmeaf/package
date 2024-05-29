<?php

namespace Callmeaf\Package\Events;

use Callmeaf\Package\Models\Package;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;

class PackageTrashed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public LengthAwarePaginator|Collection|\Illuminate\Support\Collection|null $packages)
    {

    }
}
