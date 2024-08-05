<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getLatestPostsToday()
    {
        $today = Carbon::today();

        $latestPosts = Post::whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return $latestPosts;
    }
    public function getLatestPostsTodayWhereCate()
    {
        $today = Carbon::today();

        $latestPostsCate = Catelogue::with([
            'posts' => function ($query) use ($today) {
                $query->whereDate('created_at', $today)
                    ->orderBy('created_at', 'desc');
            }
        ])->get();
        return $latestPostsCate;
    }
    public function index()
    {
        $featuredPosts = Post::where('is_show_home', 1)
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();


        $latestComments = $this->getLatestComments();

        $topFeaturedPosts = $featuredPosts->take(4);
        $bottomFeaturedPosts = $featuredPosts->slice(4)->take(3);
        $totalUsers = $this->getTotalUsersCount();
        $postsWithViews = $this->getPostsWithViewsCount();
        $totalViews = $this->getTotalViews();
        $totalPosts = $this->getTotalPostsCount();
        $topView = $this->getTopView();
        $topOne = Post::orderBy('view', 'desc')->first();
        $catelogue = Catelogue::orderBy('created_at', 'asc')->get();
        $latestPosts = $this->getLatestPostsToday();
        $latestPostsCate = $this->getLatestPostsTodayWhereCate();
        return view('client.index', compact('catelogue', 'latestPosts', 'latestPostsCate', 'topView', 'topOne', 'totalPosts', 'totalViews', 'postsWithViews', 'totalUsers', 'topFeaturedPosts', 'bottomFeaturedPosts', 'latestComments'));
    }

    function lienhe()
    {
        return view('client.lienhe');
    }
    public function listdanhsach()
    {
        $topViewedPosts = $this->getTopViewPosts();
        $catelogueWithCount = $this->getPostCountByCatelogue();

        $posts = Post::orderBy('created_at', 'desc')->paginate(9); // Adjust the number as needed
        return view('client.listdanhsach', compact('posts', 'catelogueWithCount', 'topViewedPosts'));
    }

    public function getTopViewPosts()
    {
        return Post::withoutTrashed()
            ->orderBy('view', 'desc')
            ->take(5)
            ->get();
    }
    public function getTopView()
    {
        return Post::withoutTrashed() // Loại trừ các bản ghi đã bị xóa mềm
            ->orderBy('view', 'desc') // Sắp xếp theo lượt xem giảm dần
            ->take(10) // Lấy 10 bản ghi đầu tiên
            ->get();
    }
    public function getPostCountByCatelogue()
    {
        return Catelogue::withCount('posts')->orderBy('posts_count', 'desc')->get();
    }
    public function getTotalPostsCount()
    {
        return Post::count();
    }
    public function getTotalViews()
    {
        return Post::sum('view');
    }
    public function getPostsWithViewsCount()
    {
        return Post::where('view', '>', 0)->count();
    }
    public function getTotalUsersCount()
    {
        return User::count();
    }
    public function listPostCate($id)
    {
        $currentCatelogue = Catelogue::findOrFail($id);
        $posts = Post::where('catelogue_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        $topViewedPosts = $this->getTopViewPosts();
        $catelogueWithCount = $this->getPostCountByCatelogue();

        return view('client.listPostCate', compact('posts', 'currentCatelogue', 'topViewedPosts', 'catelogueWithCount'));
    }
    public function __construct()
    {
        $catelogues = Catelogue::all();
        view()->share('catelogue', $catelogues);
    }
    function chitiet($slug)
    {
        $post = Post::with(['comments.user', 'catelogue'])->where('slug', $slug)->firstOrFail();

        $post->increment('view');

        $topViewedPosts = $this->getTopViewPosts();

        $catelogueWithCount = $this->getPostCountByCatelogue();

        $relatedPosts = Post::where('catelogue_id', $post->catelogue_id)
            ->where('id', '!=', $post->id)
            ->get();
        return view('client.chitiet', compact('post', 'relatedPosts', 'topViewedPosts', 'catelogueWithCount'));
    }

    public function storeComment(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'content' => 'required|max:1000',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id();
        $comment->save();

        // Hiển thị các bình luận chưa bị xóa mềm
        $comments = Comment::whereNull('deleted_at')->where('post_id', $request->post_id)->get();

        return redirect()->back()->with('success', 'Bình luận đã được thêm thành công.')->with('comments', $comments);
        ;
    }
    public function getLatestComments()
    {
        // Lấy 5 bình luận mới nhất, trừ những bình luận đã bị xóa mềm
        $latestComments = Comment::whereNull('deleted_at')
            ->latest()
            ->take(5)
            ->get();

        return $latestComments;
    }
    public function search(Request $request)
    {
        $catelogueWithCount = $this->getPostCountByCatelogue();
        $topViewedPosts = $this->getTopViewPosts();
        $keyword = $request->input('keyword');

        // Tìm kiếm bài viết thay vì danh mục
        $posts = Post::where('title', 'LIKE', "%{$keyword}%")->paginate(10);

        return view('client.listSearch', compact('posts', 'catelogueWithCount', 'topViewedPosts'));
    }
}
