<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LockThreadsTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function non_administrator_may_not_lock_threads()
    {
        $this->signIn()->withExceptionHandling();

        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $this->post(route('locked-threads.store', $thread))->assertStatus(403);

        $this->assertFalse(!! $thread->fresh()->locked);
    }

    /** @test */
    public function administrator_can_lock_threads()
    {
        $this->signIn(create(User::class, 'administrator'));

        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $this->post(route('locked-threads.store', $thread));

        $this->assertTrue($thread->fresh()->locked, 'Failed asserting that the thread was locked.');

    }

    /** @test */
    public function administrator_can_unlock_threads()
    {
        $this->signIn(create(User::class, 'administrator'));

        $thread = create(Thread::class, ['user_id' => auth()->id(), 'locked' => true]);

        $this->delete(route('locked-threads.destroy', $thread));

        $this->assertFalse($thread->fresh()->locked, 'Failed asserting that the thread was unlocked.');

    }

    /** @test */
    public function once_locked_a_thread_may_not_received_new_replies()
    {
        $this->signIn();

        $thread = create(Thread::class, ['locked' => true]);

        $this->post($thread->path() . '/replies', [
            'body'    => 'Foobar',
            'user_id' => create(User::class)
        ])->assertStatus(422);


    }
}
