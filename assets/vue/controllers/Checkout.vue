<template>

    <form class="custom-field-user-info" @submit.prevent="onSubmit">

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="name" />
            <span class="placeholder">Имя</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="second_name" />
            <span class="placeholder">Фамилия</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="last_name" />
            <span class="placeholder">Отчество</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="email" />
            <span class="placeholder">Email</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="telephone" />
            <span class="placeholder">Телефон</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="city" />
            <span class="placeholder">Город</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="street" />
            <span class="placeholder">Улица</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="house" />
            <span class="placeholder">Дом</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="apartment" />
            <span class="placeholder">Квартира</span>
        </label>


        <input type="submit" />


    </form>
    {{ this.response['status'] }}

</template>


<script>

export default {
    data() {
        return {
            response: '',
            form: {
                name: '',
                second_name: '',
                last_name: '',
                email: '',
                telephone: '',
                city: '',
                street: '',
                house: '',
                apartment: '',
            }
        };
    },
    methods: {
        async onSubmit() {
            let response = await fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(this.form)
            });

            this.response = await response.json();
        },
    }
}

</script>