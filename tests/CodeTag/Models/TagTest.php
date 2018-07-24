<?php

namespace CodePress\CodeTag\Tests\Models;

use CodePress\CodeTag\Models\Post;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeTag\Tests\AbstractTestCase;
use Illuminate\Validation\Validator;
use Mockery as m;

/**
 * Description of TagTest
 *
 * @author gabriel
 */
class TagTest extends AbstractTestCase
{

    protected function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_check_if_a_tag_has_a_name()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $this->assertEquals('Tag Test', $tag->name);
    }

    public function test_inject_validator_in_tag_model()
    {
        $tag = new Tag();
        $validator = m::mock(Validator::class);
        $tag->setValidator($validator);

        $this->assertEquals($tag->getValidator(), $validator);
    }

    public function test_should_check_if_it_is_valid_when_it_is()
    {
        $tag = new Tag();

        $tag->name = 'Tag Test';

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']);
        $validator->shouldReceive('setData')->with(['name' => 'Tag Test']);
        $validator->shouldReceive('fails')->andReturn(false);

        $tag->setValidator($validator);

        $this->assertTrue($tag->isValid());
    }

    public function test_should_check_if_it_is_invalid_when_it_is()
    {
        $tag = new Tag();

        $tag->name = 'Tag Test';

        $messageBag = m::mock(Illuminate\Support\MessageBag::class);

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']);
        $validator->shouldReceive('setData')->with(['name' => 'Tag Test']);
        $validator->shouldReceive('fails')->andReturn(true);
        $validator->shouldReceive('errors')->andReturn($messageBag);

        $tag->setValidator($validator);

        $this->assertFalse($tag->isValid());
        $this->assertEquals($messageBag, $tag->errors);
    }

    public function test_check_if_a_tag_can_be_persisted()
    {
        $tag = Tag::create(['name' => 'Tag Test', 'active' => true]);
        $this->assertEquals('Tag Test', $tag->name);

        $tag = Tag::all()->first();
        $this->assertEquals('Tag Test', $tag->name);
    }
    
    public function test_can_add_posts_to_tags()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $post1 = Post::create(['title' => 'meu post 1', 'image' => '123456', 'content' => 'meu conteudo 1']);
        $post2 = Post::create(['title' => 'meu post 2', 'image' => '123456', 'content' => 'meu conteudo 2']);
        
        $post1->tags()->save($tag);
        $post2->tags()->save($tag);
        
        $this->assertCount(1, Tag::all());
        $this->assertEquals('Tag Test', $post1->tags->first()->name);
        $this->assertEquals('Tag Test', $post2->tags->first()->name);
        
        $posts = Tag::find(1)->posts;
        $this->assertCount(2, $posts);
        $this->assertEquals('meu post 1', $posts[0]->title);
        $this->assertEquals('meu post 2', $posts[1]->title);
    }

    public function test_can_soft_delete()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $tag->delete();
        $this->assertTrue($tag->trashed());
        $this->assertCount(0, Post::all());
    }
    
    public function test_can_get_rows_deleted()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        Tag::create(['name' => 'Tag Test 2']);
        $tag->delete();
        $tags = Tag::onlyTrashed()->get();
        $this->assertEquals(1, $tags[0]->id);
        $this->assertEquals('Tag Test', $tags[0]->name);
    }
    
    public function test_can_get_rows_deleted_and_activated()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        Tag::create(['name' => 'Tag Test 2']);
        $tag->delete();
        $tags = Tag::withTrashed()->get();
        $this->assertCount(2, $tags);
        $this->assertEquals(1, $tags[0]->id);
        $this->assertEquals('Tag Test', $tags[0]->name);
    }
    
    public function test_can_force_delete()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $tag->forceDelete();
        $this->assertCount(0, Tag::all());
    }
    
    public function test_can_restore_rows_from_deleted()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $tag->delete();
        $tag->restore();
        $tag = Tag::find(1);
        $this->assertEquals(1, $tag->id);
        $this->assertEquals('Tag Test', $tag->name);
    }
    
}
