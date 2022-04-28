import * as types from './mutation-types';

export const loading = ({ commit }) => {
  commit(types.LOADING, true);
};

export const stoploading = ({ commit }) => {
  new Promise(resolve=>setTimeout(()=>
    commit(types.LOADING, false)
  ,500));
};

export default {
  loading,
  stoploading,
};
