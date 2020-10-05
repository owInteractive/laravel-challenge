import React from "react";
import { CSSTransition, TransitionGroup } from 'react-transition-group';
import { Link } from 'react-router-dom';

import "./home-page.scss";

const HomePage = () => {
  return (
    <div className='mainLayout'>
      <div className='main-container'>
        <div className='search-bar-container'>
          <div className='field'>
            <p className='control has-icons-left'>
              <input
                className='input'
                type='text'
                placeholder='Filter'
              //   (keyup)="filter($event.target.value)"
              // onChange={(e) => {
              // 	filter(e.target.value);
              // }}
              />
              <span className='icon is-small is-left'>
                <i data-feather='search'></i>
              </span>
            </p>
          </div>
        </div>
        <TransitionGroup className='notes-list'>
          {/* {filtered && filtered.length > 0 ? (
            filtered.map((n) => (
              <CSSTransition key={n.id} timeout={200} classNames='slide'>
                <NoteCard key={n.id} note={n} delete={deleteNote!} />
              </CSSTransition>
            ))
          ) : (
              <CSSTransition key='-1' timeout={300} classNames='fade'>
                <p>wow such empty . . .</p>
              </CSSTransition>
            )} */}
        </TransitionGroup>

        <Link className='button floating-add-button is-primary' to='/add'>
          + Add
				</Link>
      </div>
    </div>
  );
};

export default HomePage;
