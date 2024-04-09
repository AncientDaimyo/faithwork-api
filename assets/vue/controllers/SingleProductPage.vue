<template>
    <div class="image-wrapper">
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
    </div>
    <div class="info">
        <p class="single-product-name">{{ name }}</p>
        <p class="single-product-article">{{ article }}</p>
        <p class="single-product-cost">{{ cost }}&#8381</p>
        <p class="single-product-descriptionww">{{ description }}</p>
        <div class="product-card-add-to-cart">
            <button class="product-card-add-to-cart-button" v-on:click="addToCart">Добавить в корзину</button>
        </div>
    </div>

</template>

<script setup>
defineProps({
    'id': String,
    'name': String,
    'article': String,
    'image': String,
    'cost': String,
    'description': String,
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

export default {
    data() {
        return {
            products: [],
            showImage: false,
            route: "shop/",
            imageDir: "/images/products/"
        };
    },
    methods: {
        addToCart() {
            if (this.getCookie('cart', true)) {
                this.products = JSON.parse(this.getCookie('cart', true));
            }
            let product = new Product(this.id, 1);
            this.addProduct(product);
            this.setCookie("cart", JSON.stringify(this.products));
        },
        addProduct(Product) {
            let p = this.products.find(item => item.id == Product.id);
            if (p == null) {
                this.products.push(Product);
            }
            else {
                let index = this.products.findIndex(item => item.id == p.id);
                p.amount += 1;
                this.products.splice(index, 1, p);
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
    }
}
</script>