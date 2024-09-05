<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitHubUserSearch extends Controller
{
    const GITHUB_URL = 'https://api.github.com/users/';
    public function getUserSearch($name, $page = 1): JsonResponse
    {
        $url_user = self::GITHUB_URL.$name;
        $url_followers = self::GITHUB_URL.$name."/followers?page=".$page;
        $res_user = Http::get($url_user);
        $res_followers = Http::get($url_followers);

        if ($res_user->failed()) {
            return response()->json([
                "status" => false,
                "message" => "No user found",
                "data" => []
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => "found",
                "data" => [
                    "user" => $res_user->json(),
                    "followers" => $res_followers->json()
                ]
            ]);
        }

    }

}
