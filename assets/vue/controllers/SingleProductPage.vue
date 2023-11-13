<template>
    <img class="single-product-image" src="../pic/FW_GIRL_FACE_black.png" />
    <div class="single-product-full-info">
        <p class="single-product-name">{{ name }}</p>
        <p class="single-product-article">{{ article }}</p>
        <p class="single-product-cost">{{ cost }}</p>
        <p class="single-product-description">{{ description }}</p>
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