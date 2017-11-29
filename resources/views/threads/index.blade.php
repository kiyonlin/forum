@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('threads._list')

                {{ $threads->render() }}
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Search
                    </div>

                    <div class="panel-body">
                        <form method="GET" action="/threads/search">
                            <div class="form-group">
                                <input type="text" class="form-control" name="q" placeholder="Search for something...">
                            </div>

                            <button class="btn btn-default" type="submit">Search</button>

                        </form>
                    </div>
                </div>
            </div>

            @if(count($trending))
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Trending Threads
                        </div>

                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach($trending as $thread)
                                    <li class="list-group-item">
                                        <a href="{{ $thread->path }}">{{ $thread->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
