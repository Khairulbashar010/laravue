import { createStore } from 'vuex';
import currentUser from './modules/currentUser';

const store = createStore({
  modules: {
    currentUser,
  },
});
export default store;
