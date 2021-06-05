@extends("layouts.app")

@section("content")
    <div class="container">

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        {{ $articles->links() }}
        @foreach($articles as $art)
            <div class="card mb-2">
                <div class="card-body"> 
                    <h5 class="card-title"> {{$art->title }} </h5>
                    <div class="card-subtitle mb-2 text-muted small">
                        {{ $art->created_at->diffForHumans() }}
                    </div>
                    <p class="card-text"> {{ $art->body }} </p>
                    <div class="small mt-2">
                        Posted by <b>{{ $art->user->name }}</b>
                    </div>
                    <a class="card-link" href="{{ url("/articles/detail/$art->id") }}">
                        View Detail &raquo;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

                            