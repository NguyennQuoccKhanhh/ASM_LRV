<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const PATH_VIEW = 'admin.compoents.posts.';
    const PATH_UPLOAD = 'posts';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $posts = $request->except('image_post', 'image_media');
        $posts['user_id'] = auth()->id();
        $posts['is_show_home'] = isset($posts['is_show_home']) ? 1 : 0;
        $posts['slug'] = \Str::slug($posts['title']) . '-' . $posts['sku'];


        if ($request->hasFile('image_post')) {
            $posts['image_post'] = Storage::put(self::PATH_UPLOAD, $request->file('image_post'));
        }


        try {
            DB::beginTransaction();

            $posts = Post::query()->create($posts);

            if ($request->hasFile('image_media')) {
                foreach ($request->file('image_media') as $file) {
                    Media::query()->create([
                        'post_id' => $posts->id,
                        'image_media' => Storage::put('medias', $file)
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('admin.compoents.posts.index')->with('success', 'Thêm bài viết thành công');
            ;
        } catch (\Exception $exception) {
            DB::rollBack();

            if (
                !empty($posts['image_post'])
                && Storage::exists($posts['image_post'])
            ) {

                Storage::delete($posts['image_post']);
            }

            if ($request->hasFile('image_media')) {
                foreach ($request->file('image_media') as $file) {
                    $path = 'medias/' . $file->hashName();
                    if (Storage::exists($path)) {
                        Storage::delete($path);
                    }
                }
            }
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post->load('media');
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('post','catelogues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->except('image_post', 'image_media','sku');
        $data['is_show_home'] = isset($data['is_show_home']) ? 1 : 0;

        if ($request->hasFile('image_post')) {
            // Xóa ảnh cũ nếu có
            if ($post->image_post && Storage::exists($post->image_post)) {
                Storage::delete($post->image_post);
            }
            $data['image_post'] = Storage::put(self::PATH_UPLOAD, $request->file('image_post'));
        }

        try {
            DB::beginTransaction();

            $post->update($data);

            if ($request->hasFile('image_media')) {
                foreach ($request->file('image_media') as $file) {
                    Media::create([
                        'post_id' => $post->id,
                        'image_media' => Storage::put('medias', $file)
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.compoents.posts.index');
        } catch (\Exception $exception) {
            DB::rollBack();

            if (isset($data['image_post']) && Storage::exists($data['image_post'])) {
                Storage::delete($data['image_post']);
            }

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.compoents.posts.index');
    }

    public function trash_can()
    {
        $trashedPosts = Post::onlyTrashed()->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('trashedPosts'));
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('admin.compoents.posts.index');
    }
}
