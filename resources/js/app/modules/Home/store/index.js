import actions from './actions';
import getters from './getters';
import state from './state';
import mutations from './mutations';

const ModuleStore = {
    namespaced : true,
    state: () => (  state ),
    getters,
    actions,
    mutations,
};

export default ModuleStore;
