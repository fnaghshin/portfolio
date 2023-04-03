<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SkillContent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function FirstLoad()
    {
        $response = [];

        // Get Portfolio Posts
        $portfolioPosts = Post::where('type','=','portfolio')->with('_content_lang')->latest()->take(50)->get();

        $portfolioPostList = [];
        foreach ($portfolioPosts as $portfolioPost)
        {
            $postItem['id'] = $portfolioPost->id;
            $postItem['title'] = $portfolioPost->_content_lang->title;
            $postItem['image'] = env('APP_URL').$portfolioPost->_content_lang->image;
            $postItem['description'] = $portfolioPost->_content_lang->description;
            $postItem['content'] = $portfolioPost->_content_lang->content;
            $postItem['created_at'] = $portfolioPost->created_at;
            $postItem['updated_at'] = $portfolioPost->updated_at;
            $portfolioPostList[] = $postItem;
        }

        $response['portfolio'] = $portfolioPostList;

        // Get Blog Posts

        $blogPosts = Post::where('type','=','blog')->with('_content_lang')->latest()->take(50)->get();

        $blogPostsList = [];
        foreach ($blogPosts as $blogPost)
        {
            $date_create = Carbon::parse($blogPost->created_at);
            $date_update = Carbon::parse($blogPost->updated_at);
            $postItem['id'] = $blogPost->id;
            $postItem['title'] = $blogPost->_content_lang->title;
            $postItem['image'] = env('APP_URL').$blogPost->_content_lang->image;
            $postItem['description'] = $blogPost->_content_lang->description;
            $postItem['content'] = $blogPost->_content_lang->content;
            $postItem['created_at'] = $date_create->format('D d F Y');
            $postItem['updated_at'] = $date_update->format('D d F Y');
            $blogPostsList[] = $postItem;
        }

        $response['blog'] = $blogPostsList;

        $skillArray = [];

        $skillList = SkillContent::where('language','=',app()->getLocale())->orderBy('year','ASC')->get();

        foreach ($skillList as $skillItem)
        {
            $skillItem->icon = env('APP_URL').$skillItem->icon;
            $date = Carbon::parse($skillItem->year);
            $now = Carbon::now();
            $skillItem->year = ($date->diffInYears($now) + 1);
            $skillArray[] = $skillItem;
        }

        $response['skill'] = $skillArray;

        return $response;
    }
}
