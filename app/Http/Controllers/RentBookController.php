<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use App\Entities\Book;
use App\Entities\Category;

class RentBookController extends CoreController
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
        $query->has('user', '<', 1);

        if ( $request->has('category_id') && $request->category_id > 0 ) :
            $query->where('category_id' , $request->category_id );
        endif;

        $query->whereHas('users' , function( $subquery ) {
            $subquery->users()->whereNotIn('id' , [ 1 ] );
        });

        $query->orderBy( 'title' , $q['order'] );

		$rows = $query->paginate( $q['take'] );

		$this->addData( 'rows' , $rows );
		$this->addData( 'categories' , Category::orderBy('name' , 'Asc')->get() );
		return $this->result();
    }
    public function store( Request $request )
    {
        $take = ['book_id'];
        $input = $request->only( $take );

        $book = Book::find( $input['book_id'] );
        $book->users()->syncWithoutDetaching( $this->getUser()->id );
        $this->addData('book', $book );
        $this->addData('user', $this->getUser() );
		return $this->result();
    }
}
