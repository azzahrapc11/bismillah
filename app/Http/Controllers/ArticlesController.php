<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Articles  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Categories::where('user_id', Auth::user()->id)->first();
        $data = [
            'categories' => Categories::where('user_id', Auth::user()->id)->get(),
            'active' => $categories,
            'articles' => Articles::where('category_id', $categories->id)->get()
        ];
        return view('categories.index', $data);
    }

    public function categories($id)
    {
        $categories = Categories::where('id', $id)->first();
        if ($categories == null) {
            $categories = Categories::where('user_id', Auth::user()->id)->first();
        }
        $data = [
            'categories' => Categories::where('user_id', Auth::user()->id)->get(),
            'active' => $categories,
            'articles' => Articles::where('category_id', $categories->id)->get()
        ];
        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'categories' => Categories::where('user_id', Auth::user()->id)->get()
        ];
        return view('categories.create', $data);
    }

    public function show($id)
    {
        $articles = Articles::find($id);
        $categories = Categories::where('id', $articles->category_id)->first();
        if($categories == null) {
            $categories= '-';
        } else {
            $categories = $categories->name;
        }
        // dd($buku);
        return view('categories.show', compact('categories', 'articles'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\ArticlesRequest  $request
     * @param  \App\Articlesk  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $articles = new Articles();
        $articles->name = $request->name;
        $articles->category_id = $request->categories;
        $articles->user_id = Auth::user()->id;
        $articles->save();

        return redirect()->route('categories.index')->withStatus(__('Articles successfully added.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\Articles  $user
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $articles = Articles::find($id);
        $data = [
            'categories' => Categories::where('user_id', Auth::user()->id)->get(),
            'articles' => Articles::where('id', $id)->first()
        ];
        // return view('categories.edit', $data);
        return view('categories.edit', compact('articles'),$data);
        
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\ArticlesRequest  $request
     * @param  \App\Articles  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $input = $request->all();

        $articles = Articles::find($id);
        $articles -> update($input);
        return redirect()->route('categories.index')->withStatus(__('Article successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\Articles  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Articles::where('id', $id)->delete();

        return redirect()->route('categories.index')->withStatus(__('Article successfully deleted.'));
    }
}
