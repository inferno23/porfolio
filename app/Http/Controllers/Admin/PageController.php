<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;

use File;

use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::get();
        return view('admin.page.index',['pages' => $pages]);
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(PageRequest $request)
    {   

        ///dd($request->all());
      if($request->hasFile('file'))  {  
            $image = UploadController::uploadSingleImage('image/page');
                
                $request->request->add(['image' => $image]);
        }
         

        

        Page::create($request->all());
        return redirect()->route('page.index')->with('success','Registro creado correctamente');
    }

    public function edit(Page $page)
    {
        return view('admin.page.edit',['page' => $page]);
    }

    public function update(Request $request, Page $page)
    {
        if($request->hasFile('file'))  {  
            $image = UploadController::uploadSingleImage('image/page');
                
                $request->request->add(['image' => $image]);
        }
        $page->update($request->all());
        return redirect()->route('page.index')->with('success','Datos modificados correctamente');
    }

    public function destroy(Page $page)
    {
        File::delete(storage_path('app/public/uploads/image/page/'.$page->image));
        $page->delete();
        return redirect()->route('page.index')->with('success','Datos eliminados correctamente');
    }


            public function show(Page $page)
            {
               
                return view('admin.page.show', compact('page'));
            }
}
