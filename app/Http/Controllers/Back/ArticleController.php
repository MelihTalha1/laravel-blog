<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles=Article::orderBy('created_at','ASC')->get();
        return view('back.articles.index',compact('articles'));// compact('articles')  compact ile beraber yukarıdaki $articles dan alınıyor.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        $request->validate([
            'title'=>'min:3',
            //'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $article=new Article;
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->content;
        $article->slug=Str::slug($request->title);

        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);//public path ile uploads bölümüne yüklenir.
            $article->image='uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı','Blog başarıyla oluşturuldu');
        return redirect()->route('admin.bloglar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $id;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article=Article::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.update',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg.png.jpg|max:2048'
        ]);

        $article=Article::findOrFail($id);
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->content;
        $article->slug=Str::slug($request->title);

        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);//public path ile uploads bölümüne yüklenir.
            $article->image='uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı','Blog başarıyla güncellendi');
        return redirect()->route('admin.bloglar.index');
    }

   //Aktif-pasif durumunda çalışacak fonksiyon.
    public function  switch(Request $request){
        $article=Article::findOrFail($request->id);
        $article->status=$request->statu=="true" ? 1:0;
        $article->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id){
         $article=Article::find($id); //Article::find($id)->delete(); komutu çalışmadığı için if komutu eklendi.
         if($article) {
             $article->delete();

             toastr()->success('Blog,Silinen bloglara taşındı','Başarılı');
             return redirect()->route('admin.bloglar.index');
         }
    }

    public function trashed(){
        $articles=Article::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('back.articles.trashed',compact('articles'));
    }

    public function recover($id){
        Article::onlyTrashed()->find($id)->restore();
        toastr()->success('Blog başarıyla kurtarıldı','Başarılı');
        return redirect()->back();
    }


    public function hardDelete($id){

        $article=Article::onlyTrashed()->find($id); //Article::find($id)->delete(); komutu çalışmadığı için if komutu eklendi.

        if(File::exists($article->image)) {
            File::delete(public_path($article->image));
        }


        $article->forceDelete();//Direk olarak data siliniyor

        toastr()->success('Blog başarıyla silindi','Başarılı');
        return redirect()->route('admin.bloglar.index');

    }

    public function destroy(string $id)
    {

    }
}
