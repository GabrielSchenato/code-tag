<?php

namespace CodePress\CodeTag\Controllers;

use CodePress\CodeTag\Models\Tag;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

/**
 * Description of AdminCategoriesController
 *
 * @author gabriel
 */
class AdminTagsController extends Controller
{

    private $response;
    private $tag;
    
    public function __construct(ResponseFactory $response, Tag $tag)
    {
        $this->tag = $tag;
        $this->response = $response;
    }
    
    public function index()
    {
        $tags = $this->tag->all();
        return $this->response->view('codetag::index', compact('tags'));
    }
    
    public function show(int $id)
    {
        $tag = $this->tag->find($id);
        return $this->response->view('codetag::show', compact('tag'));
    }
    
    public function create()
    {
        return $this->response->view('codetag::create');
    }
    
    public function store(Request $request)
    {
        $this->tag->create($request->all());
        
        return redirect()->route('admin.tags.index');
    }
    
    public function edit(int $id)
    {
        $tag = $this->tag->find($id);
        return $this->response->view('codetag::edit', compact('tag'));
    }
    
    public function update(int $id, Request $request)
    {
        $this->tag->find($id)->update($request->all());
        
        return redirect()->route('admin.tags.index');
    }
    
    public function destroy(int $id)
    {
        $this->tag->find($id)->delete();
        return redirect()->route('admin.tags.index');
    }
}
