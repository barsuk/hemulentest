<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use SimpleXMLElement;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Handle an incoming new password request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Валидация типа (отложим на будущее)
        $request->validate([
//         'file' => 'required|xml|max:2048',
//            'file' => ['required', 'mimes:xml'],
            'file' => ['required'],
        ]);

        // грузим файл в паблик-файлы, имя и тип файла задаются Ларавелем
        $path = $request->file('file')->store('public/xmlupload');

        $save = new File;

        $save->name = $request->file('file')->getClientOriginalName();
        $save->path = $path;

        // авторизованный юзером
        // https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
        $save->user_id = Auth::id();

        if (!$save->push()) {
            return redirect('list')->with('fail', 'Не получилось загрузить файл.');
        }

        // Парсим
        $raw = $request->file('file')->getContent();

        $entries = new SimpleXMLElement($raw);
        $nss = $entries->getNamespaces(1);
        $person = (object)$entries->children($nss['tns'])->PhysicalPersonData;

        $entry = new Person;
        $entry->lastname = $person->lastname;
        $entry->firstname = $person->firstname;
        $entry->middlename = $person->middleName; // нежданный камелькейс
        $entry->user_id = Auth::id();
        $entry->file_id = $save->id;
        $entry->push();

        return redirect('list')->with('success', 'Файл загружен. Проверьте реестры.');

    }
}
