import React, { useState } from 'react';
import { Form, Input, Button, Icon, message } from "antd";
import axiosInstance from "../../config/axios-instance";
import { useHistory } from "react-router-dom";
import './ResetPass.scss';


const ResetPassForm = props => {
    let history = useHistory();
    const { getFieldDecorator } = props.form;
    const [confirmDirty, setConfirmDirty] = useState(false);

    const handleSubmit = e => {
        e.preventDefault();
        props.form.validateFields((err, data) => {
            if (!err) {
                console.log(data);
                const obj = {
                    'password': data.password,
                    'token': props.match.params.id
                }
                console.log(obj);
                axiosInstance({
                    method: "post",
                    url: `auth/reset`,
                    data: obj
                }).then(res => {
                    message.success("Password Chnaged succefully");
                    history.push("/signin");

                })
                    .catch((error) => {
                        message.error(error.response.data.error);
                        props.form.resetFields();
                    });

            }
        });
    };

    const validateToNextPassword = (rule, value, callback) => {
        const { form } = props;
        if (value && value == form.getFieldValue('old_password')) {
            callback('New password must be different from the old password');
        }
        else if (value && value.length < 8) {
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
        <div className="resetPage">
            <Form className="signup-form" onSubmit={handleSubmit}>
                <Form.Item hasFeedback>
                    {getFieldDecorator("password", {
                        rules: [
                            {
                                required: true, message: "Please input your new Password!"
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
                                message: "Please Confirm your new Password!"
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
                        Confirm
                    </Button>
                </Form.Item>
            </Form>
        </div>
    );
};

const ResetPass = Form.create({ name: "reset-pass" })(ResetPassForm);

export default ResetPass;
