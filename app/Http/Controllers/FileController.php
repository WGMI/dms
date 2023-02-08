<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\File;
use App\Traits\Upload;

class FileController extends Controller
{
    use Upload;//add this trait

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /*$folders = auth()->user()->folders;
        $files = auth()->user()->files;*/
        $path = auth()->user()->id;
        $files = Storage::files(auth()->user()->id);
        $folders = Storage::directories(auth()->user()->id);
        return view('home',compact('files','folders','path'));
    }

    public function recent()
    {
        $files = File::where([['owner_id','=',auth()->user()->id],['created_at','>',\Carbon\Carbon::parse(strtotime('30 days ago'))->format('Y-m-d')]])->get();
        return view('home',compact('files'));
    }

    public function shared()
    {
        return 'Temporarily disabled';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->hasFile('file')){
            return;
        }

        $folder = $request->path;
        $name = $request->file('file')->getClientOriginalName();
        $path = Storage::putFileAs($folder, $request->file('file'), $name);
        // $path = $this->UploadFile($request->file('file'), $folder, 'public', $name);//use the method in the trait
        File::create([
            'owner_id' => auth()->user()->id,
            'name' => $name,
            'path' => $path
        ]);
        return redirect()->back()->with('success', 'File Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $file = File::find($id);
        return Storage::download($file->path);
        //dd(public_path()."\storage\\".$file->path);
        // return response()->download(public_path()."\storage\\".$file->path, $file->name);//Storage::download(public_path()."\storage\\".$file->path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
