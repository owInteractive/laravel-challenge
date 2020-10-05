import React, { useState } from 'react';
import './ShowEvent.scss';
import { Modal, DatePicker, Alert } from "antd";
import { connect } from "react-redux";

import moment from 'moment'
import AddFriendForm from '../AddFirend/AddfirendForm';
const { RangePicker } = DatePicker;

const ShowEvent = props => {
    const [showAddFriendForm, setShowAddFriendForm] = new useState(false);
    const dateFormat = 'YYYY-MM-DD';
    const handleCancel = e => {
        props.setShowEvent(false);
    };
    return (
        <Modal
            title="Event"
            visible={props.showEvent}
            onCancel={handleCancel}
            footer={null}
            className="event-modal"
        >
            <div className="main-event">
                <h1>{props.event.title}</h1>
                <p>{props.event.description}</p>
                <div className='event-calender'>
                    <RangePicker
                        disabled
                        defaultValue={[moment(props.event.start_datetime, dateFormat), moment(props.event.end_datetime, dateFormat)]}
                        format={dateFormat}
                    />
                    {/* <Calendar fullscreen={false} validRange={[moment(props.event.start_datetime), moment(props.event.end_datetime)]} /> */}
                </div>
                <div className='add-friend'>
                    <button onClick={() => { setShowAddFriendForm(!showAddFriendForm); console.log(showAddFriendForm) }}>
                        {!showAddFriendForm ? "Add Friend" : "Hide"}
                    </button>
                </div>
                {showAddFriendForm ? <AddFriendForm setShowAddFriendForm={setShowAddFriendForm} handleCancel={handleCancel} event={props.event} /> : null}
            </div>
        </Modal>
    );
};

const mapStateToProps = reduxStore => {
    return {
        error: reduxStore.notificationsReducer.error,
    };
};

export default connect(
    mapStateToProps, null
)(ShowEvent);
