import React, { useEffect, useState } from 'react';
import { useHistory } from 'react-router-dom';
import moment from 'moment';

import { connect } from "react-redux";
import { fetchEventsAfterAddOrDelete, fetchEvents, deleteEvents } from "../../actions/events-actions/actions";
import EditEvent from '../editForm/EditFrom';
import ShowEvent from '../showevent/ShowEvent';




const Event = props => {
    const [showEditModel, setShowEditModel] = useState(false);
    const [showEvent, setShowEvent] = useState(false);
    const history = useHistory();
    // fade long text
    let bodyEl;
    let fadeEl;

    useEffect(() => {
        // the viewable height is not the real height of the body (long text)
        if (bodyEl.scrollHeight > bodyEl.clientHeight) {
            fadeEl.style.display = 'block';
        } else {
            fadeEl.style.display = 'none';
        }
    });
    const handleClick = () => {
        setShowEvent(true);
    };
    const handledelete = async (id) => {
        await props.deleteEvents(props.event.id);
        await props.fetchEventsAfterAddOrDelete(1, props.type);
    }
    const calcDays = (date1, date2) => {
        return moment(date1).diff(moment(date2), 'days');
    }
    return (
        <div className='note-card-container'>
            <div className='note-card-content' onClick={handleClick}>
                <h1 className='note-card-title'>{props.event.title}</h1>
                <div
                    className='note-card-body'
                    ref={(e) => {
                        bodyEl = e;
                    }}
                >
                    <p>{props.event.description} </p>
                    <div
                        className='fade-out-truncation'
                        ref={(e) => {
                            fadeEl = e;
                        }}
                    ></div>
                </div>
                <p className="event-date">Start at: {props.event.start_datetime} duration: {calcDays(props.event.end_datetime, props.event.start_datetime)} {calcDays(props.event.end_datetime, props.event.start_datetime) > 1 ? "days" : "day"} </p>
            </div>
            {props.user.id == props.event.user_id && <div className='edit-btn'
                onClick={() => setShowEditModel(true)}
            >
            </div>}
            {props.user.id == props.event.user_id && <div
                className='x-btn'
                onClick={(id) => handledelete(id)}
            ></div>}
            <ShowEvent showEvent={showEvent} setShowEvent={setShowEvent} event={props.event} />
            <EditEvent current_page={props.current_page} type={props.type} key={props.event.id} event={props.event} showEditModal={showEditModel} setShowEditModel={setShowEditModel} />
        </div>
    );
};


export default connect(
    null,
    { deleteEvents, fetchEvents, fetchEventsAfterAddOrDelete }
)(Event);
