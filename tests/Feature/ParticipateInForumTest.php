<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function unauthenticated_user_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        // 1. try to add a reply to a thread
        $this->post('threads/1/replies/', []);
    }
    /** @test **/
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        /**
         * Given we have an authenticated user
         * And an existing thread
         * When the user adds a new reply to the thread
         * Then their reply should be visible on the page...
         */

        $this->signIn();
        // 3. Create a thread
        $thread = create('App\Thread');
        // 4. create a reply
        $reply = make('App\Reply');
        // 5. add the reply to the thread
        $this->post($thread->path() . '/replies/', $reply->toArray());
        // 6. now the reply should be visible
        $this->get($thread->path())->assertSee($reply->body);
    }
}
