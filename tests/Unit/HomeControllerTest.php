<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class HomeControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testindexTestFail()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }
}
