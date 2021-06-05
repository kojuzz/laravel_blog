@extends("layouts.app")

@section("content")
    <div class="container">
        <form method="post">
        @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $article->title }}">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control" >{{ $article->body }}</textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    <option value="1">News</option>
                    <option value="2">Tech</option>
                </select>
            </div>
            <input type="submit" value="Update Article" class="btn btn-primary">        
        </form>
    </div>
@endsection