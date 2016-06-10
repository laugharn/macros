<?php

namespace Laugharn\Macros;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::macro('associate', function ($key = null, $value = null) {
            return $this->reduce(function ($items, $values) use($key, $value) {
                $values = collect($values);
                list($key, $value) = (is_null($key) ? $values->take(2)->values()->toArray() : [$values->get($key), $values->get($value)]);
                return $items->put($key, $value);
            }, new static);
        });

        Collection::macro('then', function ($callback) {
            return $callback($this);
        });

        Collection::macro('transpose', function () {
            $items = array_map(function (...$items) {
                return $items;
            }, ...$this->values());

            return new static($items);
        });
    }

    public function register()
    {
        //
    }
}
