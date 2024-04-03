<template>
    <div class="product-card-wrapper" @mouseenter="showImage = true" @mouseleave="showImage = false">
        <a v-bind:href="route + id"></a>
        <img class="product-card-image" v-bind:src="imageDir + image" v-bind:alt="name" />
        <div v-if="showImage" class="product-card-add-to-cart">
            <form @submit="formSubmit" id="form">
                <input type="hidden" name="product_id" v-model="pid">
                <input type="submit" value="send">
            </form>
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
            imageDir: "/images/products/",
            pid: 1
        };
    }
}
// methods: {
//             formSubmit(e) {
//                 e.preventDefault();
//                 let currentObj = this;
//                 this.axios.post('/cart', {
//                     product_id: this.id
//                 })
//                 .then(function (response) {
//                     currentObj.output = response.data;
//                 })
//                 .catch(function (error) {
//                     currentObj.output = error;
//                 });
//             }
//         }

// }
</script>