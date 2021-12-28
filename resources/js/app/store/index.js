import Vue			from 'vue';
import Vuex			from 'vuex';

import Books		from './modules/books/index';
import Auth			from './modules/auth/index';
import Shared		from './modules/shared/index';
import User			from './modules/users/index';

Vue.use( Vuex )

export default  new Vuex.Store({
	modules : {
		Auth,
		User,
		Shared,
		Books,
	},
});
