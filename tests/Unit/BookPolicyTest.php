<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows admin to update and delete any book', function () {
    $owner = User::factory()->create(['role' => 'contributor']);
    $book = Book::factory()->for($owner, 'user')->create();

    $admin = User::factory()->create(['role' => 'admin']);

    expect($admin->can('update', $book))->toBeTrue();
    expect($admin->can('delete', $book))->toBeTrue();
});

it('allows owner contributor to update and delete their book', function () {
    $owner = User::factory()->create(['role' => 'contributor']);
    $book = Book::factory()->for($owner, 'user')->create();

    expect($owner->can('update', $book))->toBeTrue();
    expect($owner->can('delete', $book))->toBeTrue();
});

it('prevents other contributors from updating or deleting books they do not own', function () {
    $owner = User::factory()->create(['role' => 'contributor']);
    $book = Book::factory()->for($owner, 'user')->create();

    $other = User::factory()->create(['role' => 'contributor']);

    expect($other->can('update', $book))->toBeFalse();
    expect($other->can('delete', $book))->toBeFalse();
});

it('prevents viewers from updating or deleting any book', function () {
    $owner = User::factory()->create(['role' => 'contributor']);
    $book = Book::factory()->for($owner, 'user')->create();

    $viewer = User::factory()->create(['role' => 'viewer']);

    expect($viewer->can('update', $book))->toBeFalse();
    expect($viewer->can('delete', $book))->toBeFalse();
});
