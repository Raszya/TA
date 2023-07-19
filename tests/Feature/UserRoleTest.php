<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleTest extends TestCase
{

    /** @test */
    public function it_can_assign_role_to_user()
    {
        // Persiapkan data untuk pengujian
        $role = Role::create(['name' => 'test_role']);
        $user = User::factory()->create();

        // Melakukan request POST ke route yang sesuai dengan parameter role
        $response = $this->post(route('assignRole', ['user' => $user->id, 'role' => $role->name]));

        // Pastikan response adalah redirect back dengan pesan 'Role has been assigned'
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Role has been assigned');

        // Pastikan user memiliki role yang benar setelah ditugaskan
        $this->assertTrue($user->hasRole($role->name));
    }

    /** @test */
    public function it_redirects_back_with_error_message_if_role_already_assigned()
    {
        // Persiapkan data untuk pengujian
        $role = Role::create(['name' => 'test_role']);
        $user = User::factory()->create();
        $user->assignRole($role->name);

        // Melakukan request POST ke route yang sesuai dengan parameter role yang sama
        $response = $this->post(route('assignRole', ['user' => $user->id, 'role' => $role->name]));

        // Pastikan response adalah redirect back dengan pesan 'Role already assigned'
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Role already assigned');
    }
}
