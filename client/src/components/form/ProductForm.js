import React, { Component, memo } from 'react';
import Label from "../../components/label/Label";
import './ProductForm.css';

class ProductForm extends Component {

    takeInput = event => {

        const target = event.target;
        const value = target.value;
        const name = target.name;
        this.props.onChange(name, value);

    };

    dvdForm = () => {

        const { size } = this.props.properties;

            return (

                <div>
                <p>Please, provide size</p>
                <label htmlFor="size">Size (MB):</label>
                <input
                    type="text"
                    id="size"
                    name="size"
                    value={size}
                    onChange={this.takeInput}
                />
                </div>

            );

    };

    furnitureForm = () => {

        const { height, length, width } = this.props.properties;

        return (

            <div>
            <p>Please, provide dimensions</p>
            <label htmlFor="height">Height (CM):</label>
            <input
                type="text"
                id="height"
                name="height"
                value={height}
                onChange={this.takeInput}
            />

            <label htmlFor="length">Length (CM):</label>
            <input
                type="text"
                id="length"
                name="length"
                value={length}
                onChange={this.takeInput}
            />

            <label htmlFor="width">Width (CM):</label>
            <input
                type="text"
                id="width"
                name="width"
                value={width}
                onChange={this.takeInput}
            />
            </div>
        );

    };

    bookForm = () => {

        const { weight } = this.props.properties;

        return (

            <div>
            <p>Please, provide weight</p>
            <label htmlFor="weight">Weight (KG):</label>
            <input
                type="text"
                id="weight"
                name="weight"
                value={weight}
                onChange={this.takeInput}
            />
            </div>

        );

    };

    render() {

    const { response, properties} = this.props;
    const { sku, name, price, type } = properties;


    return (

        <form id="product_form">

            <div className="form-container form-center">
                <div>
                <label htmlFor="sku">SKU:</label>
                <input
                    type="text"
                    id="sku"
                    name="sku"
                    value={sku}
                    onChange={this.takeInput}
                />
                </div>

                <div>
                <label htmlFor="name">Name:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value={name}
                    onChange={this.takeInput}
                />
                </div>

                <div>
                <label htmlFor="price">Price ($):</label>
                <input
                    type="text"
                    id="price"
                    name="price"
                    value={price}
                    onChange={this.takeInput}
                />
                </div>

                <div>

                <label htmlFor="type">Type:</label>
                <select
                    name="type"
                    id="productType"
                    value={type}
                    onChange={this.takeInput}
                >
                    <option value="Type" disabled hidden>Type</option>
                    <option value="DVD">DVD</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Book">Book</option>

                </select>

            </div>

            {type === 'Dvd' && this.dvdForm()}
            {type === 'Furniture' && this.furnitureForm()}
            {type === 'Book' && this.bookForm()}

            {response && response.errors && 

                <div className='notification'>

                    <Label message={response.errors[0]}/>

                </div>

            }

        </div>

      </form>

    );

  };

}

export default memo(ProductForm);
