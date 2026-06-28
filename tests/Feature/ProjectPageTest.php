<?php

use App\Models\Project;
use App\Models\Service;

function makeService(string $slug = 'branding'): Service
{
    return Service::create([
        'slug' => $slug,
        'title' => 'هوية بصرية',
        'description' => 'وصف الخدمة',
        'sort_order' => 1,
        'is_active' => true,
    ]);
}

function makeProject(Service $service, array $overrides = []): Project
{
    return Project::create(array_merge([
        'service_id' => $service->id,
        'slug' => 'demo-project',
        'title' => 'مشروع تجريبي',
        'category_label' => 'هوية بصرية كاملة',
        'short_description' => 'وصف قصير للمشروع',
        'full_description' => 'وصف تفصيلي للمشروع',
        'accent_color' => '#172E66',
        'is_published' => true,
        'sort_order' => 1,
    ], $overrides));
}

it('shows a published project page', function () {
    $service = makeService();
    $project = makeProject($service);

    $this->get(route('projects.show', $project->slug))
        ->assertStatus(200)
        ->assertSee($project->title);
});

it('returns 404 for an unpublished project', function () {
    $service = makeService();
    $project = makeProject($service, ['slug' => 'hidden', 'is_published' => false]);

    $this->get(route('projects.show', $project->slug))
        ->assertStatus(404);
});

it('loads the all-projects index page', function () {
    $service = makeService();
    makeProject($service);

    $this->get(route('projects.index'))
        ->assertStatus(200)
        ->assertSee('معرض أعمالنا الكامل');
});

it('filters projects by service slug', function () {
    $branding = makeService('branding');
    $marketing = makeService('marketing');

    makeProject($branding, ['slug' => 'brand-one', 'title' => 'مشروع هوية']);
    makeProject($marketing, ['slug' => 'market-one', 'title' => 'مشروع تسويق']);

    $this->get(route('projects.index', ['service' => 'branding']))
        ->assertStatus(200)
        ->assertSee('مشروع هوية')
        ->assertDontSee('مشروع تسويق');
});
