@extends('layouts.app')

@section('title') Konsola Admnistracyjna @endsection

@section('content')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<div class="naglowek text-center">
    <h1>Konsola Admnistracyjna</h1>
</div>


<div class="section-features section-bg-color2">
    <div class="panel-ster">
        <div class="row">
            <div class="col-md-8">
                <a class="btn btn-info" href="{{url('/add')}}">Dodaj nowy przepis</a>
                <a class="btn btn-dark" href="{{url('/raport')}}">Statystyki</a>
            </div>

            <div class="col-md-4 text-right">
                <form action="/search" method="get">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Szukaj</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-hover">
            <thead class="table-active">
                <tr >
                    <th>@sortablelink('id')</th>
                    <th>@sortablelink('name','Nazwa przepisu')</th>
                    <th>@sortablelink('category','Kategoria')</th>
                    <th>Edytuj</th>    
                    <th>Usuń</th>   
                </tr>
            </thead>
            @foreach($sites as $site)
            <tr>
                <td><a href="{{route('sites.show', $site)}}">{{$site->id}}</a></td> 
                <td><a href="{{route('sites.show', $site)}}">{{$site->name}}</a></td>        
                <td><a href="{{route('sites.show', $site)}}">{{$site->category}}</a></td>
                <td><a class="btn btn-info" href="{{route('sites.edit', $site)}}">Edytuj</a></td>

                <td>    <form id="frm_{{$site->id}}" action="{{route('sites.delete', $site->id)}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="javascript:if(confirm('Czy na pewno chcesz usunąć przepis?')) $('#frm_{{$site->id}}').submit()" class="btn btn-danger">Usuń</a> <!--okno z zapytaniem czy na pewno usunąć-->
                    </form>

                </td> 
            </tr>
            @endforeach
        </table>

        <!--{{ $sites->links() }}-->
        {!! $sites->appends(\Request::except('page'))->render() !!}
    </div>
</div>

@endsection


