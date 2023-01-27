import React, { Component } from "react";
import { Link } from "react-router-dom";
import './Header.css';

export class AddHeader extends Component {
  render() {
    return (
      <div className="header-container">
        <div className="header-title">Add Product</div>
        <div className="header-buttons">
          <div><Link to='/'><button>SAVE</button></Link></div>
          <div><Link to='/'><button>CANCEL</button></Link></div>
        </div>
      </div>
    );
  }
}

export default AddHeader;
