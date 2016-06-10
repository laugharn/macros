<?php

namespace Laugharn\Macros;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Request::macro('filter', function () {
            return collect($this->all())->filter();
        });
    }

    public function register()
    {
        //
    }
}
