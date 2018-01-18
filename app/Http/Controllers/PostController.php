<?php
namespace App\Http\Controllers;
use App\Post;
use App\Mongo\Facade as Mongo;
use Illuminate\Http\Request;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Mongo::get()->blog->posts;
        $posts =  $collection->find()->toArray();
        return view('admin-posts', ['posts' =>$posts]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post =  new \stdClass();
        $post->_id = "new";
        $post->bannerPath = "/uploads/lone-runner-bridge.jpg";
        return view('admin-post', ['post' =>$post]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collection = Mongo::get()->blog->posts;
        $index = count($collection->find()->toArray());//dumb, we should perhaps use MongoID
        $index++;
         $post = $request->validate([
            'title' => 'required|max:255',
            'bannerPath' => 'max:255',
            'content' => 'required',
        ]);
        $post['_id'] = strval($index);
        $collection->insertOne($post);
        return redirect('posts')->with('success', 'A new post has been added');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Mongo::get()->blog->posts;
        $post =  $collection->findOne(['_id'=> $id]);
        $post->bannerPath = "/uploads/lone-runner-bridge.jpg";
        return view('admin-post', ['post' =>$post]);
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
         $collection = Mongo::get()->blog->posts;
         $post =  $collection->findOne(['_id'=> $id]);

         $newPost = $request->validate([
            'title' => 'required|max:255',
            'bannerPath' => 'max:255',
            'content' => 'required',
        ]);

        $post['title'] =  $newPost['title'];//TODO - has to be a better way, updateOne uses update operators
        $post['bannerPath'] =  $newPost['bannerPath'];
        $post['content'] =  $newPost['content'];

        $collection->replaceOne(['_id'=> $id],$post);
        return redirect('posts')->with('success','Posting has been updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Mongo::get()->blog->posts;
        $collection->deleteOne(['_id'=> $id]);
        return back()->with('success', 'Post has been deleted');
    }
}