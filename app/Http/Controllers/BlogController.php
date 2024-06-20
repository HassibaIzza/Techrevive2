<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\MyHelpers;
class BlogController extends Controller
{

    use ImageHandlerTrait;
    public function create()
    {
        return view('backend.blog.createblog');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $data['image'] = $this->handleRequestImage($request->file('image'), 'uploads/images/blog_images');
        }
        

        Blog::insert([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
            'image' => $data['image'] ,
        ]);

        return back()->with('success', 'blog poste ajouter avec succès.');
    }
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function index()
    {
        $blogs = Blog::all()->take(6);
        return view('backend.blog.blog', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        
        return view('backend.blog.blogDétails', compact('blog'));
    }

    public function search(Request $request){
        $blog = trim($request->input('query'));

        // Normaliser les caractères pour gérer les accents
        $normalizedQuery = str_replace(
            ['à', 'â', 'ä', 'é', 'è', 'ê', 'ë', 'î', 'ï', 'ô', 'ö', 'ù', 'û', 'ü', 'ÿ', 'ç'],
            ['a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'y', 'c'],
            $blog
        );

        // Effectuer la recherche dans les produits
        $blogs = Blog::whereRaw("LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(title, 'à', 'a'), 'â', 'a'), 'ä', 'a'), 'é', 'e'), 'è', 'e'), 'ê', 'e'), 'ë', 'e'), 'î', 'i'), 'ï', 'i'), 'ô', 'o'), 'ö', 'o'), 'ù', 'u'), 'û', 'u'), 'ü', 'u'), 'ÿ', 'y'), 'ç', 'c')) LIKE ?", ["%$normalizedQuery%"])
            ->orWhereRaw("LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(content, 'à', 'a'), 'â', 'a'), 'ä', 'a'), 'é', 'e'), 'è', 'e'), 'ê', 'e'), 'ë', 'e'), 'î', 'i'), 'ï', 'i'), 'ô', 'o'), 'ö', 'o'), 'ù', 'u'), 'û', 'u'), 'ü', 'u'), 'ÿ', 'y'), 'ç', 'c')) LIKE ?", ["%$normalizedQuery%"])
            ->get();

        return view('backend.blog.blog', compact('blogs', 'blog'));
    }
}
