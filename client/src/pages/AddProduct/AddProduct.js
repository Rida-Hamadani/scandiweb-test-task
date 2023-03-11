import React, { Component } from 'react';
import { Navigate } from 'react-router-dom';
import AddHeader from "../../components/headers/AddHeader";
import ProductForm from "../../components/form/ProductForm";
import Footer from "../../components/footer/Footer";
import "./AddProduct.css";

class AddProduct extends Component {

  constructor(props) {

    super(props);

    this.state = {
      properties: {
      sku: '',
      name: '',
      price: '',
      type: 'Type',
      size: '',
      height: '',
      length: '',
      width: '',
      weight: ''
      },
      response: null
    };

  }

  takeInput = (name, value) => {

    this.setState(prevState => ({

      properties: {
        
        ...prevState.properties,
        [name]: value

      }

    }));

  }

  handleSave = event => {

    event.preventDefault();

    const params = new URLSearchParams();

    for (const [key, value] of Object.entries(this.state.properties)) {
      value !== '' && params.append(key, value);
    }

    fetch('https://facecookwalter.000webhostapp.com/products', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: params.toString()
    })
    .then(response => response.json())
    .then(data => {

      this.setState({

        properties: {
          sku: '',
          name: '',
          price: '',
          type: 'Type',
          size: '',
          height: '',
          length: '',
          width: '',
          weight: ''
        },
        response: data
        
      });

    });

  };

  handleCancel = () => {
    // handle cancel logic here
  };

  render() {

    const { response } = this.state;

    if (response && response.messages && response.messages === 'success') {

      return <Navigate to='/' />;

    }

    return (

      <div className="add-container">
        <div className="add-header">
          <AddHeader onSubmit={this.handleSave}/>
        </div>
        <div className="add-body">
          <ProductForm {...this.state} onChange={this.takeInput}/>
        </div>
        <div className="add-footer">
          <Footer />
        </div>
      </div>

    );

  }

}

export default AddProduct;
