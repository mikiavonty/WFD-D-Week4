@inject('Carbon', 'Illuminate\Support\Carbon')
@extends('base')

@section('content')
    <a href="{{ route('articles.create') }}">
        <button class="inline-flex items-center gap-2 justify-center rounded-md py-2 px-3 text-sm outline-offset-2 transition active:transition-none bg-zinc-800 font-semibold text-zinc-100 hover:bg-zinc-700 active:bg-zinc-800 active:text-zinc-100/70 flex-none" type="button">+ New</button>
    </a>

    @if(Session::get('status') !== null)
    <div class="mt-4 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
            <p class="font-bold">{{ Session::get('status') }}</p>
            </div>
        </div>
    </div>
    @endif

    @foreach ($listArticles as $article)
        <article class="my-5">
            <div class="flex mb-1">
                <a href="{{ route('articles.edit', ['article' => $article->id]) }}">
                    <button class="inline-flex items-center gap-2 justify-center rounded-md py-2 px-3 text-sm outline-offset-2 transition active:transition-none bg-zinc-800 font-semibold text-zinc-100 hover:bg-zinc-700 active:bg-zinc-800 active:text-zinc-100/70 flex-none" type="button">Edit</button>
                </a>
                <form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method="POST" class="ml-1">
                    @csrf
                    @method("DELETE")
                    <button class="inline-flex items-center gap-2 justify-center rounded-md py-2 px-3 text-sm outline-offset-2 transition active:transition-none bg-zinc-800 font-semibold text-zinc-100 hover:bg-zinc-700 active:bg-zinc-800 active:text-zinc-100/70 flex-none" type="submit">Delete</button>
                </form>
            </div>
            <a href="{{ route('articles.show', ['article' => $article->id]) }}">
                <h1 class="mb-1 text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl">{{ $article->title }}</h1>
            </a>
            <small class="text-base text-zinc-500">{{ $Carbon::parse($article->updated_at)->isoFormat('Do MMMM Y, h:mm:ss A') }}</small>
            @if($article->image_url !== null)
                <img src="{{ Storage::url($article->image_url) }}" />
            @endif
            <p class="mt-6 text-base text-zinc-600">{{ Str::limit($article->content, 80) }}</p>
        </article>
    @endforeach
@endsection