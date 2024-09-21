<?php

namespace Callmeaf\Package\Utilities\V1\Api\Package;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class PackageFormRequestValidator extends FormRequestValidator
{
   public function index(): array
   {
       return [
           'title' => false,
           'slug' => false,
       ];
   }

   public function store(): array
   {
       return [
           'product_id' => true,
           'type' => true,
           'deadline' => false,
       ];
   }

   public function show(): array
   {
       return [];
   }

   public function update(): array
   {
       return [
           'type' => true,
           'deadline' => false,
       ];
   }

   public function statusUpdate(): array
   {
       return [
           'status' => true,
       ];
   }

   public function destroy(): array
   {
       return [];
   }


}
