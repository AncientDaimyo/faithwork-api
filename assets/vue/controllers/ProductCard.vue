<template>
    <div class="product-card-wrapper" @mouseenter="showImage = true" @mouseleave="showImage = false">
        <a v-bind:href="route + id"></a>
        <img class="product-card-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <div v-if="showImage"  class="product-card-add-to-cart">
            <a href="/"><span>ДОБАВИТЬ В КОРЗИНУ</span></a>
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
export default {
    data() {
        return {
            showImage: false,
            route: "shop/",
            imageDir: "/assets/images/"
        };
    }
}
</script>