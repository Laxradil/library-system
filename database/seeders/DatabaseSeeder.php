<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $contributor = User::updateOrCreate(
            ['email' => 'contributor@libraryhub.test'],
            [
                'name' => 'Library Contributor',
                'password' => Hash::make('password'),
                'role' => 'contributor',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@libraryhub.test'],
            [
                'name' => 'Library Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'viewer@libraryhub.test'],
            [
                'name' => 'Library Viewer',
                'password' => Hash::make('password'),
                'role' => 'viewer',
                'email_verified_at' => now(),
            ]
        );

        $books = [
            ['The Midnight Library', 'Matt Haig', 'Fiction,Fantasy', 2020, 4],
            ['Dune', 'Frank Herbert', 'Science Fiction', 1965, 5],
            ['The Hobbit', 'J.R.R. Tolkien', 'Fantasy,Fiction', 1937, 5],
            ['Becoming', 'Michelle Obama', 'Non-Fiction', 2018, 5],
            ['The Silent Patient', 'Alex Michaelides', 'Mystery / Thriller', 2019, 4],
            ['Pride and Prejudice', 'Jane Austen', 'Romance,Historical,Fiction', 1813, 5],
        ];

        foreach ($books as [$title, $author, $genre, $year, $rating]) {
            Book::updateOrCreate(
                ['title' => $title, 'author' => $author],
                [
                    'description' => "A sample catalog entry for {$title}.",
                    'genre' => $genre,
                    'published_at' => "{$year}-01-01",
                    'rating' => $rating,
                    'approved' => true,
                    'views' => 0,
                    'user_id' => $contributor->id,
                ]
            );
        }
    }
}
