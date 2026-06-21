<?php

use App\Models\SystemSetting;

beforeEach(function () {
    SystemSetting::create([
        'system_name' => 'Axion',
        'setup_completed' => true,
        'setup_step' => 0,
    ]);
});

test('returns a successful response', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
});

test('redirects to setup when not completed', function () {
    SystemSetting::first()->update(['setup_completed' => false]);

    $response = $this->get(route('home'));

    $response->assertRedirect(route('setup'));
});

test('setup page is accessible when not completed', function () {
    SystemSetting::first()->update(['setup_completed' => false]);

    $response = $this->get(route('setup'));

    $response->assertOk();
});
