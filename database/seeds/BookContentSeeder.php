<?php

use Illuminate\Database\Seeder;

class BookContentSeeder extends Seeder
{
    public function run()
    {
        $user = \BookStack\User::where('id', '=', 1)->first();
        
        $booksJsonFile = File::get("/Data/books/books_json/RESTful Web Services.json");
        $bookJson = json_decode($booksJsonFile);

        $bookstack = factory(\BookStack\Book::class)->create([
            'name' => $bookJson->title,
            'description' => $bookJson->title,
            'slug' => $bookJson->slug,
            'created_by' => $user->id,
            'updated_by' => $user->id]);

        foreach ($bookJson->contents as $contentsJson) {
            if ($contentsJson->type == 'page') {
                $page = factory(\BookStack\Page::class)->make([
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'book_id' => $bookstack->id,
                    'name' => $contentsJson->title,
                    'slug' => $contentsJson->slug,
                    'html' => $contentsJson->htmlContent,
                    'text' => strip_tags($contentsJson->htmlContent),
                ]);
                $bookstack->pages()->save($page);
            } else {
                $chapter = factory(\BookStack\Chapter::class)->create([
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'book_id' => $bookstack->id,
                    'name' => $contentsJson->title,
                    'slug' => $contentsJson->slug,
                    'description' => $contentsJson->textContent,
                ]);
                $bookstack->chapters()->save($chapter);
                
                foreach ($contentsJson->pages as $pageJson) {
                    $pages = factory(\BookStack\Page::class)->make([
                        'created_by' => $user->id,
                        'updated_by' => $user->id,
                        'book_id' => $bookstack->id,
                        'name' => $pageJson->title,
                        'slug' => $pageJson->slug,
                        'html' => $pageJson->htmlContent,
                        'text' => strip_tags($pageJson->htmlContent),
                    ]);
                    $chapter->pages()->save($pages);
                }
            }
        }
        app(\BookStack\Services\PermissionService::class)->buildJointPermissions();
        app(\BookStack\Services\SearchService::class)->indexAllEntities();
    }
}