<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\admin\AdminVideo;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $videos = \App\Models\admin\AdminVideo::latest()->get();
       return view('video.index', compact('videos'));
    }

  public function tonton($id)
{
    $video = AdminVideo::findOrFail($id);

    $video->ditonton = 1;
    $video->save();

    return response()->json(['success' => true]);
}
}
