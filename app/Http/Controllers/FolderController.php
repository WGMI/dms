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
        // $files = File::where('path','like',$folder->path.'%')->get();
        $files = \File::files($folder->path);
        return view('home',compact('files'));
    }

    public function store(Request $request){
        $path = $request->user_id.'/'.$request->name;
        $request['path'] = $path;
        Folder::create($request->all());
        Storage::makeDirectory($path);
        return redirect()->back()->with('success', 'Folder Uploaded Successfully');
    }
}
