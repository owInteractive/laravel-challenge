import React, { useState, useEffect } from "react";
import { Avatar, Dropdown, Menu, Button, Icon, Badge, Empty } from "antd";
import { connect } from "react-redux";
import { NavLink, withRouter } from "react-router-dom";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBell } from '@fortawesome/free-solid-svg-icons'
import { fetchNotifications, deleteNotifications } from '../../actions/notification-actions/action';
import { modifyUser } from '../../actions/auth-actions/actions';
import ShowEvent from '../showevent/ShowEvent';
import axiosInstance from "../../config/axios-instance";
import ProfileForm from '../Modify_Profile/ProfileModal';
import PasswordForm from '../Modify_password/PasswordModal';

import "./navbar.scss";

const Navbar = props => {
  const [dropDownState, setDropdownState] = useState(false);
  const [showEvent, setShowEvent] = useState(false);
  const [eventData, setEventData] = useState();
  const [showProfileModel, setShowProfileModel] = useState(false);
  const [showPasswordModel, setShowPasswordModel] = useState(false);

  useEffect(() => {
    props.isLoggedIn && props.fetchNotifications();
    console.log(props.notifications);
  }, [])

  const handle = (e) => {
    console.log(e);
    setDropdownState(!dropDownState);
  }
  const handleviewEvent = (eventId) => {
    axiosInstance({
      method: "get",
      url: `auth/event/${eventId}`,
      data: null
    }).then(res => {
      console.log(res.data);
      setEventData(res.data);
      setShowEvent(true);
    })
  }
  const handledeletenotif = (id) => {
    props.deleteNotifications(id);
  }

  const menu = (
    <Menu>
      {props.notifications && props.notifications.length > 0 ?
        props.notifications.map((not, index) =>
          (<Menu.Item id="menu" key={index}>
            <p>{not.from} has invited you to visite a event named : {not.event_name}</p>
            <button onClick={(id) => handledeletenotif(not.id)} id='view_inv' className="delete_inv">Delete Invitation</button>
            <button onClick={(id) => handleviewEvent(not.event_id)} id='delete_inv' className="view_inv">view Invitation</button>
          </Menu.Item>
          ))
        :
        <Menu.Item id="menu">
          <Empty />
        </Menu.Item>
      }

    </Menu>
  );

  return (
    <>
      <Menu mode="horizontal" className="navbar">
        {props.isLoggedIn ? (
          <Menu.Item key="4" className="first-element">
            {/* <Dropdown overlay={menu} placement="bottomCenter" arrow>
              <Icon className="notif-icon" width={'30px'} height={'30px'} type="bell" />
            </Dropdown> */}
            <Dropdown visible={dropDownState} onVisibleChange={handle} overlay={menu} placement="bottomLeft" arrow >
              <div>
                <Badge count={props.notifications.length}>
                  <FontAwesomeIcon className='icon' icon={faBell} />
                </Badge>
              </div>
            </Dropdown>
            {eventData ? <ShowEvent showEvent={showEvent} setShowEvent={setShowEvent} event={eventData} /> : null}
          </Menu.Item>
        ) : null}

        {!props.isLoggedIn ? (
          <Menu.Item key="1" className="navbar-right">
            <NavLink to="/signin">signin</NavLink>
          </Menu.Item>
        ) : null}

        {!props.isLoggedIn ? (
          <Menu.Item key="2">
            <NavLink to="/signup">signup</NavLink>
          </Menu.Item>
        ) : null}

        {props.isLoggedIn ? (
          <Menu.Item key="3" className="navbar-avatar navbar-right">
            <Dropdown
              overlay={
                <AvatarDropdown setShowPasswordModel={setShowPasswordModel} setShowProfileModel={setShowProfileModel} user={props.user} logout={props.logout} />
              }
              trigger={["click"]}
            >
              <Avatar size={32} icon="user" className="avatar" />
            </Dropdown>
          </Menu.Item>
        ) : null}
        {props.isLoggedIn ? <ProfileForm modifyUser={props.modifyUser} user={props.user} showProfileModel={showProfileModel} setShowProfileModel={setShowProfileModel} /> : null}
        {props.isLoggedIn ? <PasswordForm user={props.user} showPasswordModel={showPasswordModel} setShowPasswordModel={setShowPasswordModel} /> : null}
      </Menu>
    </>
  );
};
const mapStateToProps = reduxStore => {
  return {
    notifications: reduxStore.notificationsReducer.notifications,
  };
};

export default connect(
  mapStateToProps, { fetchNotifications, deleteNotifications, modifyUser }
)(Navbar);

const AvatarDropdown = props => {
  return (
    <Menu>
      <Menu.Item key="0" onClick={() => { props.setShowProfileModel(true); props.setShowPasswordModel(false) }}>
        Modify Profile
      </Menu.Item>
      <Menu.Item key="1" onClick={() => { props.setShowPasswordModel(true); props.setShowProfileModel(false) }}>
        Modify Password
      </Menu.Item>
      <Menu.Item key="3" onClick={() => props.logout()}>
        Logout
      </Menu.Item>
    </Menu>
  );
};
