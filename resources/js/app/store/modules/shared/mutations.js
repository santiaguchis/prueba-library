export default {
    SET_TITLE_SECTION( state , data ) {
        state.page.section = data
    },
    SHOW_LOADING_PAGE( state ) {
        state.page.loading = true
    },
    HIDE_LOADING_PAGE( state ) {
        setTimeout( () => {
            state.page.loading = false
        } , 500 )
    },
    SHOW_LOGOUT( state ) {
        state.page.logout = true
    },
    HIDE_LOGOUT( state ) {
        state.page.logout = false
    }

}
