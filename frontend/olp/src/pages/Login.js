import React, { useRef, useState } from "react";
import { Route } from "react-router-dom";
import axios from "axios";
import classes from "./Login.module.css";

function LoginForm(props) {
  const idRef = useRef();
  const passwordRef = useRef();

  function submitHandler(event) {
    event.preventDefault();

    const theId = idRef.current.value;
    const thePassword = passwordRef.current.value;

    const theData = {
      id: theId,
      password: thePassword,
    };

    axios.get("url").then((res) => {
      const allId = res.id;
      const allPswd = res.password;

      allId.forEach((e) => {
        if (e == theId) {
          allPswd.forEach((element) => {
            if (element == thePassword) {
              <Route to="/home"></Route>;
            }
          });
        }
      });
    });
  }

  return (
    <div className={classes.colmform}>
      <div className={classes.formcontainer}>
        <form onSubmit={submitHandler}>
          <input
            type="text"
            required
            id="id"
            ref={idRef}
            placeholder="Insert User ID"
            className={classes.input}
          ></input>
          <br />
          <input
            type="password"
            required
            id="password"
            ref={passwordRef}
            placeholder="Insert User Password"
            className={classes.input}
          ></input>
          <br />
          <button className={classes.btnlogin}>Login</button>
        </form>
      </div>
    </div>
  );
}

export default LoginForm;
