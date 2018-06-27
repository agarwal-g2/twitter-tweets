@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!empty($tweets))
            <div class="row">
                <div class="col-md-4 ">
                    <div class="panel panel-success">
                        <div class="panel-heading">Positive Tweets <i class="fa fa-twitter" aria-hidden="true"></i></div>

                        <div class="panel-body">
                            @foreach($tweets->statuses as $tweet)
                                @if($tweet->polarity == 'positive')
                                    <img src="{{$tweet->user->profile_image_url}}" alt="profile image" />
                                    <strong>{{$tweet->user->name}}</strong> <span class="light"> @ {{$tweet->user->screen_name}} </span><br>
                                    {{$tweet->text}}<br>
                                    - <span class="time">{{$tweet->created_at}}</span>
                                    <br/>
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Neutral Tweets <i class="fa fa-twitter" aria-hidden="true"></i></div>

                        <div class="panel-body">
                            @foreach($tweets->statuses as $tweet)
                                @if($tweet->polarity == 'neutral')
                                    <img src="{{$tweet->user->profile_image_url}}" alt="profile image" />
                                    <strong>{{$tweet->user->name}}</strong> <span class="light"> @ {{$tweet->user->screen_name}} </span><br>
                                    {{$tweet->text}}<br>
                                    - <span class="time">{{$tweet->created_at}}</span>
                                    <br/>
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Negative Tweets <i class="fa fa-twitter" aria-hidden="true"></i></div>

                        <div class="panel-body">
                            @foreach($tweets->statuses as $tweet)
                                @if($tweet->polarity == 'negative')
                                    <img src="{{$tweet->user->profile_image_url}}" alt="profile image" />
                                    <strong>{{$tweet->user->name}}</strong> <span class="light"> @ {{$tweet->user->screen_name}} </span><br>
                                    {{$tweet->text}}<br>
                                    - <span class="time">{{$tweet->created_at}}</span>
                                    <br/>
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">No Tweets Found</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
