<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\Mime\Email;
use Mail;
use Validator;

use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;


class Homepage extends Controller
{
    public function  __construct(){
        if (Config::find(1)->active==0){//Siteyi ayarlar bölümünden kapalı hale getirirsek uygulayacağımız komut
            return redirect()->to('site-bakimda'/*web.php deki urlsini yazıyoruz*/)->send();
        }
        view()->share('pages',Page::/*where('status',1)->   aktif-pasif durumu*/orderBy('order','ASC')->get());//her public in  içinde kullanmak yerine __construct yapısı tanımlayarak sadece bir yerdde yazabiliriz.
        view()->share('categories',Category::/*where('status',1)-> aktif-pasis işlemi*/inRandomOrder()->get());
    }

    public function index(){

        $data['articles']=Article::/*with('getCategory)->where('status',1) aktif-pasis işlemi->whereHas('getCategory',function($query){
        $query->where('status',1);
        })*/orderBy('created_at','DESC')->paginate(10);//sayfalandırma için paginate(2) kullanıldı ve homepage.blade de " {{$articles->links("pagination::bootstrap-4")}}"  kullanıldı.
        $data['articles']->withPath(url('sayfa'));


        return view('front.homepage',$data);
    }

    public function single($category,$slug){
        $category=Category::whereSlug($category)->first() ?? abort(403,'Böyle bir yazu bulunamadı.');
        $article=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böyle bir yazu bulunamadı.');//bu kodla slug değerini yani url eğlence ise url yi başka bir şeyle değiştirmek istersen abort yazısını verir.
        $article->increment('hit');//blog'a tıklandığında tıklanmasayısını +1 arttırırız.
        $data['article']=$article;

        return view('front.single',$data);
    }

    public function category($slug){//burada kategori tablasundaki herhangi bir tabloya tıklandığında o categoriye ait yazıları gösterir.
        $category=Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir yazu bulunamadı.');
        $data['category']=$category;
        $data['articles']=Article::where('category_id',$category->id)/*->where('status',1)*/->orderBy('created_at','DESC')->paginate(1);

        return view('front.category',$data);
    }

    public function page($slug){
        $page=Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı.');
        $data['page']=$page;

        return view('front.page',$data);
    }

    public function contact(){
         return view('front.contact');
    }

    public function contactpost(Request $request){

        $rules=[
            'name'=>'required|min:5',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validate=Validator::make($request->post(),$rules);


        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::send([/*view adı*/],[/*nereye gideceği*/],function ($message) use($request) { //raw ın kulllanım amacı view göndermeyim text mesajları gödermeye yarar.
            $body=new \Symfony\Component\Mime\Part\TextPart($request);
            $message->from('iletisim@blogsitesi.com','Blog Sitesi');
            $message->to('melih@gmail.com');
            $message->subject($request->name. ' iletişimden mesaj gönderdi!');
            $message->setBody('Mesajı Gönderen :'.$request->name.'<br/ >
                  Mesajı Gönderen Mail:'.$request->email.'<br/ >
                  Mesaj Konusu :'.$request->topic.'<br/ >
                  Mesaj :'.$request->message.'<br/ ><br/ >
                  Mesaj Gönderilme Tarihi : '.now().'','text/html');

        });

       /* $contact=new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->topic=$request->topic;
        $contact->message=$request->message;
        $contact->save();*/
        return redirect()->route('contact')->with('success','Mesajınız bize iletildi.Teşekkür ederiz.');
    }
}
