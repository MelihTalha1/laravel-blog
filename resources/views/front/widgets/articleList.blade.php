@if(count($articles)>0)
@foreach($articles as $article)
    <!-- Post preview-->
    <div class="post-preview">
        <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
            <h2 class="post-title">{{$article->title}}</h2>
            <img src="{{$article->image}}" />
            <h3 class="post-subtitle">{!!Str::limit($article->content,80)!!}</h3>
        </a>
        <p class="post-meta">
            Kategori:
            <a href="#!">{{$article->getCategory->name}}</a>
            <span class="float-end">{{$article->created_at->diffForHumans()}}</span>
        </p>
    </div>
    <!-- Divider-->
    @if(!$loop->last)
        <hr class="my-4" />
    @endif
@endforeach
<div class="d-flex justify-content-center">
    {{$articles->links("pagination::bootstrap-4")}}
</div>
@else
    <div class="alert alert-danger">
        <h1>Bu kategoriye ait yazı bulunamadı.</h1>
    </div>
@endif
