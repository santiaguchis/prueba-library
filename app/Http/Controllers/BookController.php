<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use App\Entities\Book;
use App\Entities\Category;
use App\Entities\Auth\User;

class BookController extends CoreController
{
    public function index( Request $request )
    {
		$q = [
			'take' => ( $request->has('take') ) ? $request->take : 25,
			's' => ( $request->has('s') ) ? explode(' ', $request->s) : [],
            'order' => ( $request->has('order') ? $request->order : 'Asc' )
		];
        $query = Book::query();

        if ( count( $q['s'] ) ) :
            foreach ( $q['s'] as $string ) :
                $query->where( function( $subquery ) use ( $string ) {
                    $subquery->where('title','like', '%'.$string.'%')
                        ->orWhere('author','like', '%'.$string.'%');
                });
            endforeach;
        endif;
        if ( $request->has('category_id') && $request->category_id > 0 ) :
            $query->where('category_id' , $request->category_id );
        endif;
        
        $query->orderBy( 'title' , $q['order'] );

		$rows = $query->paginate( $q['take'] );

		$this->addData( 'rows' , $rows );
		$this->addData( 'categories' , Category::orderBy('name' , 'Asc')->get() );
		return $this->result();
    }
    public function me( Request $request )
    {

		$this->addData( 'rows' , $this->getUser()->books );
		return $this->result();
    }
    public function seed()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://www.etnassoft.com/api/v1/get/?criteria=most_viewed&num_items=100&json=true');
        $response = (string) $request->getBody();
        $response = str_replace( ["\r","\n"],"", $response );
        $response = implode( ["\r","\n"], $response );
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
                'avalaible' => 5,
                'category_id' => $category->category_id
            ]);
            if ( !Category::find( $category->category_id ) ) :
                Category::create([
                    'id' => $category->category_id,
                    'name' => $category->name
                ]);
            endif;
        endforeach;
        return response()->json( json_decode( $response ) );
    }
}
