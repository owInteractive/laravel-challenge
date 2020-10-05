import React from "react";
import { connect } from "react-redux";
import WrappedSigninForm from "../../components/signin-form/SigninForm";
import { Typography } from "antd";
import { signin } from "../../actions/auth-actions/actions";
import {
  Link,
} from 'react-router-dom';

import "./signin-page.scss";

const SigninPage = props => {
  return (
    <div className="signin-page">
      <Typography.Title className="title">Sign in page</Typography.Title>
      <div className="content">
        <WrappedSigninForm signin={props.signin} />
        <div className="links">
          <Link to="/signup">don't have account</Link>
          <Link to="/resetpassword">Forgot password ?</Link>
        </div>
      </div>
    </div>
  );
};

export default connect(
  null,
  { signin }
)(SigninPage);