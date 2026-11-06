<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class YouTubePlaylistService
{
    public function getVideos(): array
    {
        return Cache::remember('youtube_playlist_videos', now()->addHours(6), function () {

            // 1. Fetch playlist videos
            $response = Http::get(
                'https://www.googleapis.com/youtube/v3/playlistItems',
                [
                    'part' => 'snippet',
                    'playlistId' => config('services.youtube.playlist_id'),
                    'maxResults' => 50,
                    'key' => config('services.youtube.api_key'),
                ]
            );

            $response->throw();

            $items = $response->json('items', []);

            $videoIds = collect($items)
                ->pluck('snippet.resourceId.videoId')
                ->filter()
                ->values();

            if ($videoIds->isEmpty()) {
                return [];
            }

            // 2. Fetch video details and statistics
            $detailsResponse = Http::get(
                'https://www.googleapis.com/youtube/v3/videos',
                [
                    'part' => 'snippet,statistics',
                    'id' => $videoIds->implode(','),
                    'key' => config('services.youtube.api_key'),
                ]
            );

            $detailsResponse->throw();

            $videoDetails = collect($detailsResponse->json('items', []))
                ->keyBy('id');

            // 3. Collect unique channel IDs
            $channelIds = $videoDetails
                ->pluck('snippet.channelId')
                ->filter()
                ->unique()
                ->values();

            // 4. Fetch actual channel profile pictures
            $channelThumbnails = collect();

            if ($channelIds->isNotEmpty()) {

                $channelResponse = Http::get(
                    'https://www.googleapis.com/youtube/v3/channels',
                    [
                        'part' => 'snippet',
                        'id' => $channelIds->implode(','),
                        'key' => config('services.youtube.api_key'),
                    ]
                );

                $channelResponse->throw();

                $channelThumbnails = collect($channelResponse->json('items', []))
                    ->mapWithKeys(function ($channel) {
                        return [
                            $channel['id'] => $channel['snippet']['thumbnails']['default']['url'] ?? null,
                        ];
                    });
            }

            // 5. Prepare final playlist data
            return collect($items)
                ->map(function ($item) use ($videoDetails, $channelThumbnails) {

                    $snippet = $item['snippet'] ?? [];

                    $videoId = $snippet['resourceId']['videoId'] ?? null;

                    if (!$videoId) {
                        return null;
                    }

                    $details = $videoDetails->get($videoId, []);

                    $videoSnippet = $details['snippet'] ?? [];
                    $statistics = $details['statistics'] ?? [];

                    $channelId = $videoSnippet['channelId'] ?? null;

                    return [
                        'video_id' => $videoId,

                        'title' => $snippet['title'] ?? '',

                        'description' => $snippet['description'] ?? '',

                        // Video thumbnail
                        'thumbnail' => $snippet['thumbnails']['high']['url']
                            ?? $snippet['thumbnails']['medium']['url']
                            ?? $snippet['thumbnails']['default']['url']
                            ?? null,

                        // Channel information
                        'channel_name' => $videoSnippet['channelTitle']
                            ?? $snippet['videoOwnerChannelTitle']
                            ?? $snippet['channelTitle']
                            ?? '',

                        // Actual channel profile picture
                        'channel_thumbnail' => $channelThumbnails->get($channelId),

                        // Video statistics
                        'views' => (int) ($statistics['viewCount'] ?? 0),

                        'likes' => isset($statistics['likeCount'])
                            ? (int) $statistics['likeCount']
                            : null,
                    ];
                })
                ->filter()
                ->values()
                ->all();
        });
    }
}