@extends('app')

@section('browserTitle') {{ $singleTopic->category_name }} @stop

@section('mainTitle') Posts In {{ $singleTopic->category_name }} @stop

@section('content')
    @if(count($topics))
        <ul id="topics">
            @foreach($topics as $topic)
                <li class="topic">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="avatar pull-left" src="{{ asset('assets/images/avatars/' . $topic->avatar) }}" alt="avater">
                        </div>
                        <div class="col-md-10">
                            <div class="topic-content pull-right">
                                <h3><a href="/topic/{{ $topic->id }}">{{ $topic->title }}</a></h3>
                                <div class="topic-info">
                                    <a href="/topics/category/{{ $topic->category_name }}">{{ $topic->category_name }}</a> &gt;&gt;
                                    <a href="profile.html">{{ $topic->user_name }}</a> >>
                                    Posted on {{ formateDate($topic->create_date) }}
                                    <span class="badge pull-right">4</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@stop

@section('statistics')
@stop