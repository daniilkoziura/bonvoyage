import React from 'react';

import FlightDashboard from './pages/FlightDashboard';

import './App.css';

function App() {

  return (
    <div className="App">
        <div className="head-container">
            <div className="header-base-company">
                <img src={`${process.env.PUBLIC_URL}/Transport_Plane_1 copy 14.svg`}  alt="bonvoyage-logo" width="120" height="120"/>
                <div>
                    <h1 className="test">Bonvoyage</h1>
                    <h5>{`Let\`s book your flight today!`.toUpperCase()}</h5>
                </div>
            </div>
            <span className="header-auth-link">Go to Profile</span>
        </div>

      <FlightDashboard/>
    </div>
  );
}

export default App;