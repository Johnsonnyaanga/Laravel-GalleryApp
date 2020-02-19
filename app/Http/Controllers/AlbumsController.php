<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class AlbumsController extends Controller





{
    public function index(){
        $album = Album::with('Photos')->get();
        return view('albums.index',['albums'=>$album]);
    }
    public function create(){
        return view('albums.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);

          // Get filename with extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

          // Get just the filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

          // Get extension
          $extension = $request->file('cover_image')->getClientOriginalExtension();

          // Create new filename
          $filenameToStore = $filename.'_'.time().'.'.$extension;

          // Uplaod image
          $path= $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);

          // Create album
          $album = new Album;
          $album->name = $request->input('name');
          $album->description = $request->input('description');
          $album->cover_image = $filenameToStore;

          $album->save();

          return redirect('/albums')->with('success', 'Album Created');

   }


   public function show($id){
    $album = Album::with('Photos')->find($id);
    //return $album->name;
    return view ('albums.show', ['albums' => $album]);
}


}
