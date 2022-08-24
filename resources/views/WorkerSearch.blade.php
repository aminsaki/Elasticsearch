@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-primary" style="text-align: center;">Laravel  Search Using Elasticsearch</h1>
        </div>
    </div>
    <div class="container" style="text-align: center">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-6">
                        {!! Form::open(array('method'=>'get','class'=>'')) !!}
                        <div class="input-group">
                            <input name="search" value="{{ old('search') }}" type="text" class="form-control"
                                   placeholder="Search for...">
                            <span class="input-group-btn">
		        <button class="btn btn-default" type="submit">Go!</button>
		      </span>
                        </div><!-- /input-group -->
                        {!! Form::close() !!}
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>
            <div class="panel-body" style="text-align:center ">
                <div class="row">
                    <div class="col-lg-6">
                    @if(!empty($workers))
                            @foreach($workers as $key => $value)
                                <h3 class="text-danger">{{ $value['name'] }}</h3>
                                <p>{{ $value['country'] }}</p>
                            @endforeach
                        @elseif(!empty($elastic))
                            @foreach($elastic as $key => $value)
                                <h3 class="text-danger">{{ $value['_source']['name'] }}</h3>
                                <p>{{ $value['_source']['country'] }}</p>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
