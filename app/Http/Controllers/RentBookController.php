<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use App\Entities\Book;
use App\Entities\Category;
use DB;

class RentBookController extends CoreController
{
    public function store( Request $request )
    {
        try {
            DB::beginTransaction();
            $take = ['book_id'];
            $input = $request->only( $take );
            $ifBook = Book::whereHas('users', function( $query ){
                $query->whereIn('id', [ 1 ]);
            })->find( $input['book_id'] );
            $book = Book::find( $input['book_id'] );
            if ( $ifBook ) :
                $book->users()->detach( $this->getUser()->id );
                $book->available++;
                $this->addSuccessMessage( 'Revise su pestaña de libros' , 'Libro devuelto' );
            else :
                $book->users()->syncWithoutDetaching( $this->getUser()->id );
                $book->available--;
                $this->addInfoMessage( 'Revise su pestaña de libros' , 'Libro alquilado' );
            endif;
            $book->save();
            $book->show_available = $ifBook ? true : false;
            $this->addData('book', $book );
            $this->addData('user', $this->getUser() );
            DB::commit();
        }
        catch( \Exception $e ) {
            $this->addErrorMessage('Ha ocurrido un error',$e->getMessage());
            DB::rollback();
        }
        return $this->result();
    }
}
