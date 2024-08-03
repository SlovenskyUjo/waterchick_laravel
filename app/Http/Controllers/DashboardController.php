<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $is_admin = auth()->user()->is_admin;


        return Inertia::render('Dashboard', [
            'plugins' => Plugin::with('tags')->get(),
            'is_admin' => $is_admin
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:50',
            'description' => 'required|min:1|max:244',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string|max:255',
            'url' => 'required|max:254',
            'tags' => 'array',
            'tags.*' => 'string|max:100'
        ]);

        // Uloženie obrázku
        // $path = $request->file('image')->storePublicly('', ['disk' => 'public']);
        $path = $request->file('image')->store('public'); 
        $fileName = basename($path);

        $imageUrl = 'storage/' . $fileName;

        $plugin = Plugin::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl,
            'category' => $request->category,
            'url' => $request->url,
        ]);

        // Uloženie tagov
        $tags = [];
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tags[] = $tag->id;
        }

        $plugin->tags()->sync($tags);



        return redirect('/');
    }

    public function destroy(Plugin $plugin, $id)
    {
        $plugin = Plugin::findOrFail($id);
        $plugin->delete();

        return redirect('/');
    }




}
