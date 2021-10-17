<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateProduct()
    {
        $data = [
            'title' => "Ok",
            'description' => "test description",
            'price' => 20.22,
        ];
        $response = $this->json('POST', 'api/products', $data);
        $response->assertStatus(200)
            ->assertOk();

    }

}
