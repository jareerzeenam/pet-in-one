<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// !
use App\Blog;
use App\User;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return Blog::latest()->where('user_id', '=', auth()->user()->id)->paginate(9);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::all();

        // ! Validation
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'category' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable',
        ]);

        // ! If a user uploades an image convert
        if ($request->photo) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/blog/') . $name);
            $request->merge(['photo' => $name]);
        } else {
            //! else insert below noimage.png to the database
            $request->merge(['photo' => 'noimage.png']);
        }

        return  Blog::create([
            'title' => $request['title'],
            'category' => $request['category'],
            'description' => $request['description'],
            'photo' => $request['photo'],

            'user_id' => auth()->user()->id,
            // ! Pass the authentidated user "id" to the database
        ]);
        return ['message', 'Data received'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Blog::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'category' => 'required|string',
            'description' => 'required|string'

        ]);

        $currentPhoto = $post->photo;
        // return ['message','Success'];
        // !below function will make a unique filename and add an extension to it and pass it to the database
        if ($request->photo != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/blog/') . $name);
            $request->merge(['photo' => $name]);

            if ($post->photo != 'noimage.png') {
                // ! Delete the old profile photo if the user upoades a new one
                $userPhoto  = public_path('images/blog/') . $currentPhoto;
                if (file_exists($userPhoto)) {
                    @unlink($userPhoto);
                }
            }


        }

        $post->update($request->all());
        return ['message' => 'Update the Post'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // ! if the delete request image name is noimag.png do not delete the image
        if ($blog->photo != 'noimage.png') {

            $image_path = public_path() . '/images/blog/' . $blog->photo;
            unlink($image_path);
        }

        $blog->delete();
        return ['message', 'Post Deleted'];
    }
}
