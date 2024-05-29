<?php

namespace Callmeaf\Package\Utilities\V1\Package\Api;

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
           'status' => true,
           'type' => true,
           'title' => true,
           'slug' => true,
           'summary' => false,
           'content' => false,
           'published_at' => false,
           'expired_at' => false,
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
           'status' => true,
           'type' => true,
           'title' => true,
           'slug' => true,
           'summary' => false,
           'content' => false,
           'published_at' => false,
           'expired_at' => false,
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
