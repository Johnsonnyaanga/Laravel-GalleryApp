<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photos;
use App\Album;

class PhotosController extends Controller
{
    public function create($album_id){
        return view('photos.create')->with('album_id',$album_id);
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);

          // Get filename with extension
          $filenameWithExt = $request->file('photo')->getClientOriginalName();

          // Get just the filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

          // Get extension
          $extension = $request->file('photo')->getClientOriginalExtension();

          // Create new filename
          $filenameToStore = $filename.'_'.time().'.'.$extension;

          // Uplaod image
          $path= $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'),$filenameToStore);

          // upload photo
          $photo = new Photos;
          $photo->album_id=$request->input('album_id');
          $photo->title=$request->input('title');
          $photo->description = $request->input('description');
          $photo->size = $request->file('photo')->getClientSize();
          $photo->photo = $filenameToStore;

          $photo->save();

          return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo uploaded');

    }
    public function show($id){
        $album = Album::with('Photos')->find($id);

        return view ('photos.show', ['albums' => $album]);

    }
}
