/* ============
 * Mutations for the account module
 * ============
 *
 * The mutations that are available on the
 * account module.
 */

import { LOADING } from './mutation-types';

/* eslint-disable no-param-reassign */
export default {
  [LOADING](state, isLoading) {
    state.loading = isLoading;
  },
};
