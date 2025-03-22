<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

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
        $validated = $request->validate([
            'title' => 'required|unique:articles|max:255',
            'content' => 'required',
            'image' => 'required'
        ]);
        if ($validated) {
            $title = $request->title;
            $content = $request->content;
            $image = $request->file("image");
            $path = null;
            if ($image !== null) {
                $path = Storage::putFile('images', $image);
            }
            Article::create([
                "title" => $title,
                "content" => $content,
                "image_url" => $path
            ]);
            Session::flash('status', 'Article is added successfully!');
            return redirect()->route('articles.index');    
        } else {
            return back()->withInput();
        }
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
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        if ($validated) {
            $title = $request->title;
            $content = $request->content;
            Article::where('id', $id)->update([
                "title" => $title,
                "content" => $content
            ]);
            Session::flash('status', 'Article is edited successfully!');
            return redirect()->route('articles.index');
        } else {
            return back()->withInput();
        }
        
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
