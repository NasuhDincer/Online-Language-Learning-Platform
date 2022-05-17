import { Link } from "react-router-dom";
import classes from "./Navigation.module.css";

function Navigation(props) {
  return (
    <header className={classes.header}>
      <div className={classes.logo}>
        <ul>
          <li>
            <Link to="/StdHome">Home</Link>
          </li>
          <li>
            <Link to="/StdClass">Class</Link>
          </li>
          <button className={classes.btn}>Logout</button>
        </ul>
      </div>
    </header>
  );
}

export default Navigation;
