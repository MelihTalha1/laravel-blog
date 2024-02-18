@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://scope.ie/wp-content/uploads/2019/05/social-contact-us.jpg')
@section('content')

<!-- Post Content-->





<div class="col-md-8">
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
       @if($errors->any())
           <div class="alert alert-danger">
               <ul>
                   @foreach($errors->all() as $error)
                       <li>{{$error}}</li>
                   @endforeach
               </ul>
           </div>
        @endif
    <p>Bizimle İletişime Geçebilirsiniz.</p>
    <div class="my-5">

        <form method="post"  action="{{route('contact.post')}}">
            @csrf
            <div class="form-floating">
                <input class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="Ad soyadınız..." data-sb-validations="required" />
                <label for="name">Ad Soyad</label>
                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
            </div>
            <div class="form-floating">
                <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Email adresiniz..." required />
                <label for="email">Email Adresi</label>
                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
            </div>
            <div class="form-floating">
                <input class="form-control" id="phone" type="tel" placeholder="Seçmek istediğiniz konu..." required />
                <label for="phone">Konu</label>
                <select class="form-control" name="topic">
                    <option @if(old('topic')=="Bilgi") selected @endif>Bilgi</option>
                    <option @if(old('topic')=="Destek") selected @endif>Destek</option>
                    <option @if(old('topic')=="Genel") selected @endif>Genel</option>
                </select>
                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="message" placeholder="Mesaj giriniz..." style="height: 12rem" >{{old('message')}}</textarea>
                <label for="message">Mesajınız</label>
                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
            </div>
            <br />
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center mb-3">
                    <div class="fw-bolder">Form submission successful!</div>
                    To activate this form, sign up at
                    <br />
                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                </div>
            </div>
            <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form-->
            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
            <!-- Submit Button-->
            <button class="btn btn-primary " id="sendMessageButton" type="submit">Gönder</button>
        </form>
    </div>
</div>


    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Panel Content</h5>
                <p class="card-text">Adres:fdbsgfjdghkmdghmt</p>
            </div>
        </div>
    </div>



@endsection




