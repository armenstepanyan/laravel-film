<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Film;
use App\FilmTag;
use Validator;

class MainController extends Controller
{
    
    public function index(){
        $tags = Tag::all();
        $films = Film::with('tags')->get();
        return ['tags' => $tags, 'films' => $films];
    }

    public function getTags(){
        return ['tags' => Tag::all()];
    }
    
    public function saveTag(Request $request){
 
       $validator = Validator::make($request->all() ,[
        'title' => 'required|unique:tag'        
    ] );

    if ($validator->fails()) {
        $messages = $validator->messages();
        return ['success'=>false,'errors'=>$messages];
    }
    $tag = new Tag;
    $tag->title = $request->input('title');
    $tag->save();
    return ['success' => true, 'id' => $tag->id];

  }

  public function deleteTag(Request $request){
     $tagId = $request->input('id');
     $model = Tag::find($tagId);
     FilmTag::where('tag_id', $tagId)->delete();
     $model->delete();
     return ['success'=>true];
  }




}
