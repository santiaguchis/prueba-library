export default {
    getBooks( state ) {
        return state.books;
    },
    getMyBooks( state ) {
        return state.myBooks;
    },
    getCategories( state ) {
        return state.categories;
    },
    getRentBook( state ) {
        return state.rentBook;
    },
    getBook( state ) {
        return state.book;
    },
    showRentBookModal( state ) {
        return state.showRentBookModal;
    },
    showEditBookModal( state ) {
        return state.showEditBookModal;
    },
    showDeleteBookModal( state ) {
        return state.showDeleteBookModal;
    }
}
