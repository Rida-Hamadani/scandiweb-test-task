import { Fragment } from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import './App.css';
import ProductList from './pages/ProductList/ProductList';
import AddProduct from './pages/AddProduct/AddProduct';

function App() {
  return (
      <Fragment>
        <Routes>
          <Route path='*' element={<Navigate to='/' />} />
          <Route path='/' element={<ProductList />} />
          <Route path='/add-product' element={<AddProduct />} />
        </Routes>
      </Fragment>
  );
}

export default App;
