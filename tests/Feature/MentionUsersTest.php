<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MentionUsersTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function mentioned_users_in_a_reply_are_notified()
    {
        $john = create(User::class, ['name' => 'JohnDoe']);

        $this->signIn($john);

        $jane = create(User::class, ['name' => 'JaneDoe']);

        $thread = create(Thread::class);

        $reply = make(Reply::class, [
            'body' => '@JaneDoe look at this. And also @kiyon.'
        ]);

        $this->postJson($thread->path() . '/replies', $reply->toArray());

        $this->assertCount(1, $jane->notifications);
    }

    /** @test */
    public function it_can_fetch_all_mentioned_users_starting_with_the_given_characters()
    {
        create(User::class, ['name' => 'johndeo']);
        create(User::class, ['name' => 'johndeo2']);
        create(User::class, ['name' => 'janedeo']);

        $result = $this->getJson('/api/users', ['name' => 'john']);

        $this->count(2, $result->json());
    }
}
