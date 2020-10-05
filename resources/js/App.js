import React from "react";
import { connect } from "react-redux";
import { Route, Redirect, Switch, withRouter } from "react-router-dom";
import HomePage from "./pages/home-page/HomePage";
import Navbar from "./components/navbar/Navbar";
import Forgot from "./components/Forgot/Forgot";
import ResetPass from "./components/Reset/ResetPass";
import SigninPage from "./pages/signin-page/SigninPage";
import SignUpPage from "./pages/signup-page/SignUpPage";
import { logout } from "./actions/auth-actions/actions";
import PostsPage from "./pages/posts-page/PostsPage";
import Notfound from "./pages/Notfound/Notfound";

import './App.scss';

const App = props => {
  return (
    <div className="App" >
      <Navbar
        user={props.user}
        isLoggedIn={props.isLoggedIn}
        logout={props.logout}
      />
      <div className='page-content' id="style-2">
        <Switch location={props.history.location}>
          {/* <Route exact path={"/"} component={PostsPage} /> */}
          <AuthRoute
            authenticated={props.isLoggedIn}
            path="/events"
            component={PostsPage}
          />
          <GuestRoute
            authenticated={props.isLoggedIn}
            path="/signup"
            component={SignUpPage}
          />
          <GuestRoute
            authenticated={props.isLoggedIn}
            path="/signin"
            component={SigninPage}
          />
          <GuestRoute
            authenticated={props.isLoggedIn}
            path="/resetpassword"
            component={Forgot}
          />
          <GuestRoute
            authenticated={props.isLoggedIn}
            path="/reset/:id"
            component={ResetPass}
          />
          <Route component={() => <Notfound isLoggedIn={props.isLoggedIn} />} />
        </Switch>
      </div>
    </div>
  );
};
function AuthRoute({ component: Component, authenticated, ...rest }) {
  return (
    <Route
      {...rest}
      exact
      render={props =>
        authenticated ? (
          <Component {...props} />
        ) : (
            <Redirect
              to={{ pathname: "/signin", state: { from: props.location } }}
            />
          )
      }
    />
  );
}


function GuestRoute({ component: Component, authenticated, ...rest }) {
  return (
    <Route
      {...rest}
      exact
      render={props =>
        !authenticated ? <Component {...props} /> : <Redirect to="/" />
      }
    />
  );
}
const mapStateToProps = reduxStore => {
  return {
    isLoggedIn: reduxStore.authReducer.isLoggedIn,
    user: reduxStore.authReducer.user,
    isLoadingUser: reduxStore.authReducer.isLoadingUser
  };
};

export default withRouter(
  connect(
    mapStateToProps,
    { logout }
  )(App)
);
