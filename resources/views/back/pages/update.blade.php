@extends('back.layouts.master')
@section('title',$page->title.' sayfasını güncelle')
@section('content')


    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>@yield('title')</h6>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $errror)
                                    <li>{{$errror}}</li>
                                @endforeach
                            </div>
                        @endif
                        <form method="post" action="{{route('admin.page.edit.post',$page->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Blog Başlığı</label>
                                <input type="text" name="title" class="form-control" value="{{$page->title}}" required></input>
                            </div>

                            <div class="form-group">
                                <label>Blog Fotoğrafı</label><br/>
                                <img src="{{asset($page->image)}}"class="img img-thumbnail rounded" width="300"/>
                                <input type="file" name="image" class="form-control"></input>
                            </div>

                            <div class="form-group">
                                <label>Blog İçeriği</label>
                                <textarea id="editor" name="content" class="form-control" rows="4">{!! $page->content !!}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Blogu Güncelle</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


@endsection
@section('css')
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')

            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#editor').summernote();
                });

            </script>
@endsection
