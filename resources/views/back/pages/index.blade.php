@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
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
                        <h6 class="m-0 font-weight-bold float-end text-primary"><strong>{{$pages->count()}}</strong> blog bulundu.</h6>
                        <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm"><i class="far fa-trash-alt me-1"></i>Silinen Bloglar </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div id="orderSuccess" style="display:none;" class="alert alert-success">
                            Sistem başarıyla güncellendi.
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sayfa Başlığı</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Durum</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Oluşturulma Tarihi</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody id="orders">
                                @foreach($pages as $page)
                                <tr id="page_{{$page->id}}">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{$page->image}}" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"></h6>
                                                <p class="text-xs text-secondary mb-0">{{$page->title}}</p>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="align-middle text-center text-sm" article-id="{{$page->id}}">
                                        {!!$page->status==0 ? "<span class='badge badge-sm bg-gradient-success' type='checkbox' checked>Aktif</span>"
                                        :"<span class='badge badge-sm bg-gradient-secondary' type='checkbox' checked>Pasif</span>"!!}
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$page->created_at->diffForHumans()}}</span>
                                    </td>


                                    <td class="align-middle text-center text-sm">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">

                                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" title="Sil" href="{{route('admin.page.delete',$page->id)}}"><i class="far fa-trash-alt me-2"></i></a>
                                                <a class="btn btn-link text-dark px-3 mb-0" title="Düzenle" href="{{route('admin.page.edit',$page->id)}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i></a>
                                            <a class="btn btn-link text-bg-primary px-3 mb-0" title="Görüntüle"  target="_blank" href="{{route('page',$page->slug)}}" ><i class="far fa-solid fa-eye"></i></a>
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



        <!--Sayfalar menüsündeki tüm sayfalardaki sayfaların yerinin değiştirmek için kullanılabilir
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    $('#orders').sortable({
           handle:'.handle',
           update:function(){
               var siralama=$('#orders').sortable('serialize');
               $.get("{{route('admin.page.orders')}}"+siralama,function(data,status){
                     $("#orderSuccess").show().delay(1000).fadeOut();


               });
           }
    });
</script>
-->
        <script>
            $(function (){
                $('.switch').change(function () {
                    id=$(this)[0].getAttribute('page-id');
                    statu=$(this).prop('checked');
                    $.get("{{route('admin.page.switch')}}",{id:id,statu:statu}, function (data,status){});
                })
            })
        </script>
