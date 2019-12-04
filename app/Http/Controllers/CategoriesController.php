<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Categories  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'categories' => Categories::where('user_id', Auth::user()->id)->get(),
            'active' => 'All',
            'articles' => Articles::where('user_id', Auth::user()->id)->get()
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
        return view('categories.createCategory');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\RakRequest  $request
     * @param  \App\Rak  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $categories = new Categories();
        $categories->name = $request->name;
        $categories->user_id = Auth::user()->id;
        // $rak->judul = $request->title;
        // $rak->penulis = $request->author;
        // $rak->deskripsi = $request->deskripsi;
        // $rak->tahun_terbit = $request->tahunTerbit;
        // $rak->penerbit = $request->penerbit;
        // $rak->sampul = $request->sampul;
        // $rak->rak_id = $request->rak;

        $categories->save();

        return redirect()->route('categories.index')->withStatus(__('Category successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('categories.edit', compact('categories'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\CategoriesRequest  $request
     * @param  \App\Categories  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoriesRequest $request, Categories $categories)
    {
        // $hasPassword = $request->get('password');
        // $user->update(
        //     $request->merge([
        //         'password' => Hash::make($request->get('password'))
        //         ])->except([$hasPassword ? '' : 'password'])
        //     );

        // return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\Rak  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Categories::where('id', $id)->delete();

        return redirect()->route('categories.index')->withStatus(__('Category successfully deleted.'));
    }
}
