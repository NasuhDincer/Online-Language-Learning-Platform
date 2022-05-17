import Navigation from "../components/Navigation";
import classes from "./StdClass.module.css";

function StdClass(props) {
  const DUMMY_DATA = ["jack jack - french", "micheal jones - english"];

  return (
    <div>
      <Navigation />
      <div className={classes.div1}>
        <h1>Request Class from a Teacher</h1>
        <br />
        <select>
          {DUMMY_DATA.map((option) => (
            <option value={option}>{option}</option>
          ))}
        </select>
      </div>
      <br />
      <button className={classes.btn}>Apply For Class</button>
      <div className={classes.div2}>
        <h1>Request Online Meeting Request</h1>
        <br />
        <h>
          <b>Select Native Speaker</b>
        </h>
        <br />
        <select>
          {DUMMY_DATA.map((option) => (
            <option value={option}>{option}</option>
          ))}
        </select>
        <br />
        <br />
        <h>
          <b>Provide Date and Time</b>
        </h>
        <br />
        <input></input>
        <br />
        <br />
        <h>
          <b>Comments</b>
        </h>
        <br />
        <textarea></textarea>
        <br />
        <button className={classes.btn}>Request</button>
      </div>
    </div>
  );
}

export default StdClass;