export default {
    isAuthenticated: state => !!state.token,
    getUser: state => state.user,
    getMenu : state => state.menu
}
