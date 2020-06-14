<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;


// ! Import Post model
use App\Post;
use App\User;

use Image;

class PostController extends Controller
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
        // *  bellow line to show users only posts belongs to their user id
        return Post::latest()->where('user_id', '=', auth()->user()->id)->paginate(9);
        // return Post::latest()->paginate(9);
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
            'price' => 'required|string|max:191',
            'location' => 'required|string|max:191',
            'category' => 'required|string',
            'description' => 'required|string|max:191',
            'photo' => 'nullable',
            'phone' => 'required|string|max:191',
            'meeting_date_start' => 'required|string|max:191',
            'meeting_date_end' => 'required|string|max:191',
            'meeting_time' => 'required|string|max:191',

        ]);



        // ! If a user uploades an image convert
        if ($request->photo) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/post/') . $name);
            $request->merge(['photo' => $name]);
        } else {
            //! else insert below noimage.png to the database
            $request->merge(['photo' => 'noimage.png']);
        }




        return  Post::create([
            'title' => $request['title'],
            'price' => $request['price'],
            'location' => $request['location'],
            'category' => $request['category'],
            'description' => $request['description'],
            'phone' => $request['phone'],
            'photo' => $request['photo'],
            'meeting_date_start' => $request['meeting_date_start'],
            'meeting_date_end' => $request['meeting_date_end'],
            'meeting_time' => $request['meeting_time'],
            // ! Pass the authentidated user "id" to the database
            'user_id' => auth()->user()->id,
        ]);
    }

    public function product($id)
    {
        // $user =  User::all();
        return Post::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::find($id);
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
        $post = Post::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'price' => 'required|string|max:191',
            'location' => 'required|string|max:191',
            'category' => 'required|string',
            'description' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'meeting_date_start' => 'required|string|max:191',
            'meeting_date_end' => 'required|string|max:191',
            'meeting_time' => 'required|string|max:191',
            'user_id' => 'required|string|max:191',

        ]);

        $currentPhoto = $post->photo;
        // return ['message','Success'];
        // !below function will make a unique filename and add an extension to it and pass it to the database
        if ($request->photo != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/post/') . $name);
            $request->merge(['photo' => $name]);

            if ($post->photo != 'noimage.png') {
                // ! Delete the old profile photo if the user upoades a new one
                $userPhoto  = public_path('images/post/') . $currentPhoto;
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
        // $this->authorize('isAdmin');

        $post = Post::findOrFail($id);

        // ! if the delete request image name is noimag.png do not delete the image
        if ($post->photo != 'noimage.png') {

            $image_path = public_path() . '/images/post/' . $post->photo;
            unlink($image_path);
        }

        $post->delete();
        return ['message', 'Post Deleted'];
    }
}
