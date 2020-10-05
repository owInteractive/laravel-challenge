import React, { useState } from 'react';
import { connect } from "react-redux";
import { fetchEventsAfterAddOrDelete, fetchEvents, addEvents } from "../../actions/events-actions/actions";
import { Form, Input, Modal, DatePicker, Button, Icon } from "antd";
import moment from 'moment'

const { TextArea } = Input;

const EventAdd = props => {
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
                console.log(obj);
                setLoading(true);
                await props.addEvents(obj, props.type);
                setLoading(false);
                props.setShowModel(false);
                await props.fetchEventsAfterAddOrDelete(1, props.type);
                props.form.resetFields();
            } else {
                console.log(err);
            }
        });
    }
    const handleCancel = e => {
        props.setShowModel(false);
        props.form.resetFields()
    };
    return (
        <Modal
            title="Add Event"
            visible={props.showModel}
            onCancel={handleCancel}
            footer={[
                <Button key="back" onClick={handleCancel}>
                    Cancel
            </Button>,
                <Button key="submit" type="primary" loading={loading} onClick={handleSubmitForm}>
                    Create Event
            </Button>,
            ]}
        >
            <Form onSubmit={handleSubmitForm}>
                <div className="input-group">
                    <Form.Item>
                        {getFieldDecorator('title', {
                            rules: [{ required: true, message: 'Title of event is required!' }],
                        })(
                            <Input className="input--style-2" type="text" placeholder="Name" />,
                        )}
                    </Form.Item>
                    <Form.Item>
                        {getFieldDecorator('description', {
                            rules: [{ required: true, message: 'description of event is required!' }],
                        })(
                            <TextArea rows={4} className="input--style-2" placeholder="Name" />,
                        )}
                    </Form.Item>
                    <Form.Item>
                        {getFieldDecorator('date', {
                            rules: [{ required: true, message: 'date of event is required!' }],
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
const EventForm = Form.create({ name: 'event_form' })(EventAdd);
export default connect(null, { addEvents, fetchEvents, fetchEventsAfterAddOrDelete })(EventForm);
