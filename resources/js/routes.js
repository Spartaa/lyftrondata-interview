import EditProduct from './components/EditProduct.vue';
import ProductList from "./components/ProductList";
import AddProduct from "./components/AddProduct";

export const routes = [
    {
        name: 'home',
        path: '/',
        component: ProductList
    },
    {
        name: 'create',
        path: '/create',
        component: AddProduct
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProduct
    }
];
