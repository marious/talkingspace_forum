@extends('app')

@section('browserTitle') {{ $topic->title }} @stop

@section('content')
    <ul id="topics">
        <li id="main-topic" class="topic topic">
            <div class="row">
                <div class="col-md-2">
                    <div class="user-info">
                        <img class="avatar pull-left" src="{{ asset('assets/images/avatars/' . $topic->avatar) }}">
                        <ul>
                            <li><strong>{{ $topic->username }}</strong></li>
                            <li>34posts</li>
                        </ul>
                    </div>
                </div>


                <div class="col-md-10">
                    <div class="topic-content pull-right">
                        <h2>{{ $topic->title }}</h2>
                        <p>{{ $topic->body }}</p>
                    </div>
                </div>
            </div>
        </li>

        @if (sizeof($replies) > 0)
            @foreach($replies as $reply)
                <li  class="topic topic">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="user-info">
                                <img class="avatar pull-left" src="{{ asset('assets/images/avatars/' . $reply->avatar) }}">
                                <ul>
                                    <li><strong>{{ $reply->username }}</strong></li>
                                    <li>50posts</li>
                                </ul>
                            </div>
                        </div>


                        <div class="col-md-10">
                            <div class="topic-content pull-right">
                                <p>{{ $reply->body }}</p>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>

    <div class="clearfix"></div>
    <h3>Reply to topic</h3>
    @if (userLoggedIn())
    <form role="form" method="post" action="/topic/{{ $topic->id }}">
        <div class="form-group">
            <textarea name="body" id="body" cols="80" rows="10" class="form-control"></textarea>
        </div>
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    @else
    <p><em>Please Login to reply.</em></p>
    @endif

@stop

@section('statistics')
@stop

@section('script')
    <script src="{!! asset('assets/js/ckeditor/ckeditor.js') !!}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('body');
        });
    </script>
@stop