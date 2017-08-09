<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * run the tests in this class
 * phpunit tests/Unit/ThreadTest.php
 * --------------------------------------
 * run a single test
 * phpunit --filter a_thread_has_a_creator
 * --------------------------------------
 * Class ThreadTest
 * @package Tests\Unit
 */
class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }
    
    /** @test **/
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }
    
    /** @test **/
    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test **/
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Test Reply...',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
