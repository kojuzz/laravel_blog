<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','detail']);
    }
    public function index(){
        $data = Article::latest()->paginate(5) ;
        return view('articles.index',['articles' => $data]); // 1 - 4 - 5 - 6
    }
    public function detail($id){
        $data = Article::find($id);
        return view('articles.detail',['article' => $data]);
    }
    public function add(){
        $data = [ 
            ["id" => 1, "name" => "News"],
            ["id" => 2, "name" => "Tech"]
        ];
        return view('articles.add',['categories' => $data]);
    }
    public function create(){
        $validator = validator(request()-> all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');
    }
    public function edit($id){
        $article = Article::find($id);
        if(Gate::denies('article-delete', $article)){
            return back()->with('info','Cannot Edit');
        }
        $data = Article::find($id);
        return view('articles.edit', ['article' => $data]);
    }
    public function update($id){
        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles');
    }
    public function delete($id){
        $article = Article::find($id);
        if(Gate::denies('article-delete', $article)){
            return back()->with('info','Cannot deleted');
        }
        $article->delete();
        return redirect('/articles')->with('info','Article deleted');
    }
}
