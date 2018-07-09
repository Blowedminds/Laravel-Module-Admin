<?php

namespace App\Modules\Editor\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('admin')->except([
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

    public function postLanguage(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'slug' => 'required'
        ]);

        if (!$language = Language::find(intval($request->input('id')))) return;

        $language->name = $request->input('name');

        $language->slug = $request->input('slug');

        $language->save();

        return response()->json(['TEBRIKLER']);
    }

    public function putLanguage(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        if ($language = Language::where('slug', $request->input('slug'))->first()) return;

        $language = Language::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug')
        ]);

        return response()->json(['TEBRIKLER']);
    }

    public function deleteLanguage($id)
    {
        if (!$language = Language::find(intval($id))) return;

        $language->forceDelete();

        return response()->json(['TEBRIKLER']);
    }
}