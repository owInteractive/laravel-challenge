import React, { useState } from 'react';
import { Form, Input, Modal, Button, Icon, message } from "antd";
import axiosInstance from "../../config/axios-instance";



const ProfileForm = props => {
    const [loading, setLoading] = useState(false);

    const { getFieldDecorator } = props.form;
    const handleSubmit = e => {
        e.preventDefault();
        props.form.validateFields((err, data) => {
            if (!err) {
                console.log(data);
                setLoading(true);
                axiosInstance({
                    method: "post",
                    url: `auth/modifyprofile`,
                    data: data
                }).then(res => {
                    message.success("Profile Chnaged succefully");
                    setLoading(false);
                    props.setShowProfileModel(false);

                })
                    .catch((error) => {
                        message.error(error.response.data.error);
                        setLoading(false);
                        props.form.resetFields();
                    });

            }
        });
    };
    const handleCancel = e => {
        props.setShowProfileModel(false);
        props.form.resetFields()
    };

    return (
        <Modal
            title="Change Profile"
            visible={props.showProfileModel}
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
                <Form.Item>
                    {getFieldDecorator("name", {
                        rules: [{ required: true, message: "Please input your name!" }],
                        initialValue: props.user.name
                    })(
                        <Input
                            prefix={<Icon type="user" style={{ color: "rgba(0,0,0,.25)" }} />}
                            placeholder="Name"

                        />
                    )}
                </Form.Item>

                <Form.Item>
                    {getFieldDecorator("email", {
                        rules: [
                            {
                                required: true,
                                message: "Please input your email!"
                            },
                            {
                                type: 'email',
                                message: 'The input is not valid E-mail!',
                            },
                        ], initialValue: props.user.email
                    })(
                        <Input
                            prefix={<Icon type="mail" style={{ color: "rgba(0,0,0,.25)" }} />}
                            placeholder="Email"
                        />
                    )}
                </Form.Item>
                {/* <Form.Item hasFeedback>
                    {getFieldDecorator("password", {
                        rules: [
                            {
                                required: true, message: "Please input your Password!"
                            },
                            {
                                validator: validateToNextPassword,
                            },
                        ],
                        initialValue: props.user.email

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
                                message: "Please input your Password confirmation!"
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
                </Form.Item> */}
            </Form>
        </Modal>
    );
};


const ProfileModal = Form.create({ name: "modify-profile" })(ProfileForm);
export default ProfileModal;
