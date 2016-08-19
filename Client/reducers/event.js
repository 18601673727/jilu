module.exports = function event(state = {}, action) {
  switch (action.type) {
    case 'CREATE_EVENT_SUCCESS':
      return Object.assign({}, state, action.payload);
    default:
      return state;
  }
};
