<template>      
        <img class="product-card-image" v-bind:src="image" v-bind:alt="name"/>
        <p class="product-card-name">{{ name }}</p>
        <p class="product-card-cost">{{ cost }}</p>
</template>
    
    <script setup>
        defineProps ({
            'name': String,
            'article': String,
            'image': String,
            'cost': String,
            'description': String,
        });
    
    </script>