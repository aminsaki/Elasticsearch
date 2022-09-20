@extends('layouts.app')
@section('container')
    <div class="row">
        <form action="{{url('myserach')}}" method="post" class="row">
            @csrf
            <div class="col-lg-9">
                <input type="search" name="search" class="form-control"/>
            </div>
            <div class="col-lg-3">
                <button type="submit" class="btn btn-primary">
                    serach
                </button>
            </div>

        </form>
    </div> <br><br>
    <div class="row " style="border:1px groove #4a5568">
        @foreach($posts as $row)
            <div class="col-md-3">
                <figure class="figure" style="border: #718096 solid">
                    <img src="{{ isset($row['image_url'])? $row['image_url'] : $row['_source']['image_url']  }}"
                         class="figure-img img-fluid rounded" alt="...">
                    <h3 class="figure-caption" style="color:red">{{isset($row['title'])? $row['title'] : $row['_source']['title']}}</h3>
                    <span>{{isset($row['body'])? $row['body'] :  $row['_source']['body']}}</span>
                </figure>
            </div>
        @endforeach
    </div>
@endsection
