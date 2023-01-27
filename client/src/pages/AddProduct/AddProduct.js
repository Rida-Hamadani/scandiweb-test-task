import React, { Component } from "react";
import AddHeader from "../../components/headers/AddHeader";
import Footer from "../../components/footer/Footer";
import './AddProduct.css';

export class AddProduct extends Component {
  render() {
    return (
      <div className="add-container">
        <div className="add-header">
          <AddHeader />
        </div>
        <div className="add-body">
          <p>Add Product</p>
        </div>
        <div className="add-footer">
          <Footer />
        </div>
      </div>
    );
  }
}

export default AddProduct;
