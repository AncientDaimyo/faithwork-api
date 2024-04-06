<template>
        <div class="product-card-image-div">
            <img class="product-card-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        </div>
        <div class="product-card-full-info">
            <p class="product-card-id">{{ id }}</p>
            <p class="product-card-name">{{ name }}</p>
            <p class="product-card-article">{{ article }}</p>
            <p class="product-card-cost">{{ cost }}</p>
            <p class="product-card-description">{{ description }}</p>
            <p class="product-card-amount">{{ amount }}</p>
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
    'amount' : String
});

</script>

<script>


export default {
    data() {
        return {
            showImage: false,
            route: "cart/",
            imageDir: "/images/products/",
        };
    },
    methods: {
       
    }
}
</script>