import React, { Component } from "react";
import ListHeader from "../../components/headers/ListHeader";
import Footer from "../../components/footer/Footer";
import ProductCard from "../../components/product/ProductCard";
import './ProductList.css';

export class ProductList extends Component {

  constructor(props) {

    super(props);

    this.state = {

      response: null,
      selectedProducts: []

    };

  }

  toggleProductSelect = id => {

    this.setState(prevState => {

      if (prevState.selectedProducts.includes(id)) {

        return {
          selectedProducts: prevState.selectedProducts.filter(sku => sku !== id),
        };

      } else {

        return {
          selectedProducts: [...prevState.selectedProducts, id],
        };

      }

    });

  }

  handleDelete = async event => {

    event.preventDefault()
    event.stopPropagation()

    const { selectedProducts } = this.state;
    const params = new URLSearchParams();

    params.append('method', 'DELETE');

    selectedProducts.forEach(product => {

      params.append('products[]', product);

    });

    await fetch('https://facecookwalter.000webhostapp.com/products', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: params
    })
    
    this.setState({

      selectedProducts: [],
      response: await this.fetchProducts()
      
    });

  }

  fetchProducts = async () => {

    const response = await fetch('https://facecookwalter.000webhostapp.com/products');
    const data = response.json();

    return data;

  }

  shouldComponentUpdate(nextProps, nextState) {

    if (nextState.response === this.state.response && nextState.selectedProducts === this.state.selectedProducts) {

      return false;

    }
    
    return true;

  }

  async componentDidMount() {

    this.setState({
      response: await this.fetchProducts()
    });

  }

  render() {

    const { response, selectedProducts } = this.state;

    return (
      <div className="list-container">
        <div className="list-header">
          <ListHeader
            selectedProducts={selectedProducts}
            onDelete={this.handleDelete}
          />
        </div>
        <div className="list-body">
          {response
          ? response.map((props, index) => {
            const isChecked = selectedProducts.includes(props.sku);
            return <ProductCard
            key={index}
            {...props}
            onCheckboxChange={() => this.toggleProductSelect(props.sku)}
            checked={isChecked}
            />
          })
          : <p>Loading...</p>}
        </div>
        <div className="list-footer">
          <Footer />
        </div>
      </div>
    );
  }
}

export default ProductList;