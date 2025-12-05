<?php

namespace Tests\Feature;

use App\Models\BusinessSetting;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminBusinessSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_business_settings_form(): void
    {
        $admin = $this->createAdminUser();
        $settings = BusinessSetting::factory()->create(['name' => 'Scholarship Hub']);

        $this->actingAs($admin)
            ->get(route('admin.business-settings.edit'))
            ->assertOk()
            ->assertSee('Business Settings')
            ->assertSee($settings->name);
    }

    public function test_admin_can_update_business_settings_with_logo_and_favicon(): void
    {
        Storage::fake('public');

        $admin = $this->createAdminUser();
        BusinessSetting::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.business-settings.update'), [
            'name' => 'Scholarship Hub',
            'email' => 'team@example.com',
            'phone' => '123-456-7890',
            'website' => 'https://example.com',
            'address' => '123 Learning Lane',
            'footer_text' => 'Empowering students worldwide.',
            'logo' => UploadedFile::fake()->image('logo.png', 400, 200),
            'favicon' => UploadedFile::fake()->image('favicon.png', 64, 64),
        ]);

        $response->assertRedirect(route('admin.business-settings.edit'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('business_settings', [
            'name' => 'Scholarship Hub',
            'email' => 'team@example.com',
            'phone' => '123-456-7890',
            'website' => 'https://example.com',
        ]);

        $settings = BusinessSetting::first();

        $this->assertNotNull($settings->logo);
        $this->assertNotNull($settings->favicon);
        Storage::disk('public')->assertExists($settings->logo);
        Storage::disk('public')->assertExists($settings->favicon);
    }

    private function createAdminUser(): User
    {
        $role = Role::factory()->create([
            'is_admin' => true,
            'slug' => 'admin-' . uniqid(),
        ]);

        return User::factory()
            ->for($role, 'role')
            ->create();
    }
}
