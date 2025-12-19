<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navigation;

class PageController extends Controller
{

    public function show($slug)
    {
        // Load top-level navigations for menu/header
        $navigations = Navigation::where('parent_id', 0)
            ->where('is_active', 1)
            ->orderBy('position')
            ->get();

        // Load the requested page by slug
        $page = Navigation::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        // Load children if needed
        $children = $page->children()->where('is_active', 1)->orderBy('position')->get();

        // Determine which Blade to use based on page type
        switch ($page->pageType?->title ?? 'Normal') {
            case 'Normal':
                $view = 'pages.normal';
                break;
            case 'News':
            case 'Group News':
                $view = 'pages.news';
                break;
            case 'Photo Gallery':
                $view = 'pages.photo_gallery';
                break;
            case 'Video Gallery':
                $view = 'pages.video_gallery';
                break;
            case 'Message':
                $view = 'pages.message';
                break;
            case 'Team':
                $view = 'pages.team';
                break;
            case 'Group Project':
            case 'Projectdetails':
                $view = 'pages.project';
                break;
            case 'Group Jobcategory':
            case 'Group Jobs':
                $view = 'pages.jobs';
                break;
            case 'Notice Download':
                $view = 'pages.notice';
                break;
            case 'Group':
                $view = 'pages.group';
                break;
            default:
                $view = 'pages.normal';
                break;
        }

        return view($view, compact('navigations', 'page', 'children'));
    }
}
