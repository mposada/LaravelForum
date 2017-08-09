<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
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

        // 1. Create a user
        $user = factory(User::class)->create();
        // 2. Sign in he user
        $this->be($user);
        // 3. Create a thread
        $thread = factory(Thread::class)->create();
        // 4. create a reply
        $reply = factory(Reply::class)->make(['user_id' => $user->id]);
        // 5. add the reply to the thread
        $this->post($thread->path() . '/replies/', $reply->toArray());
        // 6. now the reply should be visible
        $this->get($thread->path())->assertSee($reply->body);
    }
}
