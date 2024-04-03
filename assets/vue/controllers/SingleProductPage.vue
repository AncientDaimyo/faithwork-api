<template>
    <div class="image-wrapper">
        <img class="single-product-image"  v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image"  v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image"  v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image"  v-bind:src="imageDir + image" v-bind:alt="name" />
        <img class="single-product-image"  v-bind:src="imageDir + image" v-bind:alt="name" />
    </div>
        <div class="info">
            <p class="single-product-name">{{ name }}</p>
            <p class="single-product-article">{{ article }}</p>
            <p class="single-product-cost">{{ cost }}</p>
            <p class="single-product-descriptionww">{{ description }}</p>
        </div>
</template>

<script setup>
defineProps({
    'name': String,
    'article': String,
    'image': String,
    'cost': String,
    'description': String,
});

</script>

<script>
export default {
    data() {
        return {
            showImage: false,
            route: "shop/",
            imageDir: "/images/products/"
        };
    }
}
</script>