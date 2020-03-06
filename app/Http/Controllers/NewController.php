<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

/**
 * Class NewController
 * @package App\Http\Controllers
 * source
 * https://scotch.io/@fisayoafolayan/build-a-news-web-app-with-laravel
 */
class NewController extends Controller
{
    /**
     * @var NewsRepository
     */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {

        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the news.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $request=request();

        if ($request->all()){
            //Here is an example of the what will be received by POST 'al-jazeera-english : Al Jazeera English',
            //we need to split it up using a php function called exlpode(), explode() creates an array 'al-jazeera-english' is the source while 'Al Jazeera English' is the source name
            $source                   = $request->get('source');
            $split_input              = explode(':', $source);
            $source                   = trim($split_input[0]); //trim() removes white spaces
            $data['source_name']      = $split_input[1];
        }

        if (empty($source)) {
            //Let us make `CNN` our default news source
            $source                 = 'cnn';
            $data['source_name']    = 'CNN';
            $data['source_id']      = $source;
        }

        $data['news']         = $this->newsRepository->getNews($source); // Passed  source id to our api model, to fetch news by the selected source
        $data['news_sources'] = $this->newsRepository->getAllSources(); //retrieve all news sources

        return view('welcome', $data);
    }

}
