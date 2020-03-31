<?php
namespace App\Http\Controllers;

use App\Repositories\{NewsRepository, CommentsRepository, NewsCategoriesRepository};

class NewsController extends FrontController {
    
    /**
     * The NewsRepository instance.
     *
     * @var App\Repositories\NewsRepository 
     */
    protected $newsRepository;
    
    /**
     * The CommentsRepository instance.
     *
     * @var App\Repositories\NewsRepository 
     */
    protected $commentsRepository;
    
    /**
     * The NewsCategoriesRepository instance.
     *
     * @var App\Repositories\NewsRepository 
     */
    protected $categoriesRepository;
    
    /**
     * Create a new NewsController instance.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->newsRepository = app(NewsRepository::class);
        $this->commentsRepository = app(CommentsRepository::class);
        $this->categoriesRepository = app(NewsCategoriesRepository::class);
    }
    
    /**
     * Display a listing of the news.
     * 
     * @param string $categoryAlias category alias
     * @return Response
     */
    public function newsPage($categoryAlias = null)
    {
        $category = $this->categoriesRepository->getCategoryByAlias($categoryAlias);
        if ( !$category ) return redirect()->route('news');
        
        $news = $this->newsRepository->getNews($category->id);
        $metaData = $this->newsRepository->getMetaData($category->id);
        $categories = $this->categoriesRepository->getCategories();
        
        return view('news.index', compact(
            'category', 'news', 'metaData', 'categories'
        ));
    }
    
    /**
     * Display a listing of the news post.
     * 
     * @param integer $id news post id
     * @param string $alias news post alias
     * @return Response
     */
    public function postPage($id, $alias = null)
    {
        $post = $this->newsRepository->getPostById($id);
        $recommendPosts = $this->newsRepository->getRecommendPostById($id);
        $comments = $this->commentsRepository->getCommentsByNewsPostId($id);
        
        if ( !$post ) return redirect()->route('news');
        
        return view('news.post', compact(
            'post', 'comments', 'recommendPosts'
        ));
    }
    
    /**
     * Display a search results.
     * 
     * @param string $query search query
     * @return Response
     */
    public function searchPage($query = null)
    {
        $category = $this->categoriesRepository->getCategoryByAlias();
        $news = $this->newsRepository->searchPost($query);
        $metaData = $this->newsRepository->getMetaData($category->id);
        $metaData->meta_title = 'Поиск - '. $query ?? '';
        $categories = $this->categoriesRepository->getCategories();
        
        return view('news.search', compact(
            'news', 'metaData', 'categories'
        ));
    }

}