import Vue from 'vue';
import Vuex from 'vuex';
import chatState from './chat/state';
import chatGetters from './chat/getters';
import chatMutations from './chat/mutatos';
import chatActions from './chat/actions';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        ...chatState,
    },
    getters: {
        ...chatGetters
    },
    mutations: {
        ...chatMutations
    },
    actions: {
        ...chatActions
    }
});
