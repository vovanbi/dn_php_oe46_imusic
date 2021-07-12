<?php

namespace App\Http\Controllers\Admin;

use App\Models\Song;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\Category\ICategoryRepository;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {

        $categories = $this->categoryRepository->showAll();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categoriesParent = $this->categoryRepository->getAllParentCategory();

        return view('admin.category.create', compact('categoriesParent'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryRepository->create($request->all());

               return redirect()->route('categories.index')->with('success', trans('category.addSuccess'));
        } catch (Throwable $e) {
            return redirect()->route('categories.index')
                            ->with('error', trans('categories.message_create_fail'));
        }
    }

    public function edit($category)
    {
        $category = $this->categoryRepository->findOrFail($category);
        $categoriesParent = $this->categoryRepository->getAllParentCategory();

        return view('admin.category.update', compact('category', 'categoriesParent'));
    }

    public function update(CategoryRequest $request, $category)
    {
        $this->categoryRepository->update($category, $request->all());
        
        return redirect()->route('categories.index')->with('success', trans('category.editSuccess'));
    }

    public function destroy(Category $category)
    {
        try {
            $this->categoryRepository->destroy($id);

            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {

            return redirect()->route('categories.index')->with('danger', trans('category.delNot'));
        }
    }
}
