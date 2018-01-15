<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Jobs\StatJob;

class StatTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_knows_if_the_job_is_done()
    {
        $users = create(User::class, 2);

        \Cache::store('file')->set('statistical', 48, 1);

        StatJob::dispatch($users[0]);

        $completedCount = \Cache::store('file')->get('statistical');
        $this->assertEquals(49, $completedCount);

        $this->expectException(\Exception::class);
        StatJob::dispatch($users[1]);

        // the rest case cannot be tested
        dd('interact');
        $completedCount = Cache::store('file')->get('statistical');

        $this->assertEquals(50, $completedCount);
    }
}
