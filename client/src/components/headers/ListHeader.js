import React, { Component } from "react";
import { Link } from "react-router-dom";
import './Header.css';

export class ListHeader extends Component {
  render() {
    return (
      <div className="header-container">
        <div className="header-title">Product List</div>
        <div className="header-buttons">
          <div><Link to='/add-product'><button>ADD</button></Link></div>
          <div><button id="delete-product-btn">MASS DELETE</button></div>
        </div>
      </div>
    );
  }
}

export default ListHeader;
