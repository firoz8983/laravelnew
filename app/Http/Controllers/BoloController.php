<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class BoloController extends Controller
{
  public function bolo(){
  	echo "eita bolo page";
  }
  
  public function add_category(){
  	return view('post.addcategory');
  }
  public function store_category(Request $request){
    $validatedData = $request->validate([
        'name' => 'required|unique:categories|max:25|min:4',
        'slug' => 'required|unique:categories|max:25|min:4',
      ]);

  	$data=array();
  	$data['name']=$request->name;
  	$data['slug']=$request->slug;
  	$category=DB::table('categories')->insert($data);
  	
  }
  public function Allcategory(){
    $category=DB::table('categories')->get();
    return view('pages.all_category',compact('category'));
    //return response()->json($category);
  }
  public function viewCategory($id){
   $category=DB::table('categories')->where('id',$id)->first();
     return view('post.categoryview')->with('jekono',$category); //etao thik ase jst a new 
   //return response()->json($category);
     //return view('pages.categoryview',compact('jekono'));
  }
  public function deleteCategory($id){
    $delete=DB::table('categories')->where('id',$id)->delete();
  }
  public function editCategory($id){
    $category=DB::table('categories')->where('id',$id)->first();
    return view('post.editcategory',compact('category'));
  }
  public function updateCategory(Request $request,$id){
    $validatedData = $request->validate([
        'name' => 'required|max:25|min:4',
        'slug' => 'required|max:25|min:4',
      ]);

    $data=array();
    $data['name']=$request->name;
    $data['slug']=$request->slug;
    $category=DB::table('categories')->where('id',$id)->update($data);
  }

}
