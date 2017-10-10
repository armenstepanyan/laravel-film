<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Film;
use App\FilmTag;
use Validator;

class FilmController extends Controller
{
    public function get($id){
        $film = Film::with('tags')->where('id',$id)->first();
        return $film;
      }

      public function create(Request $request){
        
        //@TODO: validate input
        $title = $request->input('title');
        $year = $request->input('year');
        $tags = $request->input('tags');
    
        $validator = Validator::make($request->all() ,[
            'title' => 'required',
            'year' => 'required'        
        ] );
        if ($validator->fails()) {
            $messages = $validator->messages();        
            return ['success'=>false,'errors'=>$messages];
        }
    
        $film = new Film;
        $film->title = $title;
        $film->year = $year;
        $film->save();
    
        if($film->id){
            $data = [];
            foreach($tags as $tag){
                $data[] = [
                    'film_id' => $film->id,
                    'tag_id' => $tag
                ];
            }
            
            //@TODO: check if inserted
            FilmTag::insert($data);
    
            return ['success' => true];
        }
        
    
      }

      public function update(Request $request, $id){

        $tags = $request->input('tags');
        $film = Film::find($id);
        $film->title = $request->input('title');
        $film->year = $request->input('year');
        $film->save();
        
        FilmTag::where('film_id',$id)->delete();
            
        $data = [];
            foreach($tags as $tag){
                $data[] = [
                    'film_id' => $id,
                    'tag_id' => $tag
                ];
            }
       
        FilmTag::insert($data);
        return ['success' => true];

      }

      public function delete(Request $request){          
          $id = $request->input('id');          
          $model = Film::find($id);
          $model->delete();
          FilmTag::where('film_id',$id)->delete();
          return ['success' => true];
      }
}
