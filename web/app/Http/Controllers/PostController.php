<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use App\Http\Controllers\Controller;
use \Exception;
use Storage;
use Illuminate\Http\Request;


class PostController extends Controller
{

    const PER_PAGE=3;

    public function index(Request $request)
    {
        $page = isset($request->page) ? (int)$request->page : 1;
        $page = max($page,1);

        $count = Post::where('user_id','=',Auth::id())->count();

        $offset = ($page-1)*self::PER_PAGE;

        $results = Post::where('user_id','=',Auth::id())
            ->orderBy('id','desc')
            ->offset($offset)
            ->limit(self::PER_PAGE)
            ->get();

        $posts = [];

        foreach($results as $one)
        {
            $post = [];
            $post['id'] = $one->id;
            $post['title'] = $one->title;
            $post['alt'] = $one->alt;
            $post['src'] = self::getSrc($one->id,Auth::id());
            $post['created_at']=$one->created_at;
            $posts[] = $post;
        }

        $result = [
            "total"=> $count,
            "per_page" => self::PER_PAGE,
            "current_page" => $page,
            "posts"=> $posts
        ];

        return response()->json($result,200);

    }


    public function store(Request $request)
    {
        if (!$request->hasFile('pict')) {
            return response()->json([
                 'status'  => 'error'
                ,'message' => 'No file uploaded'
            ],400);
        }

        try{

            $post =new Post;
            $post->title = $request->title;
            $post->alt = $request->alt;
            $post->user_id = Auth::id();
            $post->save();

            $id = $post->id;

            $dir = self::getFullDir($id,Auth::id());

            if(!file_exists($dir))
                mkdir($dir,0777,true);

            $dir = self::getBriefDir($id,Auth::id());

            $file = $request->file('pict');

            $file->storeAs($dir ,'pict.'.$file->extension() ,'local');

        }
        catch(Exception $e) {
            return response()->json([
                'status'  => 'error'
                ,'message' => $e->getMessage()
            ],400);
        }



        return response()->json([
            'status'  => 'ok'
            ,'id' => $id
        ],200);

    }

    public static function getFullDir($post_id,$user_id=0)
    {

        if($user_id == 0)
        {
            $post = Post::find($post_id);
            $user_id = $post->id;
        }

        $dir = __DIR__.'/../../public/pictures/posts/';

        $dir .= (string)floor($user_id/30000);

        $dir .= '/user'.$user_id.'/';

        $dir .= (string)floor($post_id/30000);

        $dir .= '/post'.$post_id;

        return $dir;

    }

    public static function getBriefDir($post_id,$user_id=0)
    {

        $dir = self::getFullDir($post_id,$user_id);

        $dir = preg_replace('/^.+\/public\//','',$dir);

        return $dir;

    }

    public static function getSrc($post_id,$user_id=0)
    {

        $dir = self::getBriefDir($post_id,$user_id);

        $files = (array)Storage::disk('local')->files($dir);

        $src = isset($files[0]) ? '/'.$files[0] : 'error';

        return $src;

    }

}
