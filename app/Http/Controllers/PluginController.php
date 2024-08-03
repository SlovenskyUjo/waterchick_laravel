<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PluginController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'plugins' => Plugin::with('tags')->get()
        ]);
    }

    public function show(Plugin $plugin)
    {
        return Inertia::render('PluginDetail', [
            'plugin' => [
                'id' => $plugin->id,
                'name' => $plugin->name,
                'description' => $plugin->description,
                'category' => $plugin->category,
                'image' => Storage::disk('public')->url($plugin->image),
                'tags' => $plugin->tags
            ]
        ]) ;
    }

}
