<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Entities\Book;
use App\Entities\Category;
use Illuminate\Console\Command;

class DataLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('books')->truncate();

        $client = new \GuzzleHttp\Client();
        $url = 'https://www.etnassoft.com/api/v1/get';
        $request = $client->request('GET' , $url , [
            'query' => [
                'criteria' => 'most_viewed',
                'num_items' => 115,
                'json' => true
            ]
        ]);
        $response = (string) $request->getBody();
        foreach( json_decode( $response ) as $book ) :
            $category = $book->categories[0]; 

            $newBook = Book::create([
                'id' => $book->ID,
                'title' => $book->title,
                'author' => $book->author,
                'content' => $book->content_short,
                'pages' => $book->pages,
                'publisher_date' => $book->publisher_date,
                'thumbnail' => $book->thumbnail,
                'language' => $book->language,
                'available' => 5,
                'category_id' => $category->category_id
            ]);
            if ( $category && !Category::find( $category->category_id ) ) :
                Category::create([
                    'id' => $category->category_id,
                    'name' => $category->name
                ]);
            endif;
            $this->command->info( 'BOOK: '. $book->title );

        endforeach;
    }
}
