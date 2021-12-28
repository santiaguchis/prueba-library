export default {
    login( { commit , dispatch } , credentials ) {
        return new Promise( (resolve, reject) => {
            axios.post( '/auth/login' , credentials )
                .then( response => {
                    if( response.data.status ) {
                        commit( 'SET_AUTH_DATA' , response.data.data )
                    } else {
                        commit( 'CLEAR_AUTH_DATA' )
                    }
                    resolve( response.data )
                })
                .catch( err => {
                    reject( err )
                });
        })
    },
    logout( { commit } ) {

        return new Promise( (resolve, reject) => {
            commit('CLEAR_AUTH_DATA');
            resolve()
        })
        return new Promise( (resolve, reject) => {
            axios.post( '/auth/logout' )
                .then( response => {
                    commit('CLEAR_AUTH_DATA');
                    resolve( response.data )
                })
                .catch( err => {
                    reject( err )
                })
        })
    },
    refreshToken( { commit } ) {
        return new Promise( (resolve, reject) => {
            axios.post( '/auth/refresh' )
                .then( response => {
                    if( response.data.status ) {
                        commit( 'SET_REFRESHED_TOKEN' , response.data.data.token )
                    }
                    resolve( response.data )
                })
                .catch( err => {
                    reject( err )
                })
        })
    },
}
