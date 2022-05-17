import { Route, Routes } from "react-router-dom";
import LoginForm from "./pages/Login";
import StdHome from "./pages/StdHome";
import StdClass from "./pages/StdClass";

function App() {
  // return <LoginForm />;
  // return <StdHome />;
  return <StdClass />;

  // return (
  //   <Routes>
  //     <Route path="/login" exact>
  //       <LoginForm />;
  //     </Route>
  //     <Route path="/StdHome">
  //       <StdHome />;
  //     </Route>
  //   </Routes>
  // );
}

export default App;
