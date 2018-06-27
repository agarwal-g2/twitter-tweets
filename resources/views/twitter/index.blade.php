@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <form  action="{{route('twitter-api')}}" method="POST">
                            <br/>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                            <div class="form-group">
                                <label for="email">Enter Hashtag:</label>
                                <input type="text" class="form-control" id="hashtag" placeholder="Enter Hashtag to search on Twitter for tweets" name="hashtag">
                            </div>

                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                        <br/>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
