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
    setBook( state , book ) {
        state.book = book
    },
    setRentBook( state , book ) {
        state.rentBook = book
    },
    showRentBookModal( state , show ) {
        state.showRentBookModal = show
    },
    showEditBookModal( state , show ) {
        state.showEditBookModal = show
    },
    showDeleteBookModal( state , show ) {
        state.showDeleteBookModal = show
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
