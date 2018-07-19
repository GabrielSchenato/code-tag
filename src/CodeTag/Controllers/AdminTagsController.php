<?php

namespace CodePress\CodeTag\Controllers;

use CodePress\CodeTag\Repository\TagRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

/**
 * Description of AdminTagsController
 *
 * @author gabriel
 */
class AdminTagsController extends Controller
{

    private $response;
    private $repository;
    
    public function __construct(ResponseFactory $response, TagRepositoryInterface $repository)
    {
        
        $this->repository = $repository;
        $this->response = $response;
    }
    
    public function index()
    {
        $this->auth();
        $tags = $this->repository->all();
        return $this->response->view('codetag::index', compact('tags'));
    }
    
    public function show(int $id)
    {
        $this->auth();
        $tag = $this->repository->find($id);
        return $this->response->view('codetag::show', compact('tag'));
    }
    
    public function create()
    {
        $this->auth();
        return $this->response->view('codetag::create');
    }
    
    public function store(Request $request)
    {
        $this->auth();
        $this->repository->create($request->all());
        
        return redirect()->route('admin.tags.index');
    }
    
    public function edit(int $id)
    {
        $this->auth();
        $tag = $this->repository->find($id);
        return $this->response->view('codetag::edit', compact('tag'));
    }
    
    public function update(int $id, Request $request)
    {
        $this->auth();
        $this->repository->update($request->all(), $id);
        
        return redirect()->route('admin.tags.index');
    }
    
    public function destroy(int $id)
    {
        $this->auth();
        $this->repository->find($id)->delete();
        return redirect()->route('admin.tags.index');
    }
    
    public function deleted()
    {
        $this->auth();
        $tags = $this->repository->deleted();
        return $this->response->view('codetag::deleted', compact('tags'));
    }
    
    public function restore(int $id)
    {
        $this->auth();
        $this->repository->restore($id);
        return redirect()->route('admin.tags.index');
    }
    
    private function auth()
    {
        $this->authorize('access_tags');
    }
}
