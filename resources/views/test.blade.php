<x-guest-layout>
    {{-- <h2>Videos</h2>
    <ul>
        @foreach($videos as $video)
            <li>{{ $video->url }}</li>
            <li>-- {{ $video->tags->first()->title }}</li>
        @endforeach
    </ul> --}}
    {{-- {{ $videos->links() }} --}}

    {{-- <h2>Articles</h2>
    <ul>
        @foreach($articles as $article)
            <li>{{ $article->title }}</li>
            <li>-- {{ $article->tags->first()->title }}</li>
        @endforeach
    </ul> --}}
    {{-- {{ $articles->links() }} --}}

    <h2>Random Video</h2>
    <p>{{ $video->url }}</p>
</x-guest-layout>
