import React, { Component } from "react";
import ListHeader from "../../components/headers/ListHeader";
import Footer from "../../components/footer/Footer";
import './ProductList.css';

export class ProductList extends Component {
  render() {
    return (
      <div className="list-container">
        <div className="list-header">
          <ListHeader />
        </div>
        <div className="list-body">
          <p>Product List</p>
        </div>
        <div className="list-footer">
          <Footer />
        </div>
      </div>
    );
  }
}

export default ProductList;
