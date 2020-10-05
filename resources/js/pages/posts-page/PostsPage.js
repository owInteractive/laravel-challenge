import React, { useEffect, useState } from "react";
import { connect } from "react-redux";
import { CSSTransition, TransitionGroup } from 'react-transition-group';
import { exportEvent, fetchEvents, deleteEvents } from "../../actions/events-actions/actions";
import { Pagination } from "antd";
import Event from '../../components/event/event';
import axios from 'axios';
import * as Feather from 'feather-icons';

import EventForm from '../../components/EventForm/EventAdd';
import EditEvent from '../../components/editForm/EditFrom';
import ImportEventForm from '../../components/importEventsForm/ImportEventsForm';
import { Select } from 'antd';

const { Option } = Select;


import "./posts-page.scss";

const PostsPage = props => {
  const [showModel, setShowModel] = useState(false);
  const [showEvent, setShowEvent] = useState(false);
  const [type, setType] = useState('all');
  const [typeExport, setTypeExport] = useState('exportEvents');
  const [data, setData] = useState(props.events);
  let typee = 'all';
  useEffect(() => {
    props.fetchEvents();
    console.log(props.user);
    Feather.replace();
  }, []);
  useEffect(() => {
    if (type == 'today') {
      setTypeExport('exportTodaysEvents');
    }
    if (type == 'nextFiveDays') {
      setTypeExport('exportNextFiveDaysEvents');
    }
  }, [type]);
  useEffect(() => {
    setData(props.events);
  }, [props.events]);
  useEffect(() => {
    props.fetchEvents(1, type);
  }, [type]);
  const showModale = () => {
    setShowModel(true);
  };
  const filter = (query) => {
    // getting words
    query = query.toLowerCase().trim();

    if (query === '') {
      // empty search
      setData(props.events);
      return;
    }
    let terms = query.split(' ');
    // removing duplicates
    terms = removeDuplicates(terms);
    let allResults = new Array();
    terms.forEach((term) => {
      let results = relevantEvents(term);
      allResults.push(...results);
    });
    setData(sortByRelevancy(allResults));
  };
  const removeDuplicates = (arr) => {
    let unique = new Set();

    arr.forEach((e) => unique.add(e));
    return Array.from(unique);
  };

  const relevantEvents = (query) => {
    query = query.toLowerCase().trim();
    let relevant = props.events.filter((event) => {
      return (
        (event.description && event.description.toLowerCase().trim().includes(query)) ||
        event.title.toLowerCase().trim().includes(query)
      );
    });
    return relevant;
  };


  const sortByRelevancy = (searchRes) => {
    let uniqueResults = removeDuplicates(searchRes);
    let eventCount = {};

    searchRes.forEach((event) => {
      let eventId = event.id;

      if (eventCount && eventCount[eventId]) {
        eventCount[eventId] += 1;
      } else {
        eventCount[eventId] = 1;
      }
    });

    const sorted = uniqueResults.sort((a, b) => {
      return eventCount[b.id] - eventCount[a.id];
    });
    return sorted;
  };

  const exportevents = () => {
    // props.exportEvent();
    axios.get("http://127.0.0.1:8000/exportEvents").then(res => {
      console.log('azeaze')
    });
  }

  const handleChange = (value) => {
    setType(value);
  }

  const select = (
    <Select size={'large'} defaultValue="All" style={{ width: 120 }} onChange={handleChange}>
      <Option value="all">All</Option>
      <Option value="today">Today Events</Option>
      <Option value="nextFiveDays">next 5 days Events</Option>
    </Select>
  )

  return (
    <div className='mainLayout'>
      <div className='main-container'>
        <div className='search-bar-container'>
          <div className='field'>
            <div className='control has-icons-left'>
              <input
                className='input'
                type='text'
                placeholder='Filter'
                //   (keyup)="filter($event.target.value)"
                onChange={(e) => {
                  filter(e.target.value);
                }}
              />
              <span className='icon is-small is-left'>
                <i data-feather='search'></i>
              </span>

            </div>
            {select}
          </div>
        </div>
        <TransitionGroup className='notes-list'>
          {data && data.length > 0 ?
            data.map((n) => (
              <CSSTransition key={n.id} timeout={200} classNames='slide'>
                <Event type={type} user={props.user} key={n.id} event={n} current_page={props.current_page} />
              </CSSTransition>
            ))
            : (
              <CSSTransition key='-1' timeout={300} classNames='fade'>
                <p>No entries . . .</p>
              </CSSTransition>
            )}
          {data && data.length > 0 && <Pagination current={props.current_page} pageSize={props.per_page} total={props.total} onChange={e => props.fetchEvents(e, type)} />}
        </TransitionGroup>
        <div className='add-export floating-add-button'>
          <button onClick={showModale} className='button is-primary'>+ Add</button>
          <a className='floating-add-button' href={'http://127.0.0.1:8000/' + typeExport} className=''>Export</a>
        </div>
      </div>
      <EventForm type={type} showModel={showModel} setShowModel={setShowModel} />

    </div>
  );
};

const mapStateToProps = reduxStore => {
  return {
    events: reduxStore.eventsReducer.events,
    total: reduxStore.eventsReducer.total,
    per_page: reduxStore.eventsReducer.per_page,
    current_page: reduxStore.eventsReducer.current_page,
    user: reduxStore.authReducer.user,
  };
};

export default connect(
  mapStateToProps,
  { fetchEvents, deleteEvents, exportEvent }
)(PostsPage);
