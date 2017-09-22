<?php

namespace Tests\Feature;

use App\Inspections\Spam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SpamTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function it_checks_for_invalid_keywords()
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('innocent reply here.'));

        $this->expectException(\Exception::class);
        $spam->detect('some spam');
    }
    
    /** @test */
    public function it_checks_for_any_key_being_held_down()
    {
        $spam = new Spam();

        $this->expectException(\Exception::class);
        $spam->detect('hello world aaaaaaaaaa');
    }
}
