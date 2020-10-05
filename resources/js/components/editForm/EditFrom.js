import React, { useState } from 'react';
import { connect } from "react-redux";
import { editEvents, fetchEvents } from "../../actions/events-actions/actions";
import { Form, Input, Modal, DatePicker, Button } from "antd";
import moment from 'moment'



const EditForm = props => {
    const [loading, setLoading] = useState(false);

    const { getFieldDecorator } = props.form;

    const { RangePicker } = DatePicker;

    const dateFormat = 'YYYY-MM-DD';
    const disabledDate = (current) => {
        // Can not select days before today and today
        return current && current < moment().startOf('day');
    }

    const handleSubmitForm = (event, value) => {
        event.preventDefault();
        props.form.validateFields(async (err, data) => {
            if (!err) {
                const obj = {
                    title: data.title,
                    description: data.description,
                    start_datetime: moment(data.date[0]).format('YYYY-MM-DD'),
                    end_datetime: moment(data.date[1]).format('YYYY-MM-DD')
                }
                console.log(obj)
                setLoading(true);
                await props.editEvents(obj, props.event.id);
                await props.fetchEvents(props.current_page, props.type);
                setLoading(false);
                props.setShowEditModel(false);
            } else {
                console.log(err);
            }
        });
    }
    const handleCancel = e => {
        props.setShowEditModel(false);
    };
    return (
        <Modal
            key={props.event.id}
            title="Add Event"
            visible={props.showEditModal}
            onCancel={handleCancel}
            footer={[
                <Button key="back" onClick={handleCancel}>
                    Cancel
            </Button>,
                <Button key="submit" type="primary" loading={loading} onClick={handleSubmitForm}>
                    Edit Event
            </Button>,
            ]}
        >
            <Form onSubmit={handleSubmitForm}>
                <div className="input-group">
                    <Form.Item>
                        {getFieldDecorator('title', {
                            rules: [{ required: true, message: 'Title is required!' }],
                            initialValue: props.event.title
                        })(
                            <Input className="input--style-2" type="text" placeholder="Name" />,
                        )}
                    </Form.Item>
                    <Form.Item>
                        {getFieldDecorator('description', {
                            rules: [{ required: true, message: 'Description is required!' }],
                            initialValue: props.event.description
                        })(
                            <Input className="input--style-2" type="text" placeholder="Name" />,
                        )}
                    </Form.Item>
                    <Form.Item>
                        {getFieldDecorator('date', {
                            rules: [{ required: true, message: 'Date is required!' }],
                            initialValue: [moment(props.event.start_datetime, dateFormat), moment(props.event.end_datetime, dateFormat)]
                        })(
                            <RangePicker
                                format={dateFormat}
                                disabledDate={disabledDate}
                            />
                        )}
                    </Form.Item>
                </div>
            </Form>
        </Modal>
    );
};
const EditEvent = Form.create({ name: 'event_form' })(EditForm);
export default connect(null, { editEvents, fetchEvents })(EditEvent);
