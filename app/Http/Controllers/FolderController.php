<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Folder;
use App\Models\File;

class FolderController extends Controller
{
    public function show($id){
        $folder = Folder::find($id);
        $path = $folder->path;
        $files = Storage::files($path);
        $folders = Storage::directories($path);
        return view('home',compact('files','folders','path'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','unique:folders']
        ]);
        $path = $request->path.'/'.$request->name;
        $request['path'] = $path;
        Folder::create($request->all());
        Storage::makeDirectory($path);
        return redirect()->back()->with('success', 'Folder Created Successfully');
    }

    public function open(Request $request){
        $files = Storage::files($request->path);
        $folders = Storage::directories($request->path);
        return view('home',compact('files','folders'));
    }
}
