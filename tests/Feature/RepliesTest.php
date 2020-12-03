<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepliesTest extends TestCase
{
    /**
     * 測試網頁連線功能是否正常，頁面為: /replies/{id}
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/replies/{id}');

        $response->assertStatus(200);
    }
}
