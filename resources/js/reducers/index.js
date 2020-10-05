import { combineReducers } from "redux";
import authReducer from "./auth-reducer";
import eventsReducer from "./events-reducer";
import notificationsReducer from "./notifications-reducer";

const rootReducer = combineReducers({
  authReducer,
  eventsReducer,
  notificationsReducer
});

export default rootReducer;
