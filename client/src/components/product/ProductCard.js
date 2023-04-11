import React, { Component } from 'react';
import './ProductCard.css';

class ProductCard extends Component {

    render() {

        const { sku, name, price, property, onCheckboxChange, checked} = this.props;

        return (

            <div className="card">
                <div className="delete-btn">
                    <input type="checkbox" className="delete-checkbox" onChange={onCheckboxChange} checked={checked}/>
                </div>
                <div className="description">
                    <p>{sku}</p>
                    <p>{name}</p>
                    <p>{price} $</p>
                    <p>{property}</p>
                </div>
            </div>

        );

    }
}

export default ProductCard;