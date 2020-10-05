import React from 'react';
import { Form, Input, Icon, Button, message } from "antd";
import './Forgot.scss';
import axiosInstance from "../../config/axios-instance";
import {
    Link,
} from 'react-router-dom';



const ForgotPassForm = props => {

    const { getFieldDecorator } = props.form;
    const handleSubmit = e => {
        e.preventDefault();
        props.form.validateFields((err, data) => {
            if (!err) {
                console.log(data);
                axiosInstance({
                    method: "post",
                    url: `auth/forgot`,
                    data: data
                }).then(res => {
                    message.success("Cheack your email");
                    props.form.resetFields();
                })
                    .catch((error) => {
                        message.error(error.response.data.error);
                        props.form.resetFields();
                    });
            }
        });
    };


    return (
        <div className='reset_pass_page'>
            <Form className="signup-form" onSubmit={handleSubmit}>
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
                        ]
                    })(
                        <Input
                            prefix={<Icon type="mail" style={{ color: "rgba(0,0,0,.25)" }} />}
                            placeholder="Email"
                        />
                    )}
                </Form.Item>
                <Form.Item>
                    <Button type="primary" htmlType="submit" className="submit-button">
                        Reset password
                    </Button>
                </Form.Item>
            </Form>
            <Link to="/signin">sign in ?</Link>
        </div>
    );
};

const Forgot = Form.create({ name: "modify-profile" })(ForgotPassForm);

export default Forgot;
