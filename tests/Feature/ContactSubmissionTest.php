<?php

use App\Models\Service;
use Illuminate\Support\Facades\Mail;

it('loads the home page successfully', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('stores a valid contact submission and returns success', function () {
    Mail::fake();

    $service = Service::create([
        'slug' => 'branding',
        'title' => 'هوية بصرية',
        'description' => 'تصميم هوية بصرية كاملة',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->postJson('/contact', [
        'name' => 'أحمد الجبلي',
        'company' => 'وسم ميديا',
        'email' => 'client@example.com',
        'phone' => '+966500000000',
        'service' => $service->slug,
        'message' => 'أريد بناء هوية تجارية متكاملة.',
    ]);

    $response->assertOk()->assertJson(['success' => true]);

    $this->assertDatabaseHas('contact_submissions', [
        'email' => 'client@example.com',
        'service_id' => $service->id,
        'status' => 'new',
    ]);
});

it('rejects a contact submission with an invalid service', function () {
    $response = $this->postJson('/contact', [
        'name' => 'أحمد',
        'email' => 'client@example.com',
        'phone' => '+966500000000',
        'service' => 'does-not-exist',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['service']);
});

it('rejects a contact submission missing required fields', function () {
    $response = $this->postJson('/contact', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email', 'phone', 'service']);
});
