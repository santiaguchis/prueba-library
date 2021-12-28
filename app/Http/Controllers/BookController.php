<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use App\Entities\Book;
use App\Entities\Category;
use App\Entities\Auth\User;
use DB;

class BookController extends CoreController
{
    public function index( Request $request )
    {
		$q = [
			'take' => ( $request->has('take') ) ? $request->take : 25,
			's' => ( $request->has('s') ) ? explode(' ', $request->s) : [],
            'order' => ( $request->has('order') ? $request->order : 'Asc' ),
            'year' => ( $request->has('year') ? $request->year : 'Asc' )
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
        if ( $request->has('year') ) :
            $query->orderBy( 'publisher_date' , $q['year'] );
        endif;
        if ( $request->has('order') ) :
            $query->orderBy( 'title' , $q['order'] );
        endif;

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
    public function update( $id , Request $request )
    {
        try {
            DB::beginTransaction();
            $take = ['title' , 'publisher_date'];
            $input = $request->only( $take );
            $book = Book::find( $id );

            $book->update( $input );
            $this->addData('book', $book );
            $this->addSuccessMessage( 'Datos actualizados correctamente' , 'Registro actualizado' );
            DB::commit();
        }
        catch( \Exception $e ) {
            $this->addErrorMessage('Ha ocurrido un error',$e->getMessage());
            DB::rollback();
        }
        return $this->result();
    }
    public function destroy( $id , Request $request )
    {
        try {
            DB::beginTransaction();
            $book = Book::find( $id );
            $this->addData('book', $book );
            $book->delete();
            $this->addSuccessMessage( 'Datos eliminados correctamente' , 'Registro eliminado' );
            DB::commit();
        }
        catch( \Exception $e ) {
            $this->addErrorMessage('Ha ocurrido un error',$e->getMessage());
            DB::rollback();
        }
        return $this->result();
    }
    public function me( Request $request )
    {
        $books = $this->getUser()->books()->with('category')->get();
        
		$this->addData( 'rows' , $books );
		return $this->result();
    }
}
