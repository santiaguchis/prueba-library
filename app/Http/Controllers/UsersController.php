<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;

use App\Entities\Auth\User;

class UsersController extends CoreController
{
	public function index( Request $request )
	{
		$q = [
			'take' => ( $request->has('take') ) ? $request->take : 10,
			's' => ( $request->has('s') ) ? explode(' ', $request->s) : [],
		];
		$query = User::query();


        if ( count( $q['s'] ) ) :
            foreach ( $q['s'] as $string ) :
                $query->where( function( $subquery ) use ( $string ) {
                    $subquery->where('first_name','like', '%'.$string.'%')
                        ->orWhere('last_name','like', '%'.$string.'%')
                        ->orWhere('email','like', '%'.$string.'%');
                });
            endforeach;
        endif;
		$query->orderBy( 'id' , 'Desc' );
		$rows = $query->paginate( $q['take'] );
        foreach( $rows->items() as $row ) :
            $row->_current = ( $this->getUser()->id == $row->id ) ? false : true;
        endforeach;
		$this->addData( 'headers' , $this->_getHeaders() );
		$this->addData( 'rows' , $rows );
		return $this->result();
	}
    private function _getHeaders()
    {
        $headers = [
			[
				'sortable'  => false,
				'text'      => 'Nombres',
				'value'     => 'first_name'
			],
			[
				'sortable'  => false,
				'text'      => 'Apellidos',
				'value'     => 'last_name'
			],
			[
				'sortable'  => false,
				'text'      => 'Email',
				'value'     => 'email'
			],
			[
				'sortable'  => false,
				'text'      => '',
				'align'     => 'end',
				'value'     => 'actions'
			],

		];
        return $headers;
    }
}
