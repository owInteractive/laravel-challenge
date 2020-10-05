import React from 'react';
import { Form, Input, Button, Icon, Alert, message } from "antd";
import { connect } from "react-redux";
import { addNotifications } from '../../actions/notification-actions/action';
import axiosInstance from "../../config/axios-instance";


const AddForm = props => {
    const handleSubmitForm = (event, value) => {
        event.preventDefault();
        props.form.validateFields(async (err, data) => {
            if (!err) {
                console.log(data);
                const obj = {
                    ...data,
                    'eventId': props.event.id
                }
                axiosInstance({
                    method: "post",
                    url: `auth/notifications`,
                    data: obj
                }).then(res => {
                    message.success("Friend Added succefully");
                    setTimeout(() => {
                        props.handleCancel();
                    }, 1000);
                    props.form.resetFields();
                    props.setShowAddFriendForm(false);
                })
                    .catch((error) => {
                        message.error(error.response.data.error);
                        props.form.resetFields();
                    });
            } else {
                console.log(err);

            }
        });
    }
    const { getFieldDecorator } = props.form;
    return (
        <Form style={style} onSubmit={handleSubmitForm}>
            <div className="input-group">
                <Form.Item>
                    {getFieldDecorator("mail", {
                        rules: [
                            {
                                required: true,
                                message: "Please input your friend's Email!"
                            },
                            {
                                type: 'email',
                                message: 'The input is not valid E-mail!',
                            },
                        ]
                    })(
                        <Input
                            prefix={<Icon type="mail" style={{ color: "rgba(0,0,0,.25)" }} />}
                            placeholder="Enter your friend's Email"
                        />
                    )}
                </Form.Item>
                <Form.Item wrapperCol={{ span: 12, offset: 6 }}>
                    <Button type="primary" htmlType="submit">
                        Invite
                    </Button>
                </Form.Item>
            </div>
        </Form>
    );
};
const AddFriendForm = Form.create({ name: 'friend_form' })(AddForm);


const mapStateToProps = reduxStore => {
    return {
        error: reduxStore.notificationsReducer.error,
    };
};
export default connect(
    mapStateToProps, { addNotifications }
)(AddFriendForm);

const style = {
    width: '375px',
    margin: 'auto',
    marginTop: '20px'
}