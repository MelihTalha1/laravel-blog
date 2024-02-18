@isset($categories)
<div class="col-md-3 float-end">
    <div class="list-group">
        <div class="card">
            <div class="card-header">
                Kategoriler
            </div>
        </div>
        <div class="list-group"  >
            @foreach($categories as $category)
            <li class="list-group-item list-group-item-action  @if(Request::segment(2)==$category->slug) active  @endif" aria-current="true">

                <a  @if(Request::segment(2)!=$category->slug)  href="{{route('category',$category->slug)}}" @endif  class="list-group-item list-group-item-action ">{{$category->name}}
                    <span class="badge bg-primary rounded-pill float-end">{{$category->articleCount()}}</span></a>
             </li>
            @endforeach
        </div>
    </div>
</div>
@endisset



