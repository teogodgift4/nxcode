import React from "react";
import Card from 'react-bootstrap/Card'; 
import { useEffect , useState} from "react";

const CardView = (props) => {

    const API_KEY = "dFedxKpdnECeeLLoLQzK8OclMpO2kTEp";
    const URL = "https://api.polygon.io/v2/aggs/ticker/";
    const URL2 ="/prev?adjusted=true&apiKey=";
    //const ticker = "AAPL";

    //const API_URL = "https://api.coindesk.com/v1/bpi/currentprice.json";

    //const [obj, setObj] = useState();
    const [name, setName] = useState("");
    const [close, setClose] = useState("");
    const [open, setOpen] = useState("");
    const [time, setTime] = useState("");

     /*
     const  handleFetchData = async () =>{
        await fetch(`${URL}${props.ticker}${URL2}${API_KEY}`)
        .then(response => response.json())
        .then(data => {
          setName(data.results[0]["T"])
          setClose(data.results[0]["c"])
          setOpen(data.results[0]["v"])
          setTime(data.results[0]["t"])
        })
      }
      */

      
      useEffect(() => {
        fetch(`${URL}${props.ticker}${URL2}${API_KEY}`)
          .then(response => response.json())
          .then(data => {
            setName(data.results[0]["T"])
            setClose(data.results[0]["c"])
            setOpen(data.results[0]["v"])
            setTime(data.results[0]["t"])
          })
      }, []);

      

      

      

    return (  
        <Card className="col-12 col-sm-6" >
      <Card.Body>
        <Card.Title>{name}</Card.Title>
        <Card.Text>
          <h2>${close}</h2>
          <div className="carddiv">
            <p>+{parseFloat(String(open).substring(0,3)).toFixed(2)/100}%</p>
            <p>{new Date(time).toLocaleDateString()}</p>
          </div>
        </Card.Text>
      </Card.Body>
    </Card>
    );
}
 
export default CardView;