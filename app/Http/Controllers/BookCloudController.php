<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookCloudRequest;
use App\Http\Requests\UpdateBookCloudRequest;

// use Illuminate\Http\Request;

use App\Models\BookCloud;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class BookCloudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(BookCloud::paginate(10));
    }
    public function homeBooks()
    {
        
    return view('home')->with('books', BookCloud::all());
    }

    public function postBook(StoreBookCloudRequest $request){
        $bookCloud = BookCloud::create($request->validated());
         new BookResource($bookCloud);
         return view('home');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
          //
    }

    public function imageUpload()
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookCloudRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookCloudRequest $request)
    {


        $bookCloud = BookCloud::create($request->validated());

        return new BookResource($bookCloud);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookCloud  $bookCloud
     * @return \Illuminate\Http\Response
     */
    public function show(BookCloud $bookCloud)
    {
        return new BookResource($bookCloud);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookCloud  $bookCloud
     * @return \Illuminate\Http\Response
     */
    public function edit(BookCloud $bookCloud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookCloudRequest  $request
     * @param  \App\Models\BookCloud  $bookCloud
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookCloudRequest $request, BookCloud $bookCloud)
    {
        $bookCloud->update([
            'title' => ($request->title) ? $request->title : $bookCloud->title,
            'content' => ($request->content) ? $request->content : $bookCloud->content,
            'author' => ($request->author) ? $request->author:$bookCloud->author,
            'rate' => ($request->rate) ? $request->rate : $bookCloud->rate,
            'totalpages' => ($request ->totalpages) ? $request->totalpages : $bookCloud->totalpages,
            'img' => ($request ->img) ? $request->img : $bookCloud->img,
            'audio'=> ($request->audio) ? $request->audio : $bookCloud->audio,
            'tags' => ($request->tags) ? $request->tags : $bookCloud->tags,
            'file' => ($request->file) ? $request->file : $bookCloud->file,

        ]);

        return new BookResource($bookCloud);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookCloud  $bookCloud
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookCloud $bookCloud)
    {
        $bookCloud->delete();
        return response('deleted' , 200);

    }
}
