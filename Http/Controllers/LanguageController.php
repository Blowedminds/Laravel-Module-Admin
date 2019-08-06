<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('permission:ownership.language')->except([
            'getLanguages'
        ]);
    }

    public function getLanguages()
    {
        $languages = Language::all()->map(function ($language) {
            return [
                'id' => $language->id,
                'name' => $language->name,
                'slug' => $language->slug
            ];
        });

        return response()->json($languages);
    }

    public function putLanguage($language_id)
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        $language = Language::findOrFail($language_id);

        $language->update(request()->only(['name', 'slug']));

        return response()->json();
    }

    public function postLanguage()
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        Language::create(request()->only(['name', 'slug']));

        return response()->json();
    }

    public function deleteLanguage($language_id)
    {
        Language::findOrFail($language_id)->forceDelete();

        return response()->json();
    }
}
