@extends('layouts.app')

@section('content')
    <style>
        
  .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
  
    /* Position the tooltip text */
    position: absolute;
    z-index: 1;
    bottom: 1%;
    left: 1%;
    margin-left: 60px;
  
    /* Fade in tooltip */
    opacity: 0;
    transition: opacity 0.3s;
  }
  
  .titletext:hover + .tooltiptext {
    visibility: visible;
    opacity: 1;
  }
    </style>
    <div class="col py-3">
        @if(session()->has('success'))
            <div id="message" class="alert alert-success" role="alert">{{session('success')}}&nbsp;<a href="#" onclick="document.getElementById('message').innerHTML = '';document.getElementById('message').classList = ''">Close</a></div>
        @endif    
        @if ($errors->any())
            <div id="error" class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            &nbsp;
            <a href="#" onclick="document.getElementById('error').innerHTML = '';document.getElementById('error').classList = ''">Close</a></div>
        @endif
        <div class="container mx-auto mt-6">
            <div class="row">
                @if($folders)
                    @foreach($folders as $folder)
                    @php
                    $details = pathinfo($folder);
                    $name = $details['filename'];
                    @endphp  
                    <div class="col-md-2">
                        <div class="card" style="width: 9rem; margin-bottom: 2rem;">
                            <img src="{{asset('images/folder.png')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">{{$name}}</h6>
                                <p class="card-subtitle mb-2 text-muted">...</p>
                                <a href="{{url('folder/'.\App\Models\Folder::where('path',$folder)->first()->id)}}" class="btn btn-success"><i class="fab fa-github"></i>Open</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                @if($files)               
                    @foreach($files as $file)
                        @php
                        $details = pathinfo($file);
                        $name = $details['filename'];
                        $icon = $details['extension'];
                        @endphp
                        <div class="col-md-2">
                            <div class="card" style="width: 9rem; margin-bottom: 2rem;">
                                <img src="{{asset('images/'.$icon.'.png')}}" onerror="this.src='{{asset("images/paper.png")}}'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    @php
                                    $title = (strlen($name) > 10) ? substr($name,0,10).'...' : $name;
                                    @endphp
                                    <h6 class="card-title titletext">{{$title}}</h6>
                                    <span class="tooltiptext">{{$name}}</span>
                                    <p class="card-subtitle mb-2 text-muted">{{Carbon\Carbon::parse(Storage::lastModified($file))->format('d M, Y')}}</p>
                                    <a href="{{url('files/'.App\Models\File::where('path',$file)->first()->id)}}" class="btn btn-success  "><i class="fab fa-github"></i>Download</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
