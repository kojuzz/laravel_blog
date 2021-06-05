@extends("layouts.app")

@section("content")
    <div class="container">

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-info">
                {{ session('error') }}
            </div>
        @endif


        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title}}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <p class="card-text">
                    {{ $article->body }}
                </p>
                <a class="btn btn-info btn-sm" href="{{ url("/articles/edit/$article->id") }}">Edit</a>
                <a class="btn btn-danger btn-sm" href="{{ url("/articles/delete/$article->id") }}">Delete</a>
                <div class="small mt-2">
                    Posted by <b>{{ $article->user->name }}</b>,
                    {{ $article->created_at->diffForHumans() }}
                </div>
            </div>
        </div>

        <ul class="list-group">
            <li class="list-group-item active">
                <b>
                    Comment ({{ count($article->comments) }})
                </b>
            </li>
            @foreach($article->comments as $comment)
                <li class="list-group-item">
                    {{ $comment->content }}
                    <a class="float-right btn btn-light btn-sm" href="{{ url("/comments/delete/$comment->id") }}">x</a>
                    <div class="small mt-2">
                        By <b>{{ $comment->user->name }}</b>,
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>
        @auth
        <form action="{{ url('/comments/add') }}" method="post" class="mt-2">
        @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-secondary">
        </form>
        @endauth
    </div>
@endsection