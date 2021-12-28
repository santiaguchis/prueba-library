export default {
    setBooks( state , data ) {
        state.books = data
    },
    setMyBooks( state , data ) {
        state.myBooks = data
    },
    setCategories( state , data ) {
        state.categories = data
    },
    setRentBook( state , book ) {
        state.rentBook = book
    },
    showRentBookModal( state , show ) {
        state.showRentBookModal = show
    },
    updateBook( state, book ) {
        state.books.data.map( (stateBook) => {
            if ( stateBook.id == book['id'] ) {
                console.log( book )
                stateBook.show_available = book['show_available'];
                stateBook.available = book['available'];
            }
        } )
    }
}
