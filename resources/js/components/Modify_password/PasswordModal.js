import React, { useState } from 'react';
import { Form, Input, Modal, DatePicker, Button, Icon, message } from "antd";
import axiosInstance from "../../config/axios-instance";



const PasswordForm = props => {
    const [loading, setLoading] = useState(false);
    const [confirmDirty, setConfirmDirty] = useState(false);

    const { getFieldDecorator } = props.form;
    const handleSubmit = e => {
        e.preventDefault();
        props.form.validateFields((err, data) => {
            if (!err) {
                console.log(data);
                setLoading(true);
                axiosInstance({
                    method: "post",
                    url: `auth/modifypassword`,
                    data: data
                }).then(res => {
                    message.success("Password Chnaged succefully");
                    setLoading(false);
                    props.setShowPasswordModel(false);

                })
                    .catch((error) => {
                        message.error(error.response.data.error);
                        setLoading(false);
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
    const handleCancel = e => {
        props.setShowPasswordModel(false);
        props.form.resetFields()
    };
    const handleConfirmBlur = e => {
        const { value } = e.target;
        setConfirmDirty(confirmDirty || !!value);
    };

    return (
        <Modal
            title="Change Password"
            visible={props.showPasswordModel}
            onCancel={handleCancel}
            footer={[
                <Button key="back" onClick={handleCancel}>
                    Cancel
            </Button>,
                <Button key="submit" type="primary" loading={loading} onClick={handleSubmit}>
                    Confirm
            </Button>,
            ]}
        >
            <Form className="signup-form" onSubmit={handleSubmit}>
                <Form.Item hasFeedback>
                    {getFieldDecorator("old_password", {
                        rules: [
                            {
                                required: true, message: "Please input your current Password!"
                            }
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
            </Form>
        </Modal>
    );
};


const PasswordModal = Form.create({ name: "modify-profile" })(PasswordForm);
export default PasswordModal;
