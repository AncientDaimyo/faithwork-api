<template>

    <form class="custom-field-user-info">

        <label class="custom-field one">
            <input type="text" name="name" placeholder=" " v-model="name" />
            <span class="placeholder">Имя</span>
        </label>

        <label class="custom-field one">
            <input type="text" name="second-name" placeholder=" " v-model="second_name" />
            <span class="placeholder">Фамилия</span>
        </label>

        <label class="custom-field one">
            <input type="text" name="last-name" placeholder=" " v-model="last_name" />
            <span class="placeholder">Отчество</span>
        </label>

        <label class="custom-field one">
            <input type="text" name="email" placeholder=" " v-model="email" />
            <span class="placeholder">Email</span>
        </label>

        <label class="custom-field one">
            <input type="text" name="telephone" placeholder=" " v-model="telephone" />
            <span class="placeholder">Телефон</span>
        </label>

        <label class="custom-field one">
            <input type="text" name="city" placeholder=" " v-model="city" />
            <span class="placeholder">Город</span>
        </label>

        <label class="custom-field one">
            <input type="text" name="street" placeholder=" " v-model="street" />
            <span class="placeholder">Улица</span>
        </label>

        <label class="custom-field one">
            <input type="text" name="house" placeholder=" " v-model="house" />
            <span class="placeholder">Дом</span>
        </label>

        <label class="custom-field one">
            <input type="text" name="apartment" placeholder=" " v-model="apartment" />
            <span class="placeholder">Квартира</span>
        </label>


        <input type="submit" />


    </form>




</template>

<script>

export default {
    data() {
        return {
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
        request_checkout() {
            let request_form = new XMLHttpRequest();
            request_form.open("POST", "/checkout");
            request_form.send(JSON.stringify(this.form));
        }
    }
}

</script>