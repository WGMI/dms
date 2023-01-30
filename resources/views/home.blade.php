@extends('layouts.app')

@section('content')
    <div class="col py-3">
        @if(session()->has('success'))
            <div id="message" class="alert alert-success" role="alert">{{session('success')}}&nbsp;<a href="#" onclick="document.getElementById('message').innerHTML = '';document.getElementById('message').classList = ''">Close</a></div>
        @endif    
        <div class="container mx-auto mt-6">
            <div class="row"> 
                @if($files)               
                    @foreach($files as $file)
                        @php
                        $arr = explode('.',$file->name);
                        $icon = $arr[count($arr) - 1];
                        @endphp
                        <div class="col-md-2">
                            <div class="card" style="width: 9rem; margin-bottom: 2rem;">
                                <img src="{{asset('images/'.$icon.'.png')}}" onerror="this.src='{{asset("images/paper.png")}}'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    @php
                                    $title = (strlen($file->name) > 12) ? substr($file->name,0,12).'...' : $file->name;
                                    @endphp
                                    <h6 class="card-title">{{$title}}</h6>
                                    <p class="card-subtitle mb-2 text-muted">{{Carbon\Carbon::parse($file->created_at)->format('d M, Y')}}</p>
                                    <!-- <a href="#" class="btn btn-success"><i class="fas fa-link"></i> Details</a> -->
                                    <a href="{{url('files/'.$file->id)}}" class="btn btn-success  "><i class="fab fa-github"></i> Download</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-2">
                        Temporarily Disabled
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
