<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use App\Models\Skill;
use App\Models\SiteSetting;
use App\Services\YouTubePlaylistService;

class HomeController extends Controller
{
    public function index(YouTubePlaylistService $youtubePlaylistService)
    {
        $projects = PortfolioProject::query()
            ->with('category')
            ->where('is_active', true)
            ->where('media_type', 'image')
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('sort_order')
            ->orderByDesc('project_date')
            ->get();

        $skills = Skill::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $siteSetting = SiteSetting::query()->first();
    $videos = $youtubePlaylistService->getVideos();


        return view('home', compact(
            'projects',
            'skills',
            'siteSetting',
             'videos'
        ));
    }
}