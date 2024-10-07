<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait setSlug
{

    public function setSlugAttribute($model, $name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 2;

        while ($model::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
