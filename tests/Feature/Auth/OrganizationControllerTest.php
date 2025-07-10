<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customers;
use App\Models\User;

// use Tests\TestCase as TestsTestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_organization_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/customer', [
            'name' => 'A',
            'phone' => '08121',
            'address' => 'A',
        ]);

        $response->assertRedirect('/customer');
        $this->assertDatabaseHas('customers', [
            'name' => 'A',
            'phone' => '08121',
            'address' => 'A',
        ]);
        // $response->assertSessionHasErrors(['phone' => 'Phone number has already been taken']);
    }

    public function test_organization_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $customer = Customers::factory()->create([
            'name' => 'B',
            'phone' => '08123',
            'address' => 'B',
        ]);

        $response = $this->put("/customer/{$customer->id}", [
            'name' => 'c',
            'phone' => '01234',
            'address' => 'c',
        ]);

        $response->assertRedirect('/customer');
        $this->assertDatabaseHas('customers', [
            'name' => 'c',
            'phone' => '01234',
            'address' => 'c',
        ]);
    }
}
