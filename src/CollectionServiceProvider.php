<?php

namespace Laugharn\Macros;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::macro('associate', function () {
            return $this->reduce(function ($items, $pair) {
                list($key, $value) = $pair;
                return $items->put($key, $value);
            }, new static);
        });

        Collection::macro('pipe', function ($callback) {
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
