import logo from './logo.svg';
import './App.css';
import { useEffect } from 'react';
import CardView from './CardView';

function App() {
  
  return (
    <div className="App">
      <div className="container pt-3 pb-3">
        <div class="row myrow">
   <CardView  ticker="AAPL" />
   <CardView  ticker="GOOGL" />
   <CardView  ticker="META" />
   <CardView  ticker="TSLA" />
   <CardView  ticker="GS" />
   <CardView  ticker="DJIA" />
   </div>
   </div>
    </div>
  );
}

export default App;
