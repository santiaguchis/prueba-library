export default {
    SET_AUTH_DATA( state , data ) {
        localStorage.setItem( 'mydessk_token' , data.token )
        localStorage.setItem( 'user' , JSON.stringify( data.user ) )

        axios.defaults.headers.common['Authorization'] = 'Bearer '+data.token
        state.token = data.token
        state.user = data.user
    },
    CLEAR_AUTH_DATA( state ) {
        localStorage.clear()
        delete axios.defaults.headers.common['Authorization']
        state.token = null
        state.user = null
    },
    setPermissions( state , data ) {
        state.permissions = data;
    }
}
