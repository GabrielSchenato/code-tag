<?php

namespace CodePress\CodeTag\Tests\Models;

use CodePress\CodeTag\Models\Tag;
use CodePress\CodeTag\Tests\AbstractTestCase;

/**
 * Description of CategoryTest
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

}
