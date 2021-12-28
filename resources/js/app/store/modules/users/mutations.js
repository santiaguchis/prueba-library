export default {
    SET_ROWS_DATA( state , data ) {
        state.headers = data.headers;
        state.rows = data.rows;
    },
}
