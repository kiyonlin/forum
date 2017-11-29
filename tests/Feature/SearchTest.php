<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_search_threads()
    {
        config(['scout.driver' => 'algolia']);

        $search = 'foobar';

        create(Thread::class, 2);
        create(Thread::class, ['body' => "A thread with the {$search} term."], 2);

        do {
            sleep(.25);

            $result = $this->getJson("/threads/search?q={$search}")->json()['data'];
        } while(empty($result));

        $this->assertCount(2, $result);

        Thread::latest()->take(4)->unsearchable();
    }
}
