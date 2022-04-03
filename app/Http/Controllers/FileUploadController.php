<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
//         'file' => 'required|xml|max:2048',
//            'file' => ['required', 'mimes:xml'],
            'file' => ['required'],
        ]);

        $name = $request->file('file')->getClientOriginalName();

        // грузим файл в паблик-файлы
        $path = $request->file('file')->store('public/xmlupload');

        $save = new File;

        $save->name = $name;
        $save->path = $path;

        // авторизованный юзером
        // https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
        $save->user_id = Auth::id();

        if (!$save->push())
            return redirect('list')->with('fail', 'Не получилось загрузить файл.');    ;

        return redirect('list')->with('success', 'Файл загружен. Проверьте реестры.');

    }
}
