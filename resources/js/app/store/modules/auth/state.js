export default {
    user: JSON.parse( localStorage.getItem('user') ) || null,
    token: localStorage.getItem('mydessk_token') || null,
    permissions : null
}
