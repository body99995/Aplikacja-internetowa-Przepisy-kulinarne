@extends('layouts.app')

@section('title') Konsola Admnistracyjna @endsection
@section('content')


<div id="strona">
    <div id="content">

        <div class="naglowek text-center">
            <h1>{{$site->name}}</h1>
        </div>

        <div class=" naglowek text-center">
            <img src="/upload/{{$site->main_photo }}" style="width: 100%"/>
        </div>

        
        <table class="table table-hover" style="white-space: pre-line;">

            <tr><td></br><h5>Kategoria: {{$site->category}}</h5></br></td></tr>
            <tr><td></br><h3>{{$site->description}}</h3></td></br></tr>
            <tr><td></br><h4>Składniki: <br></br>{{$site->components}}</h4></br></td></tr>
            <tr><td></br><h4>Sposób przyrządzenia: <br></br>{{$site->way_of_preparation}}</h4></br></td></tr>

        </table>
        
        @if ($site->photo1)
        <div class=" naglowek text-center">
            <img src="/upload/{{$site->photo1 }} " style="width: 100%"/>
        </div>
        @endif
        @if ($site->photo2)
        <div class=" naglowek text-center">
            <img src="/upload/{{$site->photo2 }}" style="width: 100%"/>
        </div>
        @endif
        @if ($site->photo3)
        <div class="naglowek text-center">
            <img src="/upload/{{$site->photo3 }}" style="width: 100%"/>
        </div>
        @endif

        @if ($site->URL_video)
        <div class="naglowek text-center">
            <iframe width="560" height="315" src="{{$site->URL_video }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

        </div>
        @endif

        <br>

        <a class="btn btn-info" href="{{ url('/console') }}">Powrót</a>

    </div>
</div>

@endsection

