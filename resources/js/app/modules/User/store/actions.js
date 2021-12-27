export default {
    getRows( { commit , dispatch } , params  ) {
        commit( 'Shared/SHOW_LOADING_PAGE' , null, { root : true } )
        return new Promise( (resolve, reject) => {
            axios.get( 'users' , { params : params } )
                .then( response=> {
                    commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                    commit( 'SET_ROWS_DATA' , response.data.data );
                    resolve( response.data );
                })
                .catch( failure => {
                    commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                    reject( failure )
                })
        })

    }
}
