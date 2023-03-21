import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import PresenceList from "./component/Presence";
import PresencePage from "./component/PresencePage";

function App() {
  return (
    /*<BrowserRouter>
      <Routes>
        <Route exact path="/">
        </Route>
        <Route exact path="/org/:orgId">
          <PresenceList level="org" />
        </Route>
        <Route exact path="/org/:orgId/building/:buildingId">
          <PresenceList level="building" />
        </Route>
        <Route exact path="/org/:orgId/building/:buildingId/piece/:pieceId">
          <PresenceList level="piece" />
        </Route>
      </Routes>
    </BrowserRouter>*/
    <PresencePage/>
    
  );
}

export default App;

