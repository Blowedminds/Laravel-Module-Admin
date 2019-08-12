<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\SiteOption;

class SiteOptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'permission:ownership.options']);
    }

    public function getOptions()
    {
        return SiteOption::all();
    }

    public function postOption()
    {
        request()->validate([
            'key' => 'required',
            'type' => 'required',
            'value' => 'required'
        ]);

        SiteOption::create(request()->only(['key', 'type', 'value']));

        return response()->json();
    }

    public function putOption($option_key)
    {
        request()->validate([
            'value' => 'required'
        ]);

        SiteOption::where('key', $option_key)->firstOrFail()->update(request()->only(['value']));

        return response()->json();
    }

    public function deleteOption($option_key)
    {
        SiteOption::where('key', $option_key)->delete();

        return response()->json();
    }
}
