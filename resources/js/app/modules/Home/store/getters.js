export default {
    getBooks( state ) {
        return state.books?.data;
    },
    getRentBook( state ) {
        return state.rentBook;
    }
}
