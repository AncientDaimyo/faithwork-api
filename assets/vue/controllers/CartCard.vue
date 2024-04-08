<template>
    <div class="product-card-image-div">
        <img class="product-card-image" v-bind:src="imageDir + image" v-bind:alt="name" />
    </div>
    <div class="product-card-full-info">
        <div class="product-card-naming-block">
            <p class="product-card-name">{{ name }}</p>
            <p class="product-card-article">{{ article }}</p>
            <p class="product-card-description">{{ description }}</p>
        </div>
        <div class="product-card-numbers-block">
            <p class="product-card-cost">{{ cost }}</p>
            <p class="product-card-amount">{{ amount }}</p>

        </div>
    </div>
    <div>
        <button v-on:click="removeFromCart">Удалить товар</button>
    </div>
    <div>
        <button v-on:click="removeCart">Удалить тrjhpbye</button>
    </div>w
</template>

<script setup>
defineProps({
    'id': String,
    'name': String,
    'article': String,
    'image': String,
    'cost': String,
    'description': String,
    'amount': String
});

</script>

<script>

export class Product {
    id;
    amount;
    constructor(id, amount) {
        this.id = id;
        this.amount = amount;
    }
}

import $ from 'jquery';

export default {
    data() {
        return {
            showImage: false,
            route: "cart/",
            imageDir: "/images/products/",
            products: [],
        };
    },
    methods: {
        async removeCart(){
            sessionStorage.clear();
            this.deleteCookie('cart');
            $(".cart-page").load('/cart/ajax');
        },
        removeFromCart() {
            if (this.getCookie('cart', true)) {
                this.products = JSON.parse(this.getCookie('cart'));
                if (!sessionStorage.getItem("cart")) {
                    sessionStorage.setItem("cart", JSON.stringify(this.products));
                }
                let product = new Product(this.id, 1);
                this.removeProduct(product);
                sessionStorage.setItem("cart", JSON.stringify(this.products));
                this.setCookie("cart", JSON.stringify(this.products));
                $(".cart-page").load('/cart/ajax');
            }

        },
        removeProduct(Product) {
            let p = this.products.find(item => item.id == Product.id);
            if (p != null) {
                let index = this.products.findIndex(item => item.id == p.id);
                this.products.splice(index, 1);
            }
        },
        getCookie(name, json = false) {
            if (!name) {
                return undefined;
            }
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([.$?*|{}()\[\]\\\/+^])/g, '\\$1') + "=([^;]*)"
            ));
            if (matches) {
                let res = decodeURIComponent(matches[1]);
                if (json) {
                    try {
                        return JSON.parse(res);
                    }
                    catch (e) { }
                }
                return res;
            }

            return undefined;
        },
        setCookie(name, value, options = { path: '/' }) {
            if (!name) {
                return;
            }

            options = options || {};

            if (options.expires instanceof Date) {
                options.expires = options.expires.toUTCString();
            }

            if (value instanceof Object) {
                value = JSON.stringify(value);
            }
            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }
            document.cookie = updatedCookie;
        },

        deleteCookie(name) {
            /*
            Deletes a cookie with specified name.
            Returns true when cookie was successfully deleted, otherwise false
            */
            this.setCookie(name, null, {
                expires: new Date(),
                path: '/'
            })
        }
    },
}
</script>