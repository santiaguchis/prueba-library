import actions from './actions';
import getters from './getters';
import state from './state';
import mutations from './mutations';

const ModuleStore = {
    namespaced : true,
    state: () => (  state ),
    getters: getters,
    actions: actions,
    mutations: mutations
};

export default ModuleStore;
