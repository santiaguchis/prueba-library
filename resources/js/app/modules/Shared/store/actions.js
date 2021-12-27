export default {
    showLogout( { commit , dispatch } ) {
        commit( 'SHOW_LOGOUT' );
    },
    hideLogout( { commit , dispatch } ) {
        commit( 'HIDE_LOGOUT' );
    },
    setTitleSection( { commit , dispatch } , data ) {
        commit( 'SET_TITLE_SECTION' , data )
    },

}
