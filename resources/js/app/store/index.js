import Vue			from 'vue';
import Vuex			from 'vuex';

import Auth			from '../modules/Auth/store/index';
import Home			from '../modules/Home/store/index';
import User			from '../modules/User/store/index';
import Shared		from '../modules/Shared/store/index';

Vue.use( Vuex )

export default  new Vuex.Store({
	modules : {
		Auth,
		Home,
		User,
		Shared,
	},
});
