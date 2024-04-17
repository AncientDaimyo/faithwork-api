<template>
    <div class="image-wrapper">
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image" v-bind:src="imageDir + image" v-bind:alt="name" />
    </div>
    <div class="info">
        <p class="single-product-name">{{ name }}</p>
        <p class="single-product-article">{{ article }}</p>
        <p class="single-product-cost">{{ cost.split('.')[0] }}&#8381</p>
        <div class="single-product-description-block">
            <p class="single-product-description">Принт: {{ description_print }}</p>
            <p class="single-product-description">Плотность: {{ description_density }}</p>
            <p class="single-product-description">Состав: {{ description_compound }}</p>
        </div>

        <form class="single-product-size-form" @submit.prevent="">
            <span v-for="size in sizes">
                <input class="single-product-size-button" type="radio" name="getProductSize" v-model="form.size"
                    :value=size>
                {{ size }}
            </span>
            <div class="single-product-add-to-cart">
                <button v-on:click="addToCart" class="single-product-add-to-cart-button"
                    v-show="showAddToCartButton">Добавить в
                    корзину</button>
                <button class="single-product-go-to-cart" v-show="showGoToCartButton" v-on:click="goToCart">Перейти в
                    корзину</button>

            </div>
        </form>








    </div>

</template>

<script setup>
defineProps({
    'id': String,
    'name': String,
    'article': String,
    'image': String,
    'cost': String,
    'description_print': String,
    'description_density': String,
    'description_compound': String,
    'sizes': Array,
});
</script>

<script>

export default {
    data() {
        return {
            products: [],
            html: '',
            showAddToCartButton: true,
            showGoToCartButton: false,
            route: "shop/",
            imageDir: "/images/products/",
            form: {
                pid: this.id,
                amount: 1,
                size: null,
            }
        };
    },
    methods: {
        addToCart() {
            let response = fetch('/cart/add', {
                method: 'POST',
                body: JSON.stringify(this.form)
            })
                .then((response) => response.json())
                .then((json) => console.log(json));
            this.showAddToCartButton = false;
            this.showGoToCartButton = true;
        },
        goToCart() {
            location.href = "/cart";
        },
        async getProductSize() {
            let href = '/shop/size-ajax/' + id;
            let response = await fetch(href);

            this.sizes = response.body;
            this.sizesJSON.parse(this.sizes);
            let html = '';
            this.sizes.forEach(element => {
                html += '<div class-"size-button">' + element + '</div>';
            });
            return response.body;
        },
        singleProductSizeForm() {
            console.log(this.product_size);
        }

    }
}
</script>