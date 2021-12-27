export default {
    rentBook( { commit } , data ) {
        return new Promise( (resolve, reject) => {
            axios.post( 'books/rent' , data )
                .then( response=> {
                    resolve( response.data )
                })
                .catch( failure => {
                    reject( failure )
                })
        })
    },
    getBooks( { commit , dispatch } , params  ) {
        commit( 'Shared/SHOW_LOADING_PAGE' , null, { root : true } )
        return new Promise( (resolve, reject) => {
            axios.get( 'books' , { params : params } )
                .then( response=> {
                    commit('setBooks' , response.data.data.rows )
                    commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                    resolve( response.data )
                })
                .catch( failure => {
                    commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                    reject( failure )
                })
        })

    }
}
