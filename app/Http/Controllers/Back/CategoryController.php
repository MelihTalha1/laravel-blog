<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Article;
//use Psy\Util\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('back.categories.index',compact('categories'));
    }

    public function create(Request $request){
        $isExist=Category::whereSlug(Str::slug($request->category))->first();
        if($isExist){
            toastr()->error($request->category.' adında bir kategori zaten mevcut!');
            return redirect()->back();
        } //buradaki koddaki amaç kategorilerde bulunan aynı adı yazarsak bu kategorinin var olduğunu belirtebilmek.



        $category=new Category();
        $category->name=$request->category;
        $category->slug=Str::slug($request->category);
        $category->save();
        toastr()->success('Kategori Başarıyla Oluşturuldu');
        return redirect()->back();

    }

    public function update(Request $request){ //kategoriler menüsündeki tüm kategoriler bölümünde ki düznleme kısmı.
        $isSlug=Category::whereSlug(Str::slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName=Category::whereSlug(Str::slug($request->category))->whereNotIn('id',[$request->id])->first();
        if($isSlug or $isName){
            toastr()->error($request->category.' adında bir kategori zaten mevcut!');
            return redirect()->back();
        } //buradaki koddaki amaç kategorilerde bulunan aynı adı yazarsak bu kategorinin var olduğunu belirtebilmek.



        $category=Category::find($request->id);
        $category->name=$request->category;
        $category->slug=Str::slug($request->slug);
        $category->save();
        toastr()->success('Kategori Başarıyla Güncellendi Oluşturuldu');
        return redirect()->back();

    }



    public  function delete(Request $request){ //kategoriler bölümündeki tüm kategorilerin içindeki işlemler bölümündeki silme butonuna ait işlemler.
        $category=Category::findOrFail($request->id);
         if($category->id==1){
             toastr()->error('Bu kategori silinemez');
             return redirect()->back();
         }
         $message='';
         $count=$category->articleCount();
         if($count>0){
             Article::where('category_id',$category->id)->update(['category_id'=>1]);
             $defaultCategory=Category::find(1);
             $message='Bu kategoriye ait '.$count.' makale '.$defaultCategory->name. 'kategorisine taşındı';
         }
         $category->delete();
         toastr()->success($message,'Kategori Başarıyla Silindi');
         return redirect()->back();



    }


    public function getData(Request $request){//Kategoriler bölümündeki düzenleme işlemini yapmak için oluşturuldu
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }



    public function switch(Request $request){//Kategoriler bölümündeki aktif-pasif işlemini yapmak için oluşturuldu
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1:0;
        $category->save();
    }
}
