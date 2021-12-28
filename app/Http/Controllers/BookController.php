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
        $query->with('category');
        $query->orderBy( 'publisher_date' , $q['order'] );
        $query->orderBy( 'title' , $q['order'] );

		$rows = $query->paginate( $q['take'] );
        foreach( $rows as $row ) :
            $row->show_available = true;
            foreach( $row->users()->get() as $user ) : 
                if ( $user->id == $this->getUser()->id ) :
                    $row->show_available = false;
                endif;
            endforeach;
        endforeach;
		$this->addData( 'rows' , $rows );
		$this->addData( 'categories' , Category::orderBy('name' , 'Asc')->get() );
		return $this->result();
    }
    public function me( Request $request )
    {

		$this->addData( 'rows' , $this->getUser()->books );
		return $this->result();
    }
}
