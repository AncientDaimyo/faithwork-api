<template>

    <form class="custom-field-user-info" @submit.prevent="onSubmit">

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="state.form.name" />
            <span v-if="v$.form.name.$error">
                {{ v$.form.name.$errors[0].$message }}
            </span>
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

    {{ this.name }}

</template>


<script>
import useValidate from '@vuelidate/core'
import { required, minLength } from '@vuelidate/validators'
import { reactive, computed } from 'vue'
export default {
    setup() {
        const state = reactive({
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
        })

        const rules = computed(() => {
            return {
                form: {
                    name: { required, minLength: minLength(3) }
                }
            }
        })

        const v$ = useValidate(rules, state)

        return {
            state,
            v$,
        }
    },

    methods: {
        async onSubmit() {
            this.submitFormTest();
            let response = await fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(this.form)
            });

            this.response = await response.json();
        },
        submitFormTest() {
            this.v$.$validate()
            if (!this.v$.$error) {
                alert('Успешно')
            } else {
                alert('Все хуйня')
            }
        },
    },
}

</script>