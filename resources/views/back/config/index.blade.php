@extends('back.layouts.master')
@section('title','Ayarlar')
@section('content')


    <!-- End Navbar
Aktif pasiflik durumu
<td class="align-middle text-center text-sm">
                                        $article->status==0 ?<span class='badge badge-sm bg-gradient-success' type='checkbox' checked>Aktif</span>"
                                        :"<span class='badge badge-sm bg-gradient-secondary' type='checkbox' checked>Pasif</span>



-->
    <div class="container-fluid py-4">
        <div class="card mb-4">
        <form method="post" action="{{route('admin.config.update')}}" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <h6>@yield('title')</h6>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label>Site başlığı</label>
                     <input type="text" name="title" required class="form-control" value="{{$config->title}}"/>
                   </div>
                 </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Aktiflik Durumu</label>
                            <select class="form-control" name="active">
                                <option @if($config->active==1) selected @endif value="1">Açık</option>
                                <option @if($config->active==0) selected @endif value="0">Kapalı</option>
                            </select>
                        </div>
                    </div>
                </div>




            <div class="row">


                    <h6>@yield('title')</h6>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Logo</label>
                            <input type="file" name="logo" class="form-control"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Favicon</label>
                            <input type="file" name="favicon" class="form-control"/>
                        </div>
                    </div>


            </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{$config->facebook}}"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>X</label>
                            <input type="text" name="x" class="form-control" value="{{$config->X}}"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Github</label>
                            <input type="text" name="github" class="form-control" value="{{$config->github}}"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                             <label>LinkIn</label>
                             <input type="text" name="linkedin" class="form-control" value="{{$config->linkedin}}"/>
                        </div>
                    </div>
                </div>



                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Youtube</label>
                        <input type="text" name="youtube" class="form-control" value="{{$config->youtube}}"/>
                    </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="{{$config->instagram}}"/>
                      </div>
                  </div>
                </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-md btn-success">Güncelle</button>
                    </div>

        </form>
    </div>

        @endsection



