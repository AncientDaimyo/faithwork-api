<template>
    <div class="product-card-wrapper" @mouseenter="showImage = true" @mouseleave="showImage = false">
        <a v-bind:href="route + id"></a>
        <img class="product-card-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <div v-if="showImage" class="product-card-add-to-cart">
            <button v-on:click="addToCart">add</button>
        </div>
        <p class="product-card-name">{{ name }}</p>
        <p class="product-card-cost">{{ cost }}</p>
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
            imageDir: "/images/products/",
        };
    },
    methods: {
        addToCart() {
            if (!sessionStorage.getItem("cart")) {
                sessionStorage.setItem("cart", JSON.stringify(this.products));
            }
            else {
                this.products = JSON.parse(sessionStorage.getItem("cart"));
            }
            let product = new Product(this.id, 1);
            this.addProduct(product);
            sessionStorage.setItem("cart", JSON.stringify(this.products));
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
        setCookie(name, value) {
            var d = new Date();
            d.setTime(d.getTime() + 1000000000);
            var expires = "expires=" + d.toGMTString();
            document.cookie = name + "=" + value + "; " + expires;
        }
    }
}
</script>