<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'uuid' => '123e4567-e89b-12d3-a456-426614174000',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'is_active' => 'true',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
