import { applyMiddleware, combineReducers, createStore } from 'redux';
import axiosMiddleware from 'redux-axios';
import clients from './clients';
import event from '../reducers/event';

const middlewares = [];

if (process.env.NODE_ENV === `development`) {
  const createLogger = require(`redux-logger`);
  const logger = createLogger();
  middlewares.push(logger);
}

middlewares.push(axiosMiddleware(clients));
const store = createStore(
  combineReducers({
    event,
  }),
  applyMiddleware(
    ...middlewares
  )
);

export default store;
