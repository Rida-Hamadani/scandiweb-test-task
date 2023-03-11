import React, { Component } from "react";
import { Link } from "react-router-dom";
import "./Header.css";

export class AddHeader extends Component {
  render() {

    const { onSubmit } = this.props;

    return (

      <div className="header-container">
        <div className="header-title">Add Product</div>
        <div className="header-buttons">
        <button form="product_form" type="submit" onClick={onSubmit}>SAVE</button>
        <Link to='/'><button>CANCEL</button></Link>
        </div>
      </div>

    );

  }

}

export default AddHeader;
