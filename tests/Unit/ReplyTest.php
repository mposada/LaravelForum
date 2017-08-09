<?php

namespace Tests\Unit;

use App\Reply;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * to run this test use command line
 *
 *  phpunit tests/Unit/ReplyTest.php
 *
 * Class ReplyTest
 * @package Tests\Unit
 */
class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function is_has_an_owner()
    {
        $reply = factory(Reply::class)->create();
        $this->assertInstanceOf(User::class, $reply->owner);
    }
}
