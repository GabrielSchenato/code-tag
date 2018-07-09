<?php

namespace CodePress\CodeTag\Tests\Models;

use CodePress\CodeTag\Repository\TagRepository;
use CodePress\CodeTag\Tests\AbstractTestCase;
use CodePress\CodeTag\Controllers\AdminTagsController;
use CodePress\CodeTag\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery as m;

/**
 * Description of TagTest
 *
 * @author gabriel
 */
class AdminTagsControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $repository = m::mock(TagRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagsController($responseFactory, $repository);

        $this->assertInstanceOf(Controller::class, $controller);
    }
    
    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $repository = m::mock(TagRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagsController($responseFactory, $repository);
        $html = m::mock();
        
        $repositorysResult = ['tag1', 'tag2'];
        $repository->shouldReceive('all')->andReturn($repositorysResult);
        
        $responseFactory->shouldReceive('view')
                ->with('codetag::index', ['tags' => $repositorysResult])
                ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }
    
    public function test_controller_should_run_show_method_and_return_correct_argument()
    {
        $repository = m::mock(TagRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagsController($responseFactory, $repository);
        $html = m::mock();
        
        $repositoryResult = ['cat1'];
        
        $repository->shouldReceive('find')->with(1)->andReturn($repositoryResult);
        
        $responseFactory->shouldReceive('view')
                ->with('codetag::show', ['tag' => $repositoryResult])
                ->andReturn($html);

        $this->assertEquals($controller->show(1), $html);
    }

}
