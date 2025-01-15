<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Berita extends Controller
{
    public function index()
    {
        // Mengambil data dari tabel blog_posts dengan join
        $data = \DB::table('blog_posts')
            ->join('blog_authors', 'blog_posts.blog_author_id', '=', 'blog_authors.id')
            ->join('blog_categories', 'blog_posts.blog_category_id', '=', 'blog_categories.id')
            ->select('blog_posts.*', 'blog_authors.name as author_name', 'blog_categories.name as category_name')
            ->orderBy('blog_posts.created_at','desc')
            ->get();
        return view('page.berita', compact('data'));
    }
}
