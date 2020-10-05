import React, { useState } from "react";
import { Form, Icon, Input, Button, message } from "antd";

import "./signup-form.scss";

const SignupForm = props => {
  const [confirmDirty, setConfirmDirty] = useState(false);
  const { getFieldDecorator } = props.form;
  const handleSubmit = e => {
    e.preventDefault();
    props.form.validateFields((err, data) => {
      if (!err) {
        props.signup(data).then(res => console.log(res)).catch(err => console.log('azez', err));
      }
    });
  };
  const validateToNextPassword = (rule, value, callback) => {
    const { form } = props;
    if (value && value.length < 8) {
      callback('password need to be greater then 8 character');
    }
    else if (value && confirmDirty) {
      form.validateFields(['password_confirmation'], { force: true });
    }
    callback();
  };
  const compareToFirstPassword = (rule, value, callback) => {
    const { form } = props;
    if (value && value !== form.getFieldValue('password')) {
      callback('Two passwords that you enter is inconsistent!');
    } else {
      callback();
    }
  };
  const handleConfirmBlur = e => {
    const { value } = e.target;
    setConfirmDirty(confirmDirty || !!value);
  };
  return (
    <Form className="signup-form" onSubmit={handleSubmit}>
      <Form.Item>
        {getFieldDecorator("name", {
          rules: [{ required: true, message: "Please input your name!" }]
        })(
          <Input
            prefix={<Icon type="user" style={{ color: "rgba(0,0,0,.25)" }} />}
            placeholder="Name"
          />
        )}
      </Form.Item>

      <Form.Item>
        {getFieldDecorator("email", {
          rules: [{ required: true, message: "Please input your email!" }]
        })(
          <Input
            prefix={<Icon type="mail" style={{ color: "rgba(0,0,0,.25)" }} />}
            placeholder="Email"
          />
        )}
      </Form.Item>
      <Form.Item hasFeedback>
        {getFieldDecorator("password", {
          rules: [
            {
              required: true, message: "Please input your Password!"
            },
            {
              validator: validateToNextPassword,
            },
          ]

        })(
          <Input.Password
            prefix={<Icon type="lock" style={{ color: "rgba(0,0,0,.25)" }} />}
            type="password"
            placeholder="Password"
          />
        )}
      </Form.Item>
      <Form.Item hasFeedback>
        {getFieldDecorator("password_confirmation", {
          rules: [
            {
              required: true,
              message: "Please Confirm your Password!"
            },
            {
              validator: compareToFirstPassword,
            },

          ]
        })(
          <Input.Password
            prefix={<Icon type="lock" style={{ color: "rgba(0,0,0,.25)" }} />}
            type="password"
            placeholder="Password confirmation"
            onBlur={handleConfirmBlur}
          />
        )}
      </Form.Item>
      <Form.Item>
        <Button type="primary" htmlType="submit" className="submit-button">
          Sign up
        </Button>
      </Form.Item>
    </Form>
  );
};

const WrappedSignupForm = Form.create({ name: "normal_login" })(SignupForm);

export default WrappedSignupForm;
