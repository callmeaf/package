<?php

namespace Callmeaf\Package\Events;

use Callmeaf\Package\Models\Package;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PackageShowed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Package $package)
    {

    }
}
