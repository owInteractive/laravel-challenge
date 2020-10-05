import React from 'react';
import { Form, Input, Icon, Button } from "antd";
import './Forgot.scss';


const ForgotPassForm = props => {

    const { getFieldDecorator } = props.form;
    const handleSubmit = e => {
        e.preventDefault();
        props.form.validateFields((err, data) => {
            if (!err) {
                console.log(data);
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
        </div>
    );
};

const Forgot = Form.create({ name: "modify-profile" })(ForgotPassForm);

export default Forgot;
