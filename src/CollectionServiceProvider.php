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

        Collection::macro('fail', function ($rules) {
            return $this->filter(function ($item) use($rules) {
                return validator()->make($item, $rules)->fails();
            });
        });

        Collection::macro('ifAny', function ($callback) {
            if(!$this->isEmpty()) {
                return $callback($this);
            }

            return $this;
        });

        Collection::macro('ifEmpty', function ($callback) {
            if($this->isEmpty()) {
                return $callback($this);
            }

            return $this;
        });

        Collection::macro('pass', function ($rules) {
            return $this->filter(function ($item) use($rules) {
                return validator()->make($item, $rules)->passes();
            });
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
