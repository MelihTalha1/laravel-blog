@extends('back.layouts.master')
@section('title','Silinen Bloglar')
@section('content')


    <!-- End Navbar
Aktif pasiflik durumu
<td class="align-middle text-center text-sm">
                                        $article->status==0 ?<span class='badge badge-sm bg-gradient-success' type='checkbox' checked>Aktif</span>"
                                        :"<span class='badge badge-sm bg-gradient-secondary' type='checkbox' checked>Pasif</span>



-->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>@yield('title')</h6>
                        <h6 class="m-0 font-weight-bold float-end text-primary"><strong>{{$articles->count()}}</strong> blog bulundu.</h6>
                        <a href="{{route('admin.bloglar.index')}}" class="btn btn-warning btn-sm">Aktif Bloglar </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Blog Başlığı</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Oluşturulma Tarihi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Görüntülenme Sayısı</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $article)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{$article->image}}" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"></h6>
                                                <p class="text-xs text-secondary mb-0">{{$article->title}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$article->getCategory->name}}</p>
                                        <p class="text-xs text-secondary mb-0">Organization</p>
                                    </td>


                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$article->created_at->diffForHumans()}}</span>
                                    </td>
                                    <td class="align-middle text-center ">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            {{$article->hit}}
                                        </a>
                                    </td>

                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">

                                            <a class="btn btn-link text-dark px-3 mb-0" title="Silmekten kurtar" href="{{route('admin.recover.article',$article->id)}}"> <i class="fa-solid fa-recycle"></i></a>
                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" title="Sil" href="{{route('admin.hard.delete.article',$article->id)}}"><i class="far fa-trash-alt me-2"></i></a>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
