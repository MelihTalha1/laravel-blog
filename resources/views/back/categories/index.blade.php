@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')

    <div class="row">
    <div class="col-md-5 mt-4">
        <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Yeni Kategori Oluştur</h6>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                        <i class="far fa-calendar-alt me-2"></i>
                        <small>23 - 30 March 2020</small>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">

                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <form method="post" action="{{route('admin.category.create')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Kategori Adı</label>
                                    <input type="text" class="form-control" name="category" required />

                                </div>

                                <div class="d-flex flex-column">
                                  <button type="submit" class="btn btn-primary btn-sm float-end">Ekle</button>
                                </div>

                            </form>
                        </div>



                    </li>

                </ul>

            </div>
        </div>
    </div>






        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Tüm Kategoriler</h6>
                </div>

                <div class="card-body pt-4 p-3">
                    <li class="list-group">
                       <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                         <li class="d-flex flex-column">


                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori Adı</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Blog Sayısı</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Durum</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <div>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"></h6>
                                                        <p class="text-xs text-secondary mb-0">{{$category->name}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{$category->articleCount()}}</p>

                                            </td>
                                            <td class="align-middle text-center text-sm" category-id="{{$category->id}}">
                                                {!!$category->status==0 ? "<span class='badge badge-sm bg-gradient-success' type='checkbox' checked>Aktif</span>"
                                                :"<span class='badge badge-sm bg-gradient-secondary' type='checkbox' checked>Pasif</span>"!!}
                                            </td>



                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">

                                                    <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->articleCount()}}" class="btn btn-link text-danger text-gradient px-3 mb-0" title="Sil" ><i class="far fa-trash-alt me-2"></i></a>
                                                    <a category-id="{{$category->id}}"  class="btn btn-link text-dark px-3 mb-0" title="Düzenle" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i></a>

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </div>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </li>
                    </li>
                </div>
            </div>







            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                Launch demo modal 45
            </button>

            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="post" action="{{route('admin.category.update')}}" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Kategoyi Düzenle</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-group">
                                    <label>Kategori Adı</label>
                                    <input id="category" type="text" class="form-control"  name="category"/>
                                    <input type="hidden" name="id" id="category_id"/>
                                </div>
                                <div class="form-group">
                                    <label>Kategori Slug</label>
                                    <input id="slug" type="text" class="form-control" name="slug"/>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                <button type="submit" class="btn btn-primary">Kaydet</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>











            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                Launch demo modal 45
            </button>

            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="post" action="{{route('admin.category.update')}}" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Kategoyi Sil</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="body" class="modal-body">
                            <div class="alert alert-danger" id="articleAlert">

                            </div>
                        </divid>

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            <form method="post" action="{{route('admin.category.delete')}}">
                                @csrf
                                <input type="hidden" name="id" id="deleteId" />
                                <button id="deleteButton" type="submit" class="btn btn-primary">Sil</button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
















    </div>


@endsection
    </div>

<script>
    $(function () {
        $('.remove-click').click(function (){
            id= $(this)[0].getAttribute('category-id');
            count= $(this)[0].getAttribute('category-count');
            name= $(this)[0].getAttribute('category-count');
            if(id==1){
                $('#articleAlert').html(name + 'Genel kategorisi sabit kategoridir.Silinen diğer kategorilere ait bloglar buraya kategoriye eklenecek');
                $('#body').show();
                $('#deleteButton').hide();
                $('#deleteModal').modal();
                return;
            }
            $('#deleteButton').show();
            $('#deleteId').val(id);
            $('#articleAlert').html('');
            $('#body').hide();
            if(count>0){
                $('#articleAlert').html('Bu kategoriye ait '+count+' makale bulunmaktadır. Silmek istediğinize emin misiniz?');
                $('#body').show();
            }
            $('#deleteModal').modal();
        });

        $('.edit-click').click(function (){
           id= $(this)[0].getAttribute('category-id');
           $.ajax({
               type:'GET',
               url:'{{route('admin.category.getData')}}',
               data:{id:id},
               success:function (data){
                   console.log(data);
                   $('#category').val(data.name);
                   $('#slug').val(data.slug);
                   $('#category_id').val(data.id);
                   $('#editModal').modal();
               }
           });

        });


        $('.switch').change(function (){
            id=$(this)[0].getAttribute('category-id');
            statu=$(this).prop('checked');
            $.get("{{route('admin.category.switch')}}",{id:id,statu:statu},function (data, status) {});
        })
    })
</script>

