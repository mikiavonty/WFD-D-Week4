<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listArticles = Article::orderBy('id', 'desc')->get();
        return view('articles.index', [
            "listArticles" => $listArticles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mode = "ADD";
        return view('articles.form', [
            "mode" => $mode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        Article::create([
            "title" => $title,
            "content" => $content
        ]);
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        return view('articles.view', [
            "article" => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mode = "EDIT";
        $article = Article::where('id', $id)->firstOrFail();
        return view('articles.form', [
            "mode" => $mode,
            "article" => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $title = $request->title;
        $content = $request->content;
        Article::where('id', $id)->update([
            "title" => $title,
            "content" => $content
        ]);
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Article::where('id', $id)->delete();
        return redirect()->route('articles.index');
    }
}
