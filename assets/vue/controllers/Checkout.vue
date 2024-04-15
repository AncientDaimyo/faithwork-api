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
            <input type="text" placeholder=" " v-model="state.form.surname" />
            <span v-if="v$.form.surname.$error">
                {{ v$.form.surname.$errors[0].$message }}
            </span>
            <span class="placeholder">Фамилия</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="state.form.patronymic" />
            <span v-if="v$.form.patronymic.$error">
                {{ v$.form.patronymic.$errors[0].$message }}
            </span>
            <span class="placeholder">Отчество</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="state.form.email" />
            <span v-if="v$.form.email.$error">
                {{ v$.form.email.$errors[0].$message }}
            </span>
            <span class="placeholder">Email</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="state.form.telephone" />
            <span v-if="v$.form.telephone.$error">
                {{ v$.form.telephone.$errors[0].$message }}
            </span>
            <span class="placeholder">Телефон</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="state.form.city" />
            <span v-if="v$.form.city.$error">
                {{ v$.form.city.$errors[0].$message }}
            </span>
            <span class="placeholder">Город</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="state.form.street" />
            <span v-if="v$.form.street.$error">
                {{ v$.form.street.$errors[0].$message }}
            </span>
            <span class="placeholder">Улица</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="state.form.house" />
            <span v-if="v$.form.house.$error">
                {{ v$.form.house.$errors[0].$message }}
            </span>
            <span class="placeholder">Дом</span>
        </label>

        <label class="custom-field one">
            <input type="text" placeholder=" " v-model="state.form.apartment" />
            <span v-if="v$.form.apartment.$error">
                {{ v$.form.apartment.$errors[0].$message }}
            </span>
            <span class="placeholder">Квартира</span>
        </label>


        <input type="submit" />


    </form>

    {{ this.name }}

</template>


<script>
import useValidate from '@vuelidate/core'
import { required, minLength, email, numeric } from '@vuelidate/validators'
import { reactive, computed } from 'vue'
export default {
    setup() {
        const state = reactive({
            form: {
                name: '',
                surname: '',
                patronymic: '',
                email: '',
                telephone: '',
                city: '',
                street: '',
                house: '',
                apartment: '',
                products: []
            }
        })

        const rules = computed(() => {
            return {
                form: {
                    name: { required, minLength: minLength(2) },
                    surname: { required, minLength: minLength(2) },
                    patronymic: { required, minLength: minLength(2) },
                    email: { required, email },
                    telephone: { required, numeric },
                    city: { required, minLength: minLength(2) },
                    street: { required, minLength: minLength(2) },
                    house: { required, minLength: minLength(1) },
                    apartment: { required, numeric },
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
            if (this.getCookie('cart', true)) {
                this.state.products = JSON.parse(this.getCookie('cart'));
                let response = await fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify(this.state.form)
                });

                this.response = await response.json();
            }
            else
            {
                alert('Корзина пуста');
            }
        },
    },
    getCookie(name, json = false) {
            if (!name) {
                return undefined;
            }
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([.$?*|{}()\[\]\\\/+^])/g, '\\$1') + "=([^;]*)"
            ));
            if (matches) {
                let res = decodeURIComponent(matches[1]);
                if (json) {
                    try {
                        return JSON.parse(res);
                    }
                    catch (e) { }
                }
                return res;
            }

            return undefined;
        },
}

</script>