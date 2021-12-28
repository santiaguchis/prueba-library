export default {
    getBooks( { commit , dispatch } , params  ) {
        commit( 'Shared/SHOW_LOADING_PAGE' , null, { root : true } )
        return new Promise( (resolve, reject) => {
            axios.get( 'books' , { params : params } )
                .then( response=> {
                    commit('setBooks' , response.data.data.rows )
                    commit('setCategories' , response.data.data.categories )
                    commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                    commit( 'Auth/setPermissions' , response.data.permissions, { root : true } )
                    resolve( response.data )
                })
                .catch( failure => {
                    commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                    reject( failure )
                })
        })

    },
    getMyBooks( { commit , dispatch } , params  ) {
        commit( 'Shared/SHOW_LOADING_PAGE' , null, { root : true } )
        return new Promise( (resolve, reject) => {
            axios.get( 'books/me' , { params : params } )
                .then( response=> {
                    commit('setMyBooks' , response.data.data.rows )
                    commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                    commit( 'Auth/setPermissions' , response.data.permissions, { root : true } )
                    resolve( response.data )
                })
                .catch( failure => {
                    commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                    reject( failure )
                })
        })

    },
    rentBook( { commit } , data ) {
        return new Promise( (resolve, reject) => {
            axios.post( 'books/rent' , data )
                .then( response=> {
                    commit('updateBook' , response.data.data.book )
                    resolve( response.data )
                })
                .catch( failure => {
                    reject( failure )
                })
        })
    },
}
