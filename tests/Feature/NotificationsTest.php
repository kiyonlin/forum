<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotificationsTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_notification_is_prepared_when_a_subscribed_thread_receive_a_new_reply_that_is_not_by_the_current_user()
    {
        $this->signIn();

        $thread = create(Thread::class)->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body'    => 'some Reply here.'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply([
            'user_id' => create(User::class)->id,
            'body'    => 'some Reply here.'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }
    
    /** @test */
    public function a_user_can_fetch_their_unread_notifications()
    {
        $this->signIn();

        $thread = create(Thread::class)->subscribe();

        $thread->addReply([
            'user_id' => create(User::class)->id,
            'body'    => 'some Reply here.'
        ]);

        $signedInUser = auth()->user();

        $response = $this->getJson("/profiles/{$signedInUser->name}/notifications")->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        $this->signIn();

        $thread = create(Thread::class)->subscribe();

        $thread->addReply([
            'user_id' => create(User::class)->id,
            'body'    => 'some Reply here.'
        ]);

        $signedInUser = auth()->user();

        $this->assertCount(1, $signedInUser->unreadNotifications);

        $notificationId = $signedInUser->unreadNotifications->first()->id;

        $this->delete("/profiles/{$signedInUser->name}/notifications/{$notificationId}");

        $this->assertCount(0, auth()->user()->fresh()->unreadNotifications);

    }
}
