import { get } from "lodash";
export default {
    get clients() {
        return get(this, "transactionData.clients", []);
    },

    get products() {
        return this.unblacklistedProducts;
    },
    get cartItems() {
        return this.selectedCartItems;
    },
    get buyingPriceLabel() {
        return get(this.priceMappings, "buyingPrice");
    },
    get sellingPriceLabel() {
        return get(this.priceMappings, "sellingPrice");
    },

    set props(props) {
        for (let prop in props) {
            this[prop] = props[prop];
        }
        this.selectedCartItems = [];
        this.originalProducts = get(this, "transactionData.products", []);
        this.unblacklistedProducts = this.originalProducts;
    },
    addCartItem(item) {
        this.selectedCartItems.push(item);
        this.blackListProduct(item.product_id);
    },
    removeCartItem(item) {
        let index = this.selectedCartItems.findIndex(
            selected => selected.product_id == item.product_id
        );
        index != -1 ? this.selectedCartItems.splice(index, 1) : false;
        this.unBlacklistProduct(item.product_id);
    },
    blackListProduct(product_id) {
        this.unblacklistedProducts = this.unblacklistedProducts.filter(
            product => product.id != product_id
        );
    },

    unBlacklistProduct(product_id) {
        let product = this.originalProducts.find(
            product => product.id == product_id
        );
        product ? this.unblacklistedProducts.push(product) : false;
    }
};
