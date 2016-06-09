<?php

namespace Laugharn\Macros;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class BuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Builder::macro('if', function ($condition, $column, $operator, $value) {
            if ($condition) {
                return $this->where($column, $operator, $value);
            }
            
            return $this;
        });
    }

    public function register()
    {
        //
    }
}
