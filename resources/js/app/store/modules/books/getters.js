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
    showRentBookModal( state ) {
        return state.showRentBookModal;
    }
}
