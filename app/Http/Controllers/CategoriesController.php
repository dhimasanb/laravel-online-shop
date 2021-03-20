<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
      $q = $request->get('q');
      $categories = Category::where('title', 'LIKE', '%'.$q.'%')->orderBy('title')->paginate(5);
      return view('categories.index', compact('categories', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
      $this->validate($request, [
          'title' => 'required|string|max:255|unique:categories',
          'parent_id' => 'exists:categories,id'
      ]);
      Category::create($request->all());
      flash($request->get('title') . ' category saved.')->success()->important();
      return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View|Response
     */
    public function edit(int $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:categories,title,' . $category->id,
            'parent_id' => 'exists:categories,id'
        ]);
        $category->update($request->all());
        flash($request->get('title') . ' category updated.')->success()->important();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {
        Category::find($id)->delete();
        flash($request->get('title') . ' category deleted.')->success()->important();
        return redirect()->route('categories.index');
    }
}
