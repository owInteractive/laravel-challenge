import React from "react";
import { connect } from "react-redux";
import WrappedSignupForm from "../../components/signup-form/SignupForm";
import { Typography } from "antd";
import { signup } from "../../actions/auth-actions/actions";
import "./signup-page.scss";
import {
  Link,
} from 'react-router-dom';

const SignUpPage = props => {
  return (
    <div className="signup-page">
      <Typography.Title className="title">Sign up page</Typography.Title>
      <div className="content">
        <WrappedSignupForm signup={props.signup} />
        <Link to="/signin">already have an account!</Link>
      </div>
    </div>
  );
};

export default connect(
  null,
  { signup }
)(SignUpPage);
