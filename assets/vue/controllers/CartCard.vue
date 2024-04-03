<template>
        <p class="product-card-name">{{ id }}</p>
        <p class="product-card-cost">{{ name }}</p>
        <p class="product-card-name">{{ article }}</p>
        <p class="product-card-name">{{ cost }}</p>
        <p class="product-card-cost">{{ description }}</p>
        <p class="product-card-name">{{ amount }}</p>
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