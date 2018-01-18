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
        $product = $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric'
        ]);
        Product::create($product);
        return back()->with('success', 'Product has been added');
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
        $product = Product::find($id);
        $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric'
        ]);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->save();
        return redirect('products')->with('success','Product has been updated');
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
        $post = $collection->findOne(['_id'=> $id]);
        $product->delete();
        return redirect('posts')->with('success','Post has been deleted');
    }
}