<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessagesTest extends TestCase
{
    /**
     * 測試網頁連線功能是否正常，頁面為: / 和 /messages
     *
     * @return void
     */
    public function testExample()
    {
        $response_1 = $this->get('/');
        $response_2 = $this->get('/messages');

        $response_1->assertStatus(200);
        $response_2->assertStatus(200);
    }
}
