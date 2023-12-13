<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CompanyEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('api/v1/companies/');

        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
            ->has('links')
            ->has('meta')
            ->missing('message')
        );
    }
}
