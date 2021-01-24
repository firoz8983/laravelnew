<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class PostController extends Controller

{
   public function writepost(){
   	$category=DB::table('categories')->get();

  	return view('post.writepost',compact('category'));
  } 
  public function StorePost(Request $request){
  	   $validatedData = $request->validate([
        'title' => 'required|max:125',
        'details' => 'required|max:400',
        'image' => 'required | mimes:jpeg,jpg,png,PNG | max:2000',
       ]);

  	   $data=array();
  	   $data['title']=$request->title;
  	   $data['category_id']=$request->category_id;
  	   $data['details']=$request->details;
  	   $image=$request->file('image');

  	   if ($image) {
  	   	$image_name=hexdec(uniqid());
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext;
        $upload_path='public/frontend/image/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);
        $data['image']=$image_url;
        DB::table('posts')->insert($data);

  	   }else{
         DB::table('posts')->insert($data);
  	   }
  }
   public function Allpost(){
   //	$post=DB::table('posts')->get();
    $post=DB::table('posts')
           ->join('categories','posts.category_id','categories.id')
           ->select('posts.*','categories.name')
           ->get();
   	return view('post.allpost',compact('post'));
   }
   public function ViewPost($id){
          $post=DB::table('posts')
           ->join('categories','posts.category_id','categories.id')
           ->select('posts.*','categories.name')
           ->where('posts.id',$id)
           ->first();
           return view('post.viewpost',compact('post'));
   }
   public function EditPost($id){
    $category=DB::table('categories')->get();
    $post=DB::table('posts')->where('id',$id)->first();
    return view('post.editpost',compact('category','post'));
   }
   public function updatePost(Request $request,$id){
    $validatedData = $request->validate([
        'title' => 'required|max:125',
        'details' => 'required|max:400',
        'image' => 'required | mimes:jpeg,jpg,png,PNG | max:2000',
       ]);

       $data=array();
       $data['title']=$request->title;
       $data['category_id']=$request->category_id;
       $data['details']=$request->details;
       $image=$request->file('image');

       if ($image) {
        $image_name=hexdec(uniqid());
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext;
        $upload_path='public/frontend/image/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);
        $data['image']=$image_url;
        unlink($request->old_photo);
        DB::table('posts')->where('id',$id)->update($data);

       }else{
         DB::table('posts')->insert($data);
       }
   }
   public function deletePost($id){
    $post=DB::table('posts')->where('id',$id)->first();
    $image=$post->image;
    return response()->json($image);
    // $delete=DB::table('posts')->where('id',$id)->delete();

   }

}
