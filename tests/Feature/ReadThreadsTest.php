<?php
/**
 * Created by Miguel Posada.
 * User: mposadar
 * Date: 2/08/17
 * Time: 11:53 PM
 */

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase {

    /**
     * for every test it will migrate to the db if needed
     * once the test is completed will delete everything
     */
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory(Thread::class)->create();
    }
    /**
     * for this test use sqlite connection.
     * the setup of the connection is in the phpunit.xml file
     */
    public function test_a_user_can_browse_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    /**
     * test if the user can see the title of the given thread
     */
    public function test_a_user_can_browse_thread_detail()
    {
        $this->get('/threads/'.$this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test **/
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // Given we have a thread
        $reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);
        // and that thread includes replies
        // When we visit a thread page
        $response = $this->get('/threads/'.$this->thread->id);
        // then we should see the replies...
        $response->assertSee($reply->body);
    }

}