@inject('Carbon', 'Illuminate\Support\Carbon')
@extends('base')

@section('content')
    <a href="{{ route('articles.create') }}">
        <button class="inline-flex items-center gap-2 justify-center rounded-md py-2 px-3 text-sm outline-offset-2 transition active:transition-none bg-zinc-800 font-semibold text-zinc-100 hover:bg-zinc-700 active:bg-zinc-800 active:text-zinc-100/70 flex-none" type="button">+ New</button>
    </a>

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
            <p class="mt-6 text-base text-zinc-600">{{ Str::limit($article->content, 80) }}</p>
        </article>
    @endforeach
@endsection