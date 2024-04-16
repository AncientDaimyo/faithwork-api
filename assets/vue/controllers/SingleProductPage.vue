<template>
    <div class="image-wrapper">
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
    </div>
    <div class="info">
        <p class="single-product-name">{{ name }}</p>
        <p class="single-product-article">{{ article }}</p>
        <p class="single-product-cost">{{ cost }}&#8381</p>
        <div v-if="isDescriptiopExist" class="single-product-description-block">
            <p class="single-product-description">Принт: {{ JSON.parse(description)['print'] }}</p>
            <p class="single-product-description">Плотность: {{ JSON.parse(description)['plotnost'] }}</p>
            <p class="single-product-description">Состав: {{ JSON.parse(description)['sostav'] }}</p>
        </div>

        <div class="single-product-size-block">
            {{  this.getProductSize()   }}
        </div>

        <div class="single-product-add-to-cart">
            <button class="single-product-add-to-cart-button" v-show="showAddToCartButton"
                v-on:click="addToCart">Добавить в корзину</button>
            <button class="single-product-go-to-cart" v-show="showGoToCartButton" v-on:click="goToCart">Перейти в
                корзину</button>
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
    'size': String,
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
            sizes: [],
            html: '',
            showAddToCartButton: true,
            showGoToCartButton: false,
            route: "shop/",
            imageDir: "/images/products/",
            isDescriptiopExist: this.isDescriptiopExist()
        };
    },
    methods: {
        isDescriptiopExist() {
            if(JSON.parse(this.description) != null) {
                return true;
            }
            else {
                return false;
            }
        },
        addToCart() {
            if (this.getCookie('cart', true)) {
                this.products = JSON.parse(this.getCookie('cart', true));
            }
            let product = new Product(this.id, 1);
            this.addProduct(product);
            this.setCookie("cart", JSON.stringify(this.products));
            this.showAddToCartButton = false;
            this.showGoToCartButton = true;
            alert("Добавлено в корзину");
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
        goToCart() {
            location.href = "/cart";
        },
        async getProductSize() {
            let href = '/shop/size-ajax/' + id;
            let response = await fetch(href, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
            });

            this.sizes = await response.json();
            this.sizesJSON.parse(this.sizes);
            let html = '';
            this.sizes.forEach(element => {
                html += '<div class-"size-button">' + element + '</div>';
            });
            return html;
        },

    }
}
</script>